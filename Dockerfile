FROM php:8.0.2-apache

RUN apt-get update -y && \
    apt-get upgrade -y && \
    apt-get install -y libmcrypt-dev git zip unzip libzip-dev openssl libicu-dev libonig-dev nano

RUN docker-php-ext-configure zip \
    && docker-php-ext-configure intl \
    && docker-php-ext-configure mbstring

RUN docker-php-ext-install pdo pdo_mysql mysqli mbstring

RUN pecl install xdebug-3.0.1 && \
    docker-php-ext-enable xdebug

COPY .docker/xdebug/xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini
COPY .docker/apache/000-default.conf /etc/apache2/sites-available/000-default.conf

WORKDIR /var/www/html/api

# Get Composer!
RUN php -r "readfile('http://getcomposer.org/installer');" | php -- --install-dir=/usr/bin/ --filename=composer

# In order to use pretty URLs we need mod_rewrite to be enabled
RUN a2enmod rewrite
RUN service apache2 restart