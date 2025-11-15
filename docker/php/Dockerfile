FROM php:8.1-fpm

# 必要なパッケージ
RUN apt update && apt install -y \
    default-mysql-client \
    zlib1g-dev \
    libzip-dev \
    unzip \
    && docker-php-ext-install pdo_mysql zip

# composer インストール
RUN curl -sS https://getcomposer.org/installer | php \
    && mv composer.phar /usr/local/bin/composer \
    && composer self-update

WORKDIR /var/www/src
