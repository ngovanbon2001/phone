# Sao chép tệp .env
cp .env.example .env

# Cài đặt Composer Dependencies
composer install --no-scripts

# Làm sạch cache
php artisan cache:clear

# Tạo lại cache cấu hình
php artisan config:cache

# Tạo khóa ứng dụng
php artisan key:generate

php artisan storage:link

composer require laravel/framework

# Tạo lại autoload file
composer dump-autoload