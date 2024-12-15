FROM php:8.2-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copy composer files first to leverage Docker cache
COPY composer.* ./

# Install dependencies
RUN composer install --no-scripts --no-autoloader

# Create necessary directories and set permissions
RUN mkdir -p /var/www/html/bootstrap/cache /var/www/html/storage \
    && chown -R www-data:www-data /var/www/html/bootstrap/cache /var/www/html/storage \
    && chmod -R 775 /var/www/html/bootstrap/cache /var/www/html/storage

# Copy the rest of the application
COPY . .

# Generate optimized autoloader
RUN composer dump-autoload --optimize

# Final permissions setup
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html

EXPOSE 8000

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]