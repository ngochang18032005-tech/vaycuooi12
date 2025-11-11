# Base image PHP với Apache
FROM php:8.2-apache

# Cài đặt các extension cần thiết
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libonig-dev \
    libxml2-dev \
    zip unzip git curl \
    && docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd

# Copy project vào container
COPY . /var/www/html

# Set working directory về root project
WORKDIR /var/www/html

# Chmod storage & cache (phải làm sau COPY và trước composer)
RUN mkdir -p storage bootstrap/cache \
    && chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# Cài Composer
COPY --from=composer:2.5 /usr/bin/composer /usr/bin/composer

# Cài dependencies Laravel
RUN composer install --no-dev --optimize-autoloader

# Cấu hình Apache dùng public/ làm DocumentRoot
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|' /etc/apache2/sites-available/000-default.conf \
    && a2enmod rewrite

# Expose port
EXPOSE 80

# Start Apache
CMD ["apache2-foreground"]
