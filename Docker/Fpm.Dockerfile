FROM php:fpm-alpine

RUN set -ex \
    && apk --no-cache add postgresql-dev yarn\
    && docker-php-ext-install pgsql pdo_pgsql

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/amoCRM
