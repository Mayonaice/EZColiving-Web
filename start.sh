#!/bin/bash

# Install dependencies
composer install --no-interaction --no-dev --optimize-autoloader

# Install npm dependencies
npm install --production=false

# Build assets
NODE_ENV=production npm run build

# Generate application key
php artisan key:generate

# Clear cache
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

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

# Start the application
php artisan serve --host=0.0.0.0 --port=$PORT
