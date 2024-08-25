# Use the official PHP 8.2 image with Alpine Linux 3.20.2
FROM php:8.2-alpine3.20

# Set the working directory in the container to /app
WORKDIR /app

# Copy the current directory contents into the container at /app
COPY . /app

# Install necessary dependencies
RUN apk update && apk add --no-cache \
    # Install PHP extensions
    # pdo_mysql \
     curl \
     gd \
     zip \
     bcmath \
     intl \
     xdebug \
    postgresql-dev \
    composer

# Install the pgsql extension
RUN docker-php-ext-install pdo_pgsql

# Set the default command to run when the container starts
CMD ["php", "artisan", "serve", "--host=0.0.0.0"]
