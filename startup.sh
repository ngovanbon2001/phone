# Sao chép tệp .env
cp .env.example .env

# Cài đặt Composer Dependencies
composer install

# Làm sạch cache
php artisan cache:clear

# Tạo lại cache cấu hình
php artisan config:cache

# Tạo khóa ứng dụng
php artisan key:generate

# Tạo lại autoload file
composer dump-autoload --no-scripts