# Use the official PHP image with FPM (Alpine for minimal size)
FROM php:8.2-fpm-alpine

# Set the working directory
WORKDIR /var/www/html

# Install system dependencies and required PHP extensions
RUN apk add --no-cache \
    bash \
    mysql-client \
    libpng-dev \
    libjpeg-turbo-dev \
    libzip-dev \
    && docker-php-ext-install pdo_mysql zip gd

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy the Laravel project files
COPY . /var/www/html

# Set appropriate permissions for storage and cache directories
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Install dependencies without dev dependencies for production
RUN composer install --no-dev --optimize-autoloader

# Expose port 9000 for PHP-FPM
EXPOSE 9000

# Start PHP-FPM
CMD ["php-fpm"]
