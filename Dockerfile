# Use official PHP + Apache image
FROM php:8.3-apache

# Install PHP extensions you might need (mysqli, pdo, etc.)
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Copy project files into Apache's web root
COPY . /var/www/html/

# Expose port 80 for Render
EXPOSE 80
