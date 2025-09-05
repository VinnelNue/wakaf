FROM php:8.2-apache

# Install ekstensi yang dibutuhkan
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Copy project ke dalam container Apache
COPY . /var/www/html/

# Atur permission
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html
