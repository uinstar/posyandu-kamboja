FROM php:8.3-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    curl \
    git \
    libzip-dev \
    libpq-dev \
    libcurl4-openssl-dev \
    libssl-dev \
    libicu-dev \
    nano \
    && docker-php-ext-install intl pdo pdo_mysql pdo_pgsql mbstring exif pcntl bcmath gd zip \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:2.8 /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy application
COPY . .

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Laravel permissions (opsional tapi disarankan)
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Expose port 8080
EXPOSE 8080

CMD ["/entrypoint.sh"]
