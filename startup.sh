#!/bin/sh

#copy env
# cp .env.example .env
# install
composer install --prefer-dist --no-scripts --no-autoloader

# secret
# php artisan key:generate

composer dump-autoload --no-scripts --optimize