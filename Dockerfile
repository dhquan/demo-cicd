# 1. Sử dụng PHP 8.2 FPM (Bạn có thể đổi thành 8.1 hoặc 8.3 tùy project)
FROM php:8.2-fpm

# 2. Cài đặt các thư viện hệ thống cần thiết
# Lưu ý: autoconf, pkg-config, libssl-dev là BẮT BUỘC để cài Redis
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    autoconf \
    pkg-config \
    libssl-dev

# 3. Dọn dẹp cache apt để giảm dung lượng Image
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# 4. Cài đặt các PHP Extension cơ bản cho Laravel
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# 5. CÀI ĐẶT REDIS EXTENSION (Quan trọng)
# Tải về từ PECL và kích hoạt nó
RUN pecl install redis && docker-php-ext-enable redis

# --- THÊM ĐOẠN NÀY ĐỂ CÀI NODE.JS ---
RUN curl -fsSL https://deb.nodesource.com/setup_22.x | bash -
RUN apt-get install -y nodejs

# 6. Cài đặt Composer mới nhất
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 7. Thiết lập thư mục làm việc
WORKDIR /var/www

# 8. Copy toàn bộ code vào trong container
# (Lưu ý: Khi dev bằng docker-compose, volume sẽ ghi đè lên cái này,
# nhưng bước này cần thiết cho quy trình Build Production sau này)
COPY . /var/www

# 9. Đổi quyền sở hữu thư mục cho user www-data (User mặc định của php-fpm)
RUN chown -R www-data:www-data /var/www

RUN composer install --no-interaction --optimize-autoloader --no-dev

# 10. Expose cổng 9000 để Nginx kết nối vào
EXPOSE 9000

# 11. Lệnh chạy mặc định
CMD ["php-fpm"]
