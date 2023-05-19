#!/bin/bash
composer install
# Inicia PHP-FPM en segundo plano
php-fpm &
php artisan migrate   
# Inicia Nginx en primer plano
nginx -g "daemon off;"