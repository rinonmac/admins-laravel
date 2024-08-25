# Use the official PHP 8.2 image with Alpine Linux 3.20.2
FROM php:8.2-alpine3.20

# Set the working directory in the container to /app
WORKDIR /app

# Copy the current directory contents into the container at /app
COPY . /app

# Install necessary dependencies
RUN apk update && apk add --no-cache \
    libzip-dev \
    zip \
    unzip \
    libpng-dev \
    libjpeg-turbo-dev \
    libfreetype6-dev \
    locales \
    libpq-dev \
    libxml2-dev \
    libxslt-dev \
    libicu-dev \
    libssl-dev \
    libmcrypt-dev \
    libreadline-dev \
    libonig-dev \
    libzip-dev \
    zlib1g-dev \
    git \
    curl \
    wget \
    nano \
    && rm -rf /var/cache/apk/*

# Install the pgsql extension
RUN docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo_pgsql

# Install dependencies using Composer
RUN composer install

# Set the default command to run when the container starts
CMD ["php", "artisan", "serve", "--host=0.0.0.0"]
