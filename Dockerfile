cat > Dockerfile <<'EOF'
FROM php:8.2-apache

# Install required PHP extensions
RUN docker-php-ext-install pdo_mysql

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Set working directory
WORKDIR /var/www/html

# Copy all project files
COPY . .

# Set permissions for uploads directory
RUN mkdir -p uploads && chmod 777 uploads

# Set proper ownership
RUN chown -R www-data:www-data /var/www/html

# Configure Apache to listen on the port defined by $PORT (Render sets this)
RUN echo "Listen \${PORT:-8080}" > /etc/apache2/ports.conf && \
    sed -i 's/VirtualHost \*:80/VirtualHost *:\${PORT:-8080}/g' /etc/apache2/sites-available/000-default.conf

# Expose the port
EXPOSE 8080

# Start Apache
CMD ["apache2-foreground"]

# Configure Apache
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Use port 8080 for Render
ENV PORT=8080
EXPOSE 8080

# Start Apache
CMD ["apache2-foreground"]
EOF

# Create .dockerignore
cat > .dockerignore <<'EOF'
.git
.gitignore
README.md
.dockerignore
deploy.sh
*.log
*.md
.vscode
.idea
EOF

# Push to GitHub
git add Dockerfile .dockerignore
git commit -m "Fixed PHP Dockerfile for Render"
git push origin main

echo "✅ Dockerfile fixed and pushed!"
