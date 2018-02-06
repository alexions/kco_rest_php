FROM php:7.1.13
RUN apt-get update
RUN apt-get install -y git unzip
RUN pecl install xdebug-2.6.0 && docker-php-ext-enable xdebug
