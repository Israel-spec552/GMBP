FROM php:8.3-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git supervisor unzip curl libpng-dev libonig-dev libxml2-dev libzip-dev gnupg2 \
  && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_pgsql mbstring xml zip bcmath gd

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

# Copy application code (mounted as volume in docker-compose)
COPY ./backend /var/www

# Install Composer dependencies (you may prefer to run composer install outside container during build)
RUN composer install --no-interaction --no-dev --optimize-autoloader || true

# Supervisor
COPY backend/deploy/supervisor/laravel-worker.conf /etc/supervisor/conf.d/laravel-worker.conf

EXPOSE 9000

CMD ["/usr/bin/supervisord", "-n", "-c", "/etc/supervisor/supervisord.conf"]
