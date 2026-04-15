FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    git unzip libpq-dev zip \
    && docker-php-ext-install pdo pdo_pgsql

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /workspace/src

COPY docker/php/php.ini /usr/local/etc/php/

CMD ["php-fpm"]