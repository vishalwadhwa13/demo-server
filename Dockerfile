FROM php:7.1.30-apache

LABEL maintainer="Vishal Wadhwa <vishal.wadhwa@zomato.com>"

WORKDIR .

COPY . .

ENV APACHE_DOCUMENT_ROOT /var/www/html/src/public
ENV ENV docker

RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

RUN apt-get update && apt-get install -y zip unzip libz-dev

RUN pecl install grpc-1.19.0
RUN docker-php-ext-enable grpc

RUN docker-php-ext-install bcmath

RUN (curl -sS https://getcomposer.org/installer | php) && mv composer.phar /usr/local/bin/composer
RUN composer install

RUN a2enmod rewrite

EXPOSE 80/tcp

CMD ["apachectl", "-D", "FOREGROUND"]