FROM php:7.3.6-apache
# isset: curl, json, mbstring, fileinfo, openssl, pcre, pdo_sqlite

# docker build -f docker/Dockerfile -t serginhold/blog-phalcon:latest .
# docker exec -i -t 7ada6ae6bfa3 bash

ENV PHALCON_VERSION=3.4.4
ENV PHALCON_DEVTOOLS_VERSION=3.4.2

RUN apt-get update \
    # apache
    && a2enmod rewrite \
    # Install various PHP extensions
    && docker-php-ext-configure opcache --enable-opcache \
    && docker-php-ext-install \
        opcache \
        gettext \
    && pecl install xdebug-2.7.2 \
    && docker-php-ext-enable xdebug

# cphalcon
RUN curl -LO https://github.com/phalcon/cphalcon/archive/v${PHALCON_VERSION}.tar.gz \
    && tar xzf v${PHALCON_VERSION}.tar.gz \
    && docker-php-ext-install ${PWD}/cphalcon-${PHALCON_VERSION}/build/php7/64bits \
    && rm -rf v${PHALCON_VERSION}.tar.gz cphalcon-${PHALCON_VERSION}

# devtools
RUN curl -LO https://github.com/phalcon/phalcon-devtools/archive/v${PHALCON_DEVTOOLS_VERSION}.tar.gz \
    && tar xzf v${PHALCON_DEVTOOLS_VERSION}.tar.gz \
    && mv phalcon-devtools-${PHALCON_DEVTOOLS_VERSION} /usr/local/phalcon-devtools \
    && ln -s /usr/local/phalcon-devtools/phalcon /usr/local/bin/phalcon \
    && chmod ugo+x /usr/local/bin/phalcon \
    && rm -f v${PHALCON_DEVTOOLS_VERSION}.tar.gz
