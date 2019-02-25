#!/bin/sh

./wait-for-it.sh db:3306 --timeout=60 -- php artisan migrate --env=compose
php artisan serve --host=0.0.0.0 --port=8000