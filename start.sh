#!/bin/bash

# Set error reporting
php -d display_errors=1 -d display_startup_errors=1 -d error_reporting=E_ALL

# Install dependencies
composer install --no-interaction --no-dev --optimize-autoloader

# Install npm dependencies and fix vulnerabilities
npm install --production=false
npm audit fix --force

# Clear npm cache
npm cache clean --force

# Clear previous build
rm -rf public/build

# Build assets
NODE_ENV=production npm run build

# Move manifest.json to correct location if it exists in .vite folder
if [ -f "public/build/.vite/manifest.json" ]; then
    mv public/build/.vite/manifest.json public/build/manifest.json
    rm -rf public/build/.vite
fi

# Verify manifest exists
if [ ! -f "public/build/manifest.json" ]; then
    echo "Error: manifest.json not found after build"
    exit 1
fi

# Generate application key if not exists
if [ -z "$APP_KEY" ]; then
    php artisan key:generate --force
else
    php artisan key:generate --force --key="$APP_KEY"
fi

# Clear cache
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
php artisan optimize:clear

# Optimize
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Run migrations
php artisan migrate --force

# Create storage link
php artisan storage:link --force

# Set permissions
chmod -R 775 storage bootstrap/cache
chmod -R 775 public/build
chmod -R 775 storage/logs
chmod -R 775 storage/framework
chmod -R 755 public
chmod -R 755 public/build
chmod -R 755 public/build/assets

# Start the application with error logging
php artisan serve --host=0.0.0.0 --port=$PORT 2>&1 | tee storage/logs/laravel.log
