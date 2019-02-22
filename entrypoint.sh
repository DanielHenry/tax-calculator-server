cd /tax-calculator-server
cp .env.compose .env
composer self-update
composer install --no-interaction
php artisan key:generate
php artisan config:clear