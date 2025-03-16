FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
      libpq-dev \
      unzip \
      curl \
      git \
      cron \
      supervisor \
      netcat-openbsd \
      && docker-php-ext-install pdo pdo_pgsql \
      && pecl install redis \
      && docker-php-ext-enable redis \
      && apt-get install -y procps \
      && rm -rf /var/lib/apt/lists/*
COPY src/ /var/www
WORKDIR /var/www
RUN mkdir -p /var/www/bootstrap/cache /var/www/storage/logs && \
    chmod -R 775 /var/www/bootstrap/cache /var/www/storage/logs
RUN curl -sS https://getcomposer.org/installer | php -- \
    --install-dir=/usr/local/bin \
    --filename=composer



COPY cron/crontab /etc/cron.d/artisan-schedule
COPY supervisor/supervisord.conf /etc/supervisor/conf.d/supervisord.conf
RUN chmod 0644 /etc/cron.d/artisan-schedule
RUN crontab /etc/cron.d/artisan-schedule

EXPOSE 9000
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
