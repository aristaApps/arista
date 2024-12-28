#!/bin/bash

# Direktori aplikasi
APP_DIR="/var/www/arista"

# Masuk ke direktori aplikasi
cd $APP_DIR

# Pastikan git repository terupdate
echo "Pulling the latest code from GitHub..."
git pull origin main

# Pastikan dependensi terinstal
echo "Installing Composer dependencies..."
composer install --no-interaction --prefer-dist

# Clear config cache (penting untuk Laravel)
echo "Clearing Laravel config cache..."
php artisan config:clear

# Clear route cache
echo "Clearing Laravel route cache..."
php artisan route:clear

# Clear view cache
echo "Clearing Laravel view cache..."
php artisan view:clear

# Clear session cache (optional)
echo "Clearing Laravel session cache..."
php artisan cache:clear

# Restart Laravel queue jika menggunakan queue
echo "Restarting Laravel queue..."
php artisan queue:restart

# Mengatur permission folder storage dan bootstrap/cache (jika diperlukan)
echo "Setting file permissions for storage and cache directories..."
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache

# Restart aplikasi jika menggunakan Supervisor atau PM2
echo "Restarting the application..."
if command -v pm2 &> /dev/null; then
  pm2 restart all
elif [ -f /etc/systemd/system/arista.service ]; then
  sudo systemctl restart arista
else
  echo "No recognized process manager found. Please configure PM2 or systemd."
fi

echo "Deployment completed successfully!"
