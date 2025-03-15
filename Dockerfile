# Dockerfile

FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    libpq-dev \
    unzip \
    curl \
    git \
    && docker-php-ext-install pdo pdo_pgsql \
    && rm -rf /var/lib/apt/lists/*

RUN curl -sS https://getcomposer.org/installer \
    | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www

COPY src/ /var/www

RUN composer install --no-dev --no-interaction --prefer-dist

RUN php artisan config:cache

RUN chown -R www-data:www-data storage bootstrap/cache

CMD ["php-fpm"]
