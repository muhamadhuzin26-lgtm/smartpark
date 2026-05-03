# ============================================================
# SmartPark - Production Dockerfile for Railway
# Laravel 12 + PHP 8.2 + Apache + Node.js (Vite build)
# ============================================================

FROM php:8.2-apache AS base

# ------ System dependencies ------
RUN apt-get update && apt-get install -y --no-install-recommends \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    libicu-dev \
    zip \
    unzip \
    git \
    curl \
    ca-certificates \
    gnupg \
    && rm -rf /var/lib/apt/lists/*

# ------ PHP extensions (semua yang dibutuhkan Laravel + DomPDF) ------
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
    pdo_mysql \
    mbstring \
    xml \
    gd \
    bcmath \
    zip \
    intl \
    pcntl \
    opcache

# ------ Apache config ------
RUN a2dismod mpm_event mpm_worker || true \
    && a2enmod mpm_prefork rewrite headers
COPY docker/apache.conf /etc/apache2/sites-available/000-default.conf

# ------ Install Composer ------
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# ------ Install Node.js 20 (untuk Vite build) ------
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs \
    && rm -rf /var/lib/apt/lists/*

# ------ PHP production config ------
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

# Custom PHP settings
RUN echo "memory_limit=256M" > "$PHP_INI_DIR/conf.d/custom.ini" \
    && echo "upload_max_filesize=64M" >> "$PHP_INI_DIR/conf.d/custom.ini" \
    && echo "post_max_size=64M" >> "$PHP_INI_DIR/conf.d/custom.ini" \
    && echo "max_execution_time=120" >> "$PHP_INI_DIR/conf.d/custom.ini"

# OPcache settings for production
RUN echo "opcache.enable=1" > "$PHP_INI_DIR/conf.d/opcache.ini" \
    && echo "opcache.memory_consumption=128" >> "$PHP_INI_DIR/conf.d/opcache.ini" \
    && echo "opcache.interned_strings_buffer=8" >> "$PHP_INI_DIR/conf.d/opcache.ini" \
    && echo "opcache.max_accelerated_files=10000" >> "$PHP_INI_DIR/conf.d/opcache.ini" \
    && echo "opcache.validate_timestamps=0" >> "$PHP_INI_DIR/conf.d/opcache.ini"

# ------ App setup ------
WORKDIR /app

# Copy composer files first (leverage Docker cache)
COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader --no-interaction --no-scripts

# Copy package files and build frontend
COPY package.json package-lock.json ./
RUN npm ci --no-audit --no-fund

# Copy the rest of the app
COPY . .

# Create .env from example (Laravel needs this for artisan commands)
RUN cp .env.example .env

# Re-run composer scripts (post-autoload-dump, package:discover)
RUN composer dump-autoload --optimize --no-interaction || true

# Build Vite assets
RUN npm run build

# Remove node_modules after build (save image size)
RUN rm -rf node_modules

# ------ Storage & permissions ------
RUN mkdir -p storage/framework/sessions \
    storage/framework/views \
    storage/framework/cache/data \
    storage/logs \
    bootstrap/cache \
    && chown -R www-data:www-data /app \
    && chmod -R 775 storage bootstrap/cache

# ------ Entrypoint ------
COPY docker-entrypoint.sh /usr/local/bin/docker-entrypoint.sh
# Fix Windows CRLF line endings → Linux LF (CRITICAL for Windows dev)
RUN sed -i 's/\r$//' /usr/local/bin/docker-entrypoint.sh \
    && chmod +x /usr/local/bin/docker-entrypoint.sh

EXPOSE 80

ENTRYPOINT ["docker-entrypoint.sh"]
