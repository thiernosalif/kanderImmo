FROM php:7.4-apache

# Extensions PHP nécessaires
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    libzip-dev \
    unzip \
    zip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_mysql gd mbstring zip

# Activer mod_rewrite (Laravel)
RUN a2enmod rewrite

# VirtualHost
COPY docker/vhost.conf /etc/apache2/sites-available/000-default.conf

# Installer Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
