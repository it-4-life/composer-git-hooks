FROM composer:1.8

WORKDIR /app

COPY ./composer.json ./composer.lock /app/

# Remove any scripts that have cghooks since it is not yet present in the container
RUN sed -i -E '/\.\/cghooks .*/d' composer.json

RUN composer install

COPY . /app/

RUN composer check-style
RUN composer test
RUN ./cghooks add
