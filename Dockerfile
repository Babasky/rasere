FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    git unzip zip sqlite3 libsqlite3-dev libpng-dev libonig-dev libxml2-dev curl \
    && docker-php-ext-install pdo pdo_sqlite mbstring exif pcntl bcmath gd

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app

COPY . .

RUN composer install --no-dev --optimize-autoloader

RUN mkdir -p var && chmod -R 775 var && chown -R www-data:www-data var

CMD ["php", "-S", "0.0.0.0:8000", "-t", "public"]

RUN php bin/console doctrine:schema:create --no-interaction