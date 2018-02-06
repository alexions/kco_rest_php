FROM php:5.6.33-apache
RUN apt-get update
RUN apt-get install -y git unzip
RUN pecl install xdebug-2.5.0 && docker-php-ext-enable xdebug
