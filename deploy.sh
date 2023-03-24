git pull origin main
composer install --no-interaction --prefer-dist --optimize-autoloader
echo "" | sudo -S service php8.2-fpm reload

npm ci
npm run build

php artisan route:cache
php artisan view:clear
php artisan migrate --force
php artisan horizon:publish
php artisan horizon:terminate

echo "🚀 Application deployed!"