#!/bin/bash

set -e

echo "Deployment started ..."

# Gunakan perintah sudo tanpa interaksi
sudo php artisan down || true
sudo git reset --hard HEAD
sudo git pull origin main --no-ff
sudo composer install --no-dev --prefer-dist --optimize-autoloader --no-interaction
sudo composer dump-autoload
sudo php artisan cache:clear
sudo php artisan config:cache
sudo php artisan route:cache
sudo php artisan view:cache
sudo php artisan storage:link
sudo php artisan up

echo "Deployment finished!"
