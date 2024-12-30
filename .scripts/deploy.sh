#!/bin/bash

# Set the project directory
PROJECT_DIR="/var/www/arista"

# Navigate to the project directory
cd $PROJECT_DIR || exit

# terik semua perubahan
git pull origin main

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
