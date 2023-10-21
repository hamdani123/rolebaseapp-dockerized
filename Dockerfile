FROM php:8.1-fpm as php

RUN apt-get update -y
RUN apt-get install -y unzip libpq-dev libcurl4-gnutls-dev
RUN docker-php-ext-install pdo pdo_mysql bcmath

RUN pecl install -o -f redis \
    && rm -rf /tmp/pear \
    && docker-php-ext-enable redis

WORKDIR /var/www/html/app
COPY . .

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

#ENV PORT=8000
#ENTRYPOINT [ "docker/entrypoint.sh" ]

# ==============================================================================
#  node
FROM node:14-alpine as node

WORKDIR /var/www/html/app
COPY . .

RUN rm -rf /var/www/html/app/package-lock.json

RUN npm install --global cross-env
RUN npm install

RUN npm run build

VOLUME /var/www/html/app/node_modules

# ==============================================================================
#  nginx

FROM nginx:stable-alpine as nginx

# Copies nginx configurations to override the default.
ADD ./docker/nginx/*.conf /etc/nginx/conf.d/
ADD ./docker/nginx/conf.d/ssl/* /etc/nginx/ssl/

# Make html directory
RUN mkdir -p /var/www/html/app

