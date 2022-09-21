#!/bin/sh
cd /backend
sleep 20s
php artisan migrate
php -S 0.0.0.0:8000 -t public

