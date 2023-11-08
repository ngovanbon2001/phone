# Sao chép tệp .env
cp .env.example .env

# Cài đặt Composer Dependencies
composer install --ignore-platform-req=ext-gd

# Làm sạch cache
php artisan cache:clear

# Tạo lại cache cấu hình
php artisan config:cache

# Tạo khóa ứng dụng
php artisan key:generate

php artisan storage:link

php artisan migrate

# Tạo lại autoload file
composer dump-autoload --no-scripts