#!/bin/bash
echo "Starting deployment..."
git pull origin main  # Menarik perubahan terbaru dari GitHub
php artisan config:clear  # Membersihkan cache konfigurasi
php artisan queue:restart  # Men-restart antrian job Laravel
