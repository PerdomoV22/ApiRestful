#!/bin/bash
composer install
# Inicia PHP-FPM en segundo plano
php-fpm &
php artisan migrate   
php artisan passport:key
# Inicia Nginx en primer plano
nginx -g "daemon off;"