FROM php:5.6-apache

RUN apt-get update && apt-get install -y libfreetype6-dev libjpeg62-turbo-dev libmcrypt-dev libpng12-dev && docker-php-ext-install -j$(nproc) iconv mcrypt && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ && docker-php-ext-install -j$(nproc) gd mysql mysqli pdo_mysql && rm -rf /var/www/html && mkdir /var/www/public && sed -i 's/\/var\/www\/html/\/var\/www\/public/' /etc/apache2/sites-available/default-ssl.conf && sed -i 's/\/var\/www\/html/\/var\/www\/public/' /etc/apache2/sites-available/000-default.conf && chown -R www-data:www-data /var/www/public && cp /etc/apache2/mods-available/rewrite.load /etc/apache2/mods-enabled/

VOLUME ["/var/www"]

WORKDIR /var/www
