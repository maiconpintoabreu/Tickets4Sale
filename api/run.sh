#!/bin/sh

cd /app  
php artisan mysql:createdb
php artisan migrate:fresh --seed
php artisan serve --host=0.0.0.0 --port=8181