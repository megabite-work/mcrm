FROM php:8.2-fpm-alpine3.20 AS base

RUN apk add --no-cache \
    curl \
    git \
    build-base \
    zlib-dev \
    oniguruma-dev \
    autoconf \
    bash \
    zip \
    libzip-dev \
    icu-dev \
    --update linux-headers &&\
    docker-php-ext-configure intl && \
    docker-php-ext-install \
    intl \
    mysqli \
    pdo_mysql \
    mbstring \
    zip

COPY php.ini /usr/local/etc/php/php.ini

ARG PUID=1000
ARG PGID=1000

RUN apk --no-cache add shadow && \
    groupmod -o -g ${PGID} www-data && \
    usermod -o -u ${PUID} -g www-data www-data

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

FROM base AS dev

COPY xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini

RUN pecl install xdebug && docker-php-ext-enable xdebug


FROM base AS prod

COPY opcache.ini /usr/local/etc/php/conf.d/opcache.ini

RUN docker-php-ext-install opcache
