# Use PHP 8 with Apache
FROM php:8.0-apache

# Enable mod_rewrite
RUN a2enmod rewrite

# Copy all files to the Apache server root
COPY . /var/www/html/

# Set working directory
WORKDIR /var/www/html/

# Expose port
EXPOSE 80
