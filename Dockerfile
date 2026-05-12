FROM php:8.2-apache

# Install mysqli extension
RUN docker-php-ext-install mysqli pdo_mysql

# Enable rewrite module
RUN a2enmod rewrite

# Set permissions and create a test file
RUN rm -rf /var/www/html/* && \
    echo '<?php echo "<h1>Working!</h1><p>Server is running correctly.</p>"; ?>' > /var/www/html/index.php && \
    chown -R www-data:www-data /var/www/html && \
    chmod -R 755 /var/www/html

# Copy your files (will overwrite the test file)
COPY . /var/www/html/

# Fix permissions for all files
RUN chown -R www-data:www-data /var/www/html && \
    chmod -R 755 /var/www/html && \
    chmod 644 /var/www/html/index.php 2>/dev/null || true && \
    find /var/www/html -type d -exec chmod 755 {} \; && \
    find /var/www/html -type f -name "*.php" -exec chmod 644 {} \;

EXPOSE 80
CMD ["apache2-foreground"]