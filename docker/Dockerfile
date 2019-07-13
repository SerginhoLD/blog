FROM php:7.3.6-apache
# install: curl, json, mbstring, fileinfo, openssl, pcre, pdo_sqlite

# docker build -f docker/Dockerfile -t serginhold/blog:latest .
# docker exec -i -t blog-phalcon bash -c "cd /var/www; bash"

RUN apt-get update \
    # apache
    && a2enmod rewrite \
    # php extensions
    && docker-php-ext-configure opcache --enable-opcache \
    && docker-php-ext-install \
        opcache \
        gettext \
    && pecl install xdebug-2.7.2 \
    && docker-php-ext-enable xdebug
