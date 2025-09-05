FROM php:8.2-apache

# Install ekstensi yang dibutuhkan
RUN docker-php-ext-install mysqli pdo pdo_mysql && \
    a2enmod rewrite

# Install dependensi sistem yang diperlukan
RUN apt-get update && \
    apt-get install -y --no-install-recommends \
    libzip-dev \
    unzip \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Install ekstensi ZIP (jika diperlukan)
RUN docker-php-ext-install zip

# Copy project ke dalam container Apache
COPY . /var/www/html/

# Atur permission yang lebih sederhana
RUN chown -R www-data:www-data /var/www/html && \
    chmod -R 755 /var/www/html

# Health check untuk memastikan aplikasi berjalan
HEALTHCHECK --interval=30s --timeout=3s --start-period=5s --retries=3 \
    CMD curl -f http://localhost/ || exit 1

# Expose port 80
EXPOSE 80
