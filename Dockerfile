FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
      libpq-dev \
      unzip \
      curl \
      git \
      cron \
      supervisor \
      netcat \
      && docker-php-ext-install pdo pdo_pgsql \
      && pecl install redis \
      && docker-php-ext-enable redis \
      && apt-get install -y procps \
      && rm -rf /var/lib/apt/lists/*

RUN curl -sS https://getcomposer.org/installer | php -- \
    --install-dir=/usr/local/bin \
    --filename=composer

WORKDIR /var/www

COPY src/ /var/www
RUN mkdir -p /var/www/bootstrap/cache && chmod -R 775 /var/www/bootstrap/cache

RUN php artisan config:cache

COPY cron/crontab /etc/cron.d/artisan-schedule
COPY supervisor/supervisord.conf /etc/supervisor/conf.d/supervisord.conf
RUN chmod 0644 /etc/cron.d/artisan-schedule
RUN crontab /etc/cron.d/artisan-schedule

EXPOSE 9000
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
