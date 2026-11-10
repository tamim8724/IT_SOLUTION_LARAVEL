FROM php:8.2-cli-bookworm

RUN apt-get update && apt-get install -y --no-install-recommends \
    git unzip \
    libzip-dev zlib1g-dev \
    sqlite3 libsqlite3-dev pkg-config libpq-dev libssl-dev \
    && docker-php-ext-install pdo pdo_mysql pdo_sqlite pdo_pgsql zip \
    && pecl install mongodb \
    && docker-php-ext-enable mongodb \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www
COPY . .

# MongoDB package: if composer.lock doesn't have it yet, add it here (no need to run composer on your PC)
RUN if grep -q '"name": "mongodb/laravel-mongodb"' composer.lock; then \
        composer install --no-dev --optimize-autoloader --no-interaction; \
    else \
        composer update mongodb/laravel-mongodb --with-dependencies --no-dev --optimize-autoloader --no-interaction; \
    fi

RUN mkdir -p storage/framework/sessions storage/framework/views storage/framework/cache/data storage/logs bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# Create/upgrade database tables on every start, then serve
CMD php artisan migrate --force && php -S 0.0.0.0:${PORT} -t public