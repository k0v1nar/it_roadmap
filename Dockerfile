# Используем базовый образ с PHP 8.1 FPM
FROM php:8.1-fpm

# Устанавливаем необходимые зависимости и PHP расширения в одном RUN для уменьшения количества слоев
RUN apt-get update && apt-get install -y --no-install-recommends \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    nodejs \
    npm \
    nginx \
 && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd \
 && apt-get clean \
 && rm -rf /var/lib/apt/lists/*

# Устанавливаем Composer
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

# Копируем php.ini в контейнер
COPY php/php.ini /usr/local/etc/php/

# Устанавливаем рабочую директорию в контейнере
WORKDIR /var/www/html/

# Копируем исходный код в контейнер
COPY . .

# Устанавливаем зависимости проекта через Composer
RUN composer install --no-interaction --no-progress --optimize-autoloader

# Собираем ассеты
RUN npm ci && npm run prod

# Настраиваем права доступа
RUN chown -R www-data:www-data /var/www/html/storage/ \
 && chown -R www-data:www-data /var/www/html/bootstrap/cache \
 && chmod -R 775 /var/www/html/storage/ \
 && chmod -R 775 /var/www/html/bootstrap/cache \
 && chmod -R o+w /var/www/html/storage/ \
 && chmod -R o+w /var/www/html/bootstrap/cache

# Копируем конфигурацию Nginx в контейнер
COPY ./nginx/default /etc/nginx/sites-available/default
COPY ./nginx/nginx.conf /etc/nginx/conf.d/webserver.conf
COPY ./nginx/entrypoint.sh /etc/entrypoint.sh

RUN chmod +x /etc/entrypoint.sh

# Открываем порт 8888 для доступа к приложению
EXPOSE 8888

ENTRYPOINT ["/etc/entrypoint.sh"]