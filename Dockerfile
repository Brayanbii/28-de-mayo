FROM php:8.2-apache

RUN apt-get update && apt-get install -y git unzip libssl-dev pkg-config libcurl4-openssl-dev

RUN pecl install mongodb && docker-php-ext-enable mongodb

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

ENV COMPOSER_ALLOW_SUPERUSER=1

WORKDIR /var/www/html

COPY . .

RUN composer update --ignore-platform-req=ext-mongodb

EXPOSE 80
