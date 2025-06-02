FROM php:8.2-cli

# Install dependensi sistem dan ekstensi PHP
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zip \
    curl \
    libzip-dev \
    libicu-dev \
    libonig-dev \
    libxml2-dev \
    && docker-php-ext-install \
        intl \
        zip \
        pdo_mysql \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php && \
    mv composer.phar /usr/local/bin/composer

# Set direktori kerja
WORKDIR /var/www

# Salin semua file dari lokal ke dalam container
COPY . .

# Install dependensi Laravel
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Expose port Laravel
EXPOSE 8000

# Jalankan Laravel saat container dijalankan
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
