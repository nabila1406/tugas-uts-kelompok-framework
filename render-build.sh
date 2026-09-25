#!/usr/bin/env bash
# Keluar jika terjadi error
set -o errexit

# Install dependensi PHP tanpa modul development
composer install --no-dev --optimize-autoloader

# Install dependensi Node.js dan build asset frontend (Vite)
npm install
npm run build

# Clear dan cache konfigurasi Laravel agar performa lebih cepat
php artisan config:cache
php artisan route:cache

# Jalankan migrasi database otomatis
php artisan migrate --force