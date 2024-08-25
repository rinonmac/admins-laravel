FROM php:8.2-fpm

# Install necessary dependencies
RUN apt-get update && apt-get install -y \
    libzip-dev \
    zip \
    unzip \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    libpq-dev \
    libxml2-dev \
    libxslt1-dev \
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
    && rm -rf /var/lib/apt/lists/*

# Configure locales
RUN echo "en_US.UTF-8 UTF-8" > /etc/locale.gen && locale-gen

# Install PHP extensions
RUN docker-php-ext-configure gd --with-jpeg --with-freetype
RUN docker-php-ext-install -j$(nproc) \
    bcmath \
    intl \
    gd \
    pdo_pgsql \
    soap \
    xsl \
    zip \
    opcache

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set working directory
WORKDIR /var/www/html

# Copy project files
COPY . .

# Install project dependencies
RUN composer install --no-interaction --optimize-autoloader

# Expose port 9000
EXPOSE 9000

# Start PHP-FPM
CMD ["php-fpm"]
