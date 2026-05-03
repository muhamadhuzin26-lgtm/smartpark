#!/bin/bash
# JANGAN pakai set -e — kita handle error sendiri agar Apache tetap start

echo "============================================"
echo "  SmartPark - Starting deployment..."
echo "============================================"

# --- Use PORT from Railway (default 80) ---
PORT="${PORT:-80}"
echo "[1/5] Configuring port ${PORT}..."

# Update Apache to listen on Railway's PORT
sed -i "s/Listen 80/Listen ${PORT}/g" /etc/apache2/ports.conf 2>/dev/null || true
sed -i "s/:80/:${PORT}/g" /etc/apache2/sites-available/000-default.conf 2>/dev/null || true

# --- Generate APP_KEY if not set ---
echo "[2/5] Checking APP_KEY..."
if [ -z "$APP_KEY" ]; then
    php artisan key:generate --force 2>/dev/null && echo "  -> APP_KEY generated" || echo "  -> WARNING: Set APP_KEY in Railway env vars"
else
    echo "  -> APP_KEY already set"
fi

# --- Run migrations (with 15s timeout so it doesn't hang) ---
echo "[3/5] Running database migrations..."
if [ -n "$DB_HOST" ]; then
    timeout 15 php artisan migrate --force --no-interaction 2>&1 && echo "  -> Migrations complete" || echo "  -> WARNING: Migration failed or timed out"
else
    echo "  -> Skipped: DB_HOST not set. Add MySQL addon in Railway."
fi

# --- Storage link ---
echo "[4/5] Creating storage link..."
php artisan storage:link --force 2>/dev/null || true

# --- Cache optimization ---
echo "[5/5] Optimizing..."
php artisan config:clear 2>/dev/null || true
php artisan route:clear 2>/dev/null || true
php artisan view:clear 2>/dev/null || true
php artisan config:cache 2>/dev/null || true
php artisan route:cache 2>/dev/null || true
php artisan view:cache 2>/dev/null || true

echo "============================================"
echo "  SmartPark ready on port ${PORT}"
echo "============================================"

# Ensure only mpm_prefork is loaded (fixes AH00534 error on Railway)
a2dismod mpm_event mpm_worker 2>/dev/null || true
a2enmod mpm_prefork 2>/dev/null || true

# Fix permissions for files created by root during artisan commands
chown -R www-data:www-data /app/storage /app/bootstrap/cache 2>/dev/null || true

# Start Apache in foreground - MUST always reach this line
exec apache2-foreground
