FROM php:8.2-fpm-alpine

# Install required packages, Node.js, and npm
RUN apk add --no-cache bash mysql-client libpng-dev libjpeg-turbo-dev libwebp-dev \
    freetype-dev nodejs npm curl git

# Set working directory
WORKDIR /var/www/html

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy application
COPY . .

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Install Node.js dependencies and build assets
RUN npm install && npm run build

# Permissions
RUN chown -R www-data:www-data /var/www/html

EXPOSE 9000
CMD ["php-fpm"]
