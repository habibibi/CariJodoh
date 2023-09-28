FROM php:8.0-apache

WORKDIR /var/www/html

COPY src/public/index.php /var/www/html

EXPOSE 80