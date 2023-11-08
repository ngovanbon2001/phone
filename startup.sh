!/bin/sh

#copy env
cp .env.example .env
# install
composer install

# secret
php artisan key:generate

# php artisan migrate

composer dump-autoload

php artisan optmize