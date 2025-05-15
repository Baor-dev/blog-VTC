# Use PHP image with FPM
FROM php:8.2-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y unzip git curl libpq-dev libgd-dev

# Enable GD extension
RUN docker-php-ext-install gd

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www

# Copy Laravel files into container
COPY . .

# Install dependencies
RUN composer install --no-dev

# Generate application key
RUN php artisan key:generate

# Set permissions
RUN chmod -R 775 storage bootstrap/cache

# Run migrations
RUN php artisan migrate --force

# Start Laravel using PHP-FPM
CMD ["php-fpm"]
