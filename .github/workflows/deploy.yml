#!/bin/bash

# Pastikan direktori dan file dimiliki oleh www-data
sudo chown -R www-data:www-data /var/www/arista
sudo chmod -R 775 /var/www/arista

# Jalankan build dengan user www-data
su -s /bin/bash -c "npm install" www-data
su -s /bin/bash -c "npm run build" www-data

# Jalankan maintenance mode dengan user www-data
sudo -u www-data php artisan down

# Restart aplikasi setelah build selesai
cd /var/www/arista && php artisan up
