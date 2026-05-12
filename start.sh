#!/bin/bash
set -e

echo "Running migrations..."
php artisan migrate --force

echo "Migrations completed. Starting server..."
php artisan serve --host=0.0.0.0 --port=${PORT:-8000}
