#!/bin/bash

# Pastikan direktori dan file dimiliki oleh www-data
echo "Menetapkan kepemilikan direktori dan file ke www-data"
sudo chown -R www-data:www-data /var/www/arista

# Mengatur izin akses direktori dan file
echo "Mengatur permission ke 775 untuk direktori dan file"
sudo chmod -R 775 /var/www/arista

# Jalankan build dengan user www-data
echo "Menjalankan npm install dengan user www-data"
su -s /bin/bash -c "npm install" www-data

echo "Menjalankan npm run build dengan user www-data"
su -s /bin/bash -c "npm run build" www-data

# Jalankan maintenance mode dengan user www-data
echo "Masuk ke maintenance mode"
sudo -u www-data php artisan down

# Restart aplikasi setelah build selesai
echo "Menjalankan php artisan up untuk mengaktifkan aplikasi kembali"
cd /var/www/arista && sudo -u www-data php artisan up

echo "Deployment selesai!"
