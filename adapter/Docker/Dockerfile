FROM composer:2.4.3 AS composer
FROM php:8.1-cli

RUN apt-get update && \
    apt-get upgrade -y && \
    apt-get install -y git zlib1g-dev libzip-dev unzip

COPY --from=composer /usr/bin/composer /usr/bin/composer

ADD docker-entrypoint /usr/bin/

WORKDIR var/www

ENTRYPOINT ["/usr/bin/docker-entrypoint"]
