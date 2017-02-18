#!/bin/bash
php artisan down
git pull
composer install
npm install
npm run production
php artisan migrate
chown www-data:www-data . -R
php artisan up
