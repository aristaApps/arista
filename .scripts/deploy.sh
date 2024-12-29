#!/bin/bash

# Set the project directory
PROJECT_DIR="/var/www/arista"

# Navigate to the project directory
cd $PROJECT_DIR || exit

# Set the necessary permissions (make sure directories are writable)
echo "Setting permissions for storage and bootstrap/cache..."
chmod -R 775 storage bootstrap/cache

# Run Composer install (skip dev dependencies and optimize autoloader)
echo "Running composer install..."
composer install --no-dev --optimize-autoloader

# Run migrations if necessary
echo "Running migrations..."
php artisan migrate --force

# Clear and cache Laravel configurations, routes, and views
echo "Clearing and caching Laravel configurations, routes, and views..."
php artisan cache:clear
php artisan config:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Create symbolic link for storage folder
echo "Creating symbolic link for storage folder..."
php artisan storage:link


# Fix permissions for log files
echo "Setting permissions for log files..."
chmod -R 775 storage/logs

# Clear any cache or temporary files
echo "Clearing cache..."
php artisan cache:clear

echo "Deploy completed successfully!"
