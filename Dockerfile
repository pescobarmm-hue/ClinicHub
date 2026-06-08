FROM php:8.2-fpm-alpine

# Instalar extensiones de PHP y herramientas del sistema
RUN apk add --no-cache nginx wget mariadb-client postgresql-dev libpng-dev libjpeg-turbo-dev freetype-dev zip libzip-dev unzip git \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_mysql pdo_pgsql gd zip

# Instalar Composer para gestionar dependencias de Laravel
RUN curl -sS https://getcomposer.org | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www
COPY . .

# Instalar dependencias ocultando avisos de desarrollo
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Dar permisos obligatorios a las carpetas de Laravel
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Conectar el archivo de configuración de Nginx
COPY nginx.conf /etc/nginx/nginx.conf

EXPOSE 80

# Comando para limpiar caché y arrancar el servidor web
CMD ["sh", "-c", "php artisan config:cache && php artisan route:cache && php artisan migrate --force && nginx -g 'daemon off;'"]
