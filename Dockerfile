# Gunakan image resmi PHP versi 8.2 CLI
FROM php:8.2-cli

# Install dependensi sistem & ekstensi PHP
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

# Install Composer secara global
RUN curl -sS https://getcomposer.org/installer | php && \
    mv composer.phar /usr/local/bin/composer

# Set direktori kerja di dalam container
WORKDIR /var/www

# Salin semua file aplikasi Laravel ke container
COPY . .

# Install dependensi Laravel
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Pastikan permission storage dan bootstrap/cache benar (opsional)
RUN chown -R www-data:www-data storage bootstrap/cache && \
    chmod -R 775 storage bootstrap/cache

# Buka port 8000 untuk Laravel Artisan serve
EXPOSE 8000

# Jalankan Laravel menggunakan artisan serve
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
