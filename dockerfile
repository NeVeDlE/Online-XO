FROM php:8.2-fpm-alpine

# Install required packages and PHP extensions
RUN apk add --no-cache bash mysql-client libpng-dev libjpeg-turbo-dev libwebp-dev \
    freetype-dev nodejs npm curl git icu-dev libxml2-dev

RUN docker-php-ext-install pdo pdo_mysql mysqli pcntl

# Set working directory
WORKDIR /var/www/html

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy application code
COPY . .

# Set proper permissions
RUN chown -R www-data:www-data /var/www/html

EXPOSE 9000
CMD ["php-fpm"]
