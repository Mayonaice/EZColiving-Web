#!/bin/bash

# Exit on error
set -e

echo "Checking database connection..."
while ! php artisan db:monitor --timeout=1; do
    echo "Database is not ready yet..."
    sleep 2
done
echo "Database is ready!"

echo "Checking build directory..."
if [ ! -d "public/build" ]; then
    echo "Build directory not found! Running build process..."
    bash build.sh
fi

echo "Starting Laravel server..."
exec php artisan serve --host=0.0.0.0 --port=$PORT
