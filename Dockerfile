FROM php:8.2-apache

# 1. Install dependensi sistem terlebih dahulu, termasuk libssl-dev
RUN apt-get update && \
    apt-get install -y --no-install-recommends \
    libzip-dev \
    unzip \
    libssl-dev \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# 2. Install ekstensi PHP. 
RUN docker-php-ext-install -j$(nproc) mysqli pdo pdo_mysql zip && \
    a2enmod rewrite

# Copy project ke dalam container Apache
COPY . /var/www/html/

# Atur kepemilikan dan izin folder
RUN chown -R www-data:www-data /var/www/html

# Atur izin yang lebih aman: 755 untuk direktori dan 644 untuk file
RUN find /var/www/html -type d -exec chmod 755 {} \;
RUN find /var/www/html -type f -exec chmod 644 {} \;

# Health check untuk memastikan aplikasi berjalan
HEALTHCHECK --interval=30s --timeout=5s --start-period=10s --retries=5 \
    CMD php /var/www/html/healthcheck.php || exit 1

# Expose port 80
EXPOSE 80