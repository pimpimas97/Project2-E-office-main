# Gunakan image PHP 8.2 berbasis Debian
FROM php:8.2-fpm

# Install paket sistem dan ekstensi PHP yang dibutuhkan (intl, zip, pdo_mysql, dll)
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    libzip-dev \
    libicu-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    && docker-php-ext-install \
        intl \
        zip \
        pdo_mysql \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Set direktori kerja di dalam container
WORKDIR /var/www

# Salin semua file dari direktori lokal ke dalam container
COPY . .

# Install Composer secara global
RUN curl -sS https://getcomposer.org/installer | php && \
    mv composer.phar /usr/local/bin/composer

# (Opsional) Atur GitHub token untuk menghindari rate limit GitHub
# ENV COMPOSER_AUTH='{"github-oauth": {"github.com": "your_github_token_here"}}'

# Install dependensi PHP dari composer.lock
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# (Opsional) Atur permission Laravel (jika pakai Laravel)
# RUN chown -R www-data:www-data /var/www && chmod -R 775 storage bootstrap/cache

# Expose port default PHP-FPM
EXPOSE 9000

# Jalankan PHP-FPM ketika container dijalankan
CMD ["php-fpm"]
