FROM php:8.2-apache

# Install ekstensi MySQL
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Copy project
COPY . /var/www/html/

# Expose port 80
EXPOSE 80

# Start Apache di foreground
CMD ["apache2-foreground"]
