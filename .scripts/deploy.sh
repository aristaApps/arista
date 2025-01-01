#!/bin/bash

set -e

echo "Deployment started ..."

# Menambahkan -S agar sudo membaca password dari input
echo "your_password_here" | sudo -S php artisan down || true
echo "your_password_here" | sudo -S git reset --hard HEAD
echo "your_password_here" | sudo -S git pull origin main --no-ff
echo "your_password_here" | sudo -S composer install --no-dev --prefer-dist --optimize-autoloader --no-interaction
echo "your_password_here" | sudo -S composer dump-autoload
echo "your_password_here" | sudo -S php artisan cache:clear
echo "your_password_here" | sudo -S php artisan config:cache
echo "your_password_here" | sudo -S php artisan route:cache
echo "your_password_here" | sudo -S php artisan view:cache
echo "your_password_here" | sudo -S php artisan storage:link
echo "your_password_here" | sudo -S php artisan up

echo "Deployment finished!"
