FROM php:8.1-fpm

WORKDIR /var/www

ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

RUN chmod +x /usr/local/bin/install-php-extensions && sync && \
    install-php-extensions mbstring zip exif pcntl gd 

RUN apt-get update && apt-get install -y \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

RUN apt-get clean && rm -rf /var/lib/apt/lists/*

RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www

RUN mkdir -p /var/www
WORKDIR /var/www
COPY ../php_service /var/www/

COPY --chown=www:www ../php_service /var/www


RUN pecl install grpc

RUN pecl install protobuf

RUN docker-php-ext-enable grpc
RUN docker-php-ext-enable protobuf

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

USER www

EXPOSE 9000

CMD ["php-fpm"]
