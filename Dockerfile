# Use a base PHP 8.3.12 image
FROM php:8.3.12-fpm

# Set environment variables
ARG NODE_VERSION=20  # Usando a versão LTS mais recente do Node.js

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    zip \
    unzip \
    nano \
    libpng-dev \
    libjpeg-dev \
    libonig-dev \
    libzip-dev \
    libfreetype6-dev \
    libpq-dev  # Biblioteca necessária para o PostgreSQL

# Install PHP extensions
RUN docker-php-ext-install pdo_pgsql mbstring zip exif pcntl gd

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Instalar o Laravel Installer
RUN composer global require laravel/installer

# Adicionar Composer ao PATH
ENV PATH="$PATH:/root/.composer/vendor/bin"

# Install Node.js, npm, and Yarn
RUN curl -fsSL https://deb.nodesource.com/setup_${NODE_VERSION}.x | bash - \
    && apt-get install -y nodejs \
    && npm install -g npm \
    && npm install -g yarn

# Install Xdebug
RUN pecl install xdebug && docker-php-ext-enable xdebug

# Configure Xdebug
RUN echo "xdebug.mode=${XDEBUG_MODE}" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.client_host=${XDEBUG_CLIENT_HOST}" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.client_port=9003" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

# Set working directory
WORKDIR /var/www

# Expose ports
EXPOSE 8000 9003

# Start PHP-FPM
CMD ["php-fpm"]