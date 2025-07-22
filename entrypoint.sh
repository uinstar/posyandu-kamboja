#!/bin/bash

echo "Starting Laravel setup..."
php artisan config:cache || echo "Config cache failed"
php artisan storage:link || echo "Storage link failed"
php artisan migrate --force || echo "Migration failed"

echo "Launching Laravel app..."
exec php artisan serve --host=0.0.0.0 --port=8080
