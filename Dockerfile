FROM php:8.1.4-apache-bullseye

RUN apt update \
    &&  apt-get install -y \
    libzip-dev \
    zip \
    && docker-php-ext-install zip

WORKDIR /var/www/html

ENV APACHE_DOCUMENT_ROOT=/var/www/html/app/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN curl -sS https://get.symfony.com/cli/installer | bash
RUN mv /root/.symfony/bin/symfony /usr/local/bin/symfony