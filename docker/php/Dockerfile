FROM php:8.3-fpm

ARG UID=1000
ARG GID=1000

RUN groupadd -g $GID laravel \
    && useradd -u $UID -g laravel -m laravel

RUN apt-get update && apt-get install -y \
    git \
    curl \
    netcat-openbsd \
    zip \
    unzip \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    && docker-php-ext-install pdo_mysql mbstring zip exif pcntl

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

COPY wait-for-mysql.sh /usr/local/bin/wait-for-mysql.sh
RUN chmod +x /usr/local/bin/wait-for-mysql.sh

COPY entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

RUN chown -R laravel:laravel /var/www

USER laravel

ENTRYPOINT ["entrypoint.sh"]
CMD ["php-fpm"]