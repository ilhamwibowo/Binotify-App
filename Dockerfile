FROM php:8.0-apache
RUN apt-get update -y && apt-get install -y libxml2-dev && docker-php-ext-install mysqli && docker-php-ext-enable mysqli && docker-php-ext-install soap && docker-php-ext-enable soap
COPY src/ /var/www/html
EXPOSE 80