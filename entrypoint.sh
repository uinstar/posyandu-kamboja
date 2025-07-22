#!/bin/bash

# Wait for DB to be ready (optional but recommended)
echo "Waiting for database..."
until php artisan migrate:status > /dev/null 2>&1; do
    sleep 2
done

# Laravel setup
php artisan config:cache
php artisan storage:link
php artisan session:table || true
php artisan migrate --force

# Start Laravel dev server
php artisan serve --host=0.0.0.0 --port=8000
