FROM php:8.1-alpine

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

RUN apk add --no-cache --update git linux-headers $PHPIZE_DEPS \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug \
    && apk del $PHPIZE_DEPS
