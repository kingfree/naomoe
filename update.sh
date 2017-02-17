#!/bin/bash
php artisan down
git pull
chown www-data:www-data . -R
composer install
npm install
npm run production
php artisan migrate
php artisan up
