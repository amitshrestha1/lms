# Use the official PHP image as the base image
FROM php:8.1-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libpq-dev \
    && docker-php-ext-install pdo pdo_mysql

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/leavemgmtsys



COPY ../composer.json ../composer.lock ./

# Install PHP dependencies
RUN composer install --no-dev --prefer-dist --no-scripts --no-progress --no-interaction

# Copy application files
COPY ../ .

# Set permissions for Laravel
RUN chown -R www-data:www-data /var/www/leavemgmtsys/storage /var/www/leavemgmtsys/bootstrap/cache

# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]
