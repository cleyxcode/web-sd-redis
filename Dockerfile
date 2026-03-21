FROM php:8.2-fpm

# ── System dependencies ──────────────────────────────────────────────────────
RUN apt-get update && apt-get install -y \
    git curl zip unzip \
    libpng-dev libonig-dev libxml2-dev libzip-dev \
    libsqlite3-dev sqlite3 \
    && docker-php-ext-install \
        pdo pdo_sqlite \
        mbstring exif pcntl bcmath \
        gd zip \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# ── Composer ─────────────────────────────────────────────────────────────────
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# ── Working directory ─────────────────────────────────────────────────────────
WORKDIR /var/www

# ── Install PHP dependencies ──────────────────────────────────────────────────
COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader --no-interaction --no-scripts

# ── Copy project files ────────────────────────────────────────────────────────
COPY . .

# ── Permissions ───────────────────────────────────────────────────────────────
RUN chown -R www-data:www-data /var/www \
    && chmod -R 775 storage bootstrap/cache

EXPOSE 9000
CMD ["php-fpm"]
