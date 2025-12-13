#!/bin/sh
set -euo

for dir in cache data sessions testing views; do
    mkdir -p "storage/framework/${dir}"
done
mkdir -p storage/logs
chown -R www-data:www-data storage bootstrap/cache || true

if [ -z "${APP_KEY:-}" ]; then
    echo "APP_KEY is not set. Please configure it in Railway."
    exit 1
fi

if [ ! -L "public/storage" ]; then
    php artisan storage:link || true
fi

php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan event:clear

php artisan package:discover --ansi

php artisan migrate --force --ansi

php artisan optimize --ansi

exec php artisan serve --host=0.0.0.0 --port="${PORT:-8000}"
