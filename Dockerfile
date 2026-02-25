FROM php:8.2-cli-bookworm

# Install system deps (zip needs libzip + zlib)
RUN apt-get update && apt-get install -y --no-install-recommends \
    git unzip \
    libzip-dev zlib1g-dev \
    && docker-php-ext-install pdo pdo_mysql pdo_sqlite zip \
    && rm -rf /var/lib/apt/lists/*

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

# Copy project
COPY . .

# Install PHP deps
RUN composer install --no-dev --optimize-autoloader

# Ensure writable dirs
RUN mkdir -p storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# Render uses $PORT
CMD php -S 0.0.0.0:${PORT} -t public