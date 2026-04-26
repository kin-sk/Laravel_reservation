FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    git unzip libpq-dev zip libicu-dev \
    && docker-php-ext-install pdo pdo_pgsql intl

# Node.jsのインストール (Vite/Jetstream用)
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /workspace

COPY docker/php/php.ini /usr/local/etc/php/

CMD ["php-fpm"]