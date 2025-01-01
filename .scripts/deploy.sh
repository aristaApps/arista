#!/bin/bash

set -e

echo "Deployment started ..."

# Pindah ke direktori proyek
cd /var/www/arista

# Masuk ke maintenance mode
php artisan down || true

# Reset dan tarik pembaruan dari Git
git reset --hard HEAD
git pull origin main --no-ff

# Install dependencies dengan Composer
composer install --no-dev --prefer-dist --optimize-autoloader --no-interaction
composer dump-autoload

# Clear dan cache konfigurasi Laravel
php artisan cache:clear
php artisan config:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Membuat symlink untuk storage
php artisan storage:link

# Keluar dari maintenance mode
php artisan up

echo "Deployment finished!"
