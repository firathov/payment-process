FROM php:8.1.13-fpm

WORKDIR /app

RUN curl -sL https://deb.nodesource.com/setup_16.x | bash - && apt-get update \
    && apt-get install -y libssl-dev libzip-dev libpng-dev wget libgmp-dev iputils-ping gcc g++ make nodejs zlib1g-dev libicu-dev\
    && rm -rf /var/lib/apt/lists/* \
    && wget -O /usr/local/bin/composer https://getcomposer.org/composer.phar \
    && chmod 755 /usr/local/bin/composer


RUN docker-php-ext-install pdo pdo_mysql zip

RUN docker-php-ext-configure intl \
    && docker-php-ext-install intl

RUN cd /app

RUN adduser --disabled-password ${USER} app-user

RUN mkdir -p /home/app-user && chown -R app-user:app-user /home/app-user \
    && chown -R app-user:app-user /app

USER app-user
