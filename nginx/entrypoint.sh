#!/bin/bash
php artisan storage:link
service nginx start
php-fpm