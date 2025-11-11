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

# Set working directory
WORKDIR /var/www/html

# Chmod storage & cache
RUN chown -R www-data:www-data storage bootstrap/cache

# Install Composer
COPY --from=composer:2.5 /usr/bin/composer /usr/bin/composer

# Install dependencies
RUN composer install --no-dev --optimize-autoloader

# Expose port
EXPOSE 80

# Start Apache
CMD ["apache2-foreground"]
