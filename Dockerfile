FROM php:8.4-cli

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zip \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    nodejs \
    npm \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app

COPY . .

RUN rm -f public/hot

RUN composer install --no-interaction --prefer-dist --optimize-autoloader
RUN npm install
RUN npm run build

RUN ls -la public/build

RUN mkdir -p storage/framework/sessions storage/framework/views storage/framework/cache storage/logs bootstrap/cache
RUN chmod -R 777 storage bootstrap/cache public/build

CMD php artisan config:clear && php artisan view:clear && php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=${PORT}