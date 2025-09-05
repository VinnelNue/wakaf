FROM php:8.2-apache

RUN docker-php-ext-install mysqli pdo pdo_mysql

COPY . /var/www/html/
# Tambahkan healthcheck
HEALTHCHECK --interval=10s --timeout=5s --start-period=5s --retries=3 \
  CMD curl -f http://localhost/healthcheck.php || exit 1

  
EXPOSE 80
CMD ["apache2-foreground"]
