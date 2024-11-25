# Sử dụng image PHP với FPM (FastCGI Process Manager) làm base image
FROM php:8.2-fpm

# Cài đặt các phần mềm phụ thuộc cho Laravel
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    git \
    libssl-dev \
    libxml2-dev \
    curl \
    libzip-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql opcache

# Cài đặt Composer (trình quản lý phụ thuộc PHP)
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Thiết lập thư mục làm việc cho Laravel
WORKDIR /var/www

# Sao chép tất cả mã nguồn vào container
COPY . .

# Cài đặt các phụ thuộc PHP bằng Composer
RUN composer install --no-interaction

# Cấu hình thư mục lưu trữ và quyền cho Laravel
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Expose port 9000 để Laravel có thể chạy
EXPOSE 9000

# Chạy PHP-FPM cho Laravel
CMD ["php-fpm"]
