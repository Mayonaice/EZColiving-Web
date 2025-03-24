#!/bin/bash
set -e

echo "Starting build process..."

# Install dependencies
echo "Installing PHP dependencies..."
composer install --no-interaction --no-dev --optimize-autoloader

# Install npm dependencies
echo "Installing Node.js dependencies..."
npm install --legacy-peer-deps

# Build assets
echo "Building assets..."
npm run build

# Generate application key
echo "Generating application key..."
php artisan key:generate

# Clear cache
echo "Clearing cache..."
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

# Optimize
echo "Optimizing application..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Run migrations
echo "Running migrations..."
php artisan migrate --force

# Create storage link
echo "Creating storage link..."
php artisan storage:link --force

# Set permissions
echo "Setting permissions..."
chmod -R 775 storage bootstrap/cache

# Verify build
echo "Verifying build..."
if [ -d "public/build" ]; then
    echo "Build directory exists"
    ls -la public/build
else
    echo "Build directory does not exist!"
    exit 1
fi

echo "Build process completed successfully!"