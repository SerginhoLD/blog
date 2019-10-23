FROM php:7.3.10-fpm-alpine

# docker build -f docker/php/Dockerfile -t serginhold/blog:latest .
# docker exec -i -t blog bash -c "cd /var/www; bash"

# https://github.com/Docker-Hub-frolvlad/docker-alpine-bash/blob/master/Dockerfile    bash
# https://github.com/prooph/docker-files/blob/master/php/7.1-fpm                      php-ext

RUN apk --update add bash

# php
RUN apk --update add --no-cache --virtual build-php $PHPIZE_DEPS \
    && docker-php-ext-configure opcache --enable-opcache \
    && docker-php-ext-install \
        opcache \
        #gettext \
    && pecl install xdebug-2.7.2 \
    && docker-php-ext-enable xdebug \
    && apk del build-php

# composer
RUN curl -o /tmp/composer-setup.php https://getcomposer.org/installer \
&& curl -o /tmp/composer-setup.sig https://composer.github.io/installer.sig \
# Make sure we're installing what we think we're installing!
&& php -r "if (hash('SHA384', file_get_contents('/tmp/composer-setup.php')) !== trim(file_get_contents('/tmp/composer-setup.sig'))) { unlink('/tmp/composer-setup.php'); echo 'Invalid installer' . PHP_EOL; exit(1); }" \
&& php /tmp/composer-setup.php --no-ansi --install-dir=/usr/local/bin --filename=composer --snapshot \
&& rm -f /tmp/composer-setup.*
