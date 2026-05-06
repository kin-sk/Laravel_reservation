FROM php:8.2-fpm

# 必要なパッケージのインストール (intl用の libicu-dev を追加)
RUN apt-get update && apt-get install -y \
    nginx \
    git \
    unzip \
    libpq-dev \
    libicu-dev \
    && docker-php-ext-install pdo pdo_pgsql intl

# Node.jsのインストール (CSSビルド用)
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www
# ソースコードのコピー
COPY ./src /var/www

# ライブラリとCSSのビルド
RUN composer install --no-dev --optimize-autoloader
RUN npm install && npm run build

# 権限設定
RUN mkdir -p storage/framework/cache \
    storage/framework/sessions \
    storage/framework/views \
    bootstrap/cache \
 && chown -R www-data:www-data storage bootstrap/cache \
 && chmod -R 775 storage bootstrap/cache

# PHP-FPMポート修正
RUN sed -i 's|listen = .*|listen = 9000|' /usr/local/etc/php-fpm.d/www.conf

# nginx設定(Dockerfileからの相対パス)
COPY ./docker/nginx/default.conf /etc/nginx/conf.d/default.conf
RUN ln -sf /etc/nginx/sites-available/default /etc/nginx/sites-enabled/default

EXPOSE 8080

CMD ["sh", "-c", "php-fpm -D && nginx -g 'daemon off;'"]