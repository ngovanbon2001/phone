!/bin/sh

#copy env
cp .env.example .env
# install
composer install
php artisan cache:clear
php artisan config:cache

# secret
php artisan key:generate

# php artisan migrate

composer dump-autoload --no-scripts