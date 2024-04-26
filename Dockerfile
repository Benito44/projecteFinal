# Use the official PHP 8.1 image as the base image
FROM php:8.1-apache

# Set the working directory in the container
WORKDIR /var/www/html

# Copy the application code to the container
COPY . /var/www/html

# Enable PDO MySQL extension for PHP
RUN docker-php-ext-install pdo_mysql

# Hide warnings in php
RUN echo "error_reporting = E_ALL & ~E_DEPRECATED & ~E_NOTICE" >> /usr/local/etc/php/php.ini


# Install any necessary dependencies
# RUN apt-get update && apt-get install -y \
# Add any additional dependencies here

# Expose port 80 for the web server
EXPOSE 80

# Start the Apache web server
CMD ["apache2-foreground"]