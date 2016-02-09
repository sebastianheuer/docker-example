FROM php:7.0.2-fpm

RUN docker-php-ext-install pdo pdo_mysql

COPY php/php.ini /usr/local/etc/php/
COPY . /srv/meetup-service

CMD ["php-fpm"]
