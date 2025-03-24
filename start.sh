#!/bin/bash

# Exit on error
set -e

echo "Starting Laravel server..."
exec php artisan serve --host=0.0.0.0 --port=$PORT
