#!/bin/bash
set -e

echo "============================================"
echo "  SmartPark - Starting deployment..."
echo "============================================"

# --- Use PORT from Railway (default 80) ---
PORT="${PORT:-80}"
sed -i "s/Listen 80/Listen ${PORT}/g" /etc/apache2/ports.conf
sed -i "s/:80/:${PORT}/g" /etc/apache2/sites-available/000-default.conf

echo "[1/6] Port set to ${PORT}"

# --- Generate APP_KEY if not set ---
if [ -z "$APP_KEY" ]; then
    echo "[2/6] Generating APP_KEY..."
    php artisan key:generate --force
else
    echo "[2/6] APP_KEY already set"
fi

# --- Run migrations ---
echo "[3/6] Running database migrations..."
php artisan migrate --force --no-interaction 2>&1 || {
    echo "WARNING: Migration failed. This may be expected on first deploy without DB."
    echo "Make sure your DATABASE_URL or DB_* env vars are set in Railway."
}

# --- Storage link ---
echo "[4/6] Creating storage link..."
php artisan storage:link --force 2>/dev/null || true

# --- Cache optimization ---
echo "[5/6] Caching configuration..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "[6/6] All done! Starting Apache..."
echo "============================================"
echo "  SmartPark is ready on port ${PORT}"
echo "============================================"

# Start Apache in foreground
exec apache2-foreground
