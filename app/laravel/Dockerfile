FROM node:18-bullseye AS node_builder

# Install specific npm version (10.3.0)
RUN npm install -g npm@10.3.0

WORKDIR /var/www

# Laravel base
FROM php:8.2-cli

# Accept UID and GID from build args
ARG UID
ARG GID

# Install dependencies
RUN apt-get update && apt-get install -y \
    unzip \
    git \
    curl \
    libzip-dev \
    zip \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libcurl4-openssl-dev \
    && docker-php-ext-install pdo_mysql zip

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install Node.js & NPM
COPY --from=node_builder /usr/local /usr/local

# Create non-root user matching host UID/GID
RUN groupadd -g ${GID} appgroup \
    && useradd -m -u ${UID} -g appgroup appuser

WORKDIR /var/www

# Use the non-root user
USER appuser

# 1. Install composer dependencies
# 2. Install npm dependencies (VITE)
# 3. Build the vite assets for production
# 4. Start Laravel server
CMD ["sh", "-c", "composer install && npm install && npm run build && php artisan serve --host=0.0.0.0 --port=8000"]
