#!/bin/bash
# JANGAN pakai set -e — kita handle error sendiri agar Apache tetap start

echo "============================================"
echo "  SmartPark - Starting deployment..."
echo "============================================"

# --- Use PORT from Railway (default 80) ---
PORT="${PORT:-80}"
echo "[1/6] Configuring port ${PORT}..."

# Update Apache to listen on Railway's PORT
sed -i "s/Listen 80/Listen ${PORT}/g" /etc/apache2/ports.conf 2>/dev/null || true
sed -i "s/:80/:${PORT}/g" /etc/apache2/sites-available/000-default.conf 2>/dev/null || true

# --- Create .env if not exists ---
echo "[2/6] Checking .env file..."
if [ ! -f /app/.env ]; then
    cp /app/.env.example /app/.env 2>/dev/null || touch /app/.env
    echo "  → Created .env from .env.example"
fi

# --- Generate APP_KEY if not set ---
echo "[3/6] Checking APP_KEY..."
if [ -z "$APP_KEY" ]; then
    php artisan key:generate --force 2>/dev/null && echo "  → APP_KEY generated" || echo "  → WARNING: Could not generate APP_KEY. Set it in Railway env vars."
else
    echo "  → APP_KEY already set"
fi

# --- Run migrations ---
echo "[4/6] Running database migrations..."
php artisan migrate --force --no-interaction 2>&1 && echo "  → Migrations complete" || echo "  → WARNING: Migration failed. Make sure MySQL addon is connected in Railway."

# --- Storage link ---
echo "[5/6] Creating storage link..."
php artisan storage:link --force 2>/dev/null && echo "  → Storage linked" || echo "  → WARNING: Storage link failed (non-critical)"

# --- Cache optimization ---
echo "[6/6] Caching configuration..."
php artisan config:clear 2>/dev/null || true
php artisan route:clear 2>/dev/null || true
php artisan view:clear 2>/dev/null || true

php artisan config:cache 2>/dev/null && echo "  → Config cached" || echo "  → Config cache skipped"
php artisan route:cache 2>/dev/null && echo "  → Routes cached" || echo "  → Route cache skipped"
php artisan view:cache 2>/dev/null && echo "  → Views cached" || echo "  → View cache skipped"

echo "============================================"
echo "  SmartPark is ready on port ${PORT}"
echo "============================================"

# Start Apache in foreground — this MUST run no matter what
exec apache2-foreground
