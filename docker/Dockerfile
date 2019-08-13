FROM php:7.3.6-apache
# install: curl, json, mbstring, fileinfo, openssl, pcre, pdo_sqlite

# docker build -f docker/Dockerfile -t serginhold/blog:latest .
# docker exec -i -t blog bash -c "cd /var/www; bash"

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

# composer
RUN curl -o /tmp/composer-setup.php https://getcomposer.org/installer \
&& curl -o /tmp/composer-setup.sig https://composer.github.io/installer.sig \
# Make sure we're installing what we think we're installing!
&& php -r "if (hash('SHA384', file_get_contents('/tmp/composer-setup.php')) !== trim(file_get_contents('/tmp/composer-setup.sig'))) { unlink('/tmp/composer-setup.php'); echo 'Invalid installer' . PHP_EOL; exit(1); }" \
&& php /tmp/composer-setup.php --no-ansi --install-dir=/usr/local/bin --filename=composer --snapshot \
&& rm -f /tmp/composer-setup.*
