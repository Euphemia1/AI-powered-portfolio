# Use official PHP runtime with Apache
FROM php:8.2-apache

# Install system dependencies and PHP extensions
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install mbstring exif pcntl bcmath gd

# Install and configure Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy the PHP configuration file
COPY backend/ /var/www/html/

# Copy the built frontend files
COPY public/ /var/www/html/

# Make sure the public directory is properly set up
RUN rm -rf /var/www/html/public/* || true

# Copy frontend build (this will be done during build process)
# For now, we'll set up the directory structure
RUN mkdir -p /var/www/html/public

# Copy .env file if it exists
COPY .env* /var/www/html/ 2>/dev/null || true

# Set up Apache document root to point to public directory
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

# Configure Apache to handle PHP files
RUN echo '<?php
// Check if the requested file exists
if (file_exists($_SERVER["DOCUMENT_ROOT"] . $_SERVER["REQUEST_URI"])) {
    return false; // serve the requested file as-is
} else {
    // Forward all other requests to index.php
    include_once "index.php";
}' > /var/www/html/.htaccess

# Set the port for Google Cloud Run
ENV PORT 8080

# Expose port 8080
EXPOSE 8080

# Set up Apache to run on port 8080
RUN sed -i 's/80/8080/g' /etc/apache2/ports.conf
RUN sed -i 's/:80/:8080/g' /etc/apache2/sites-available/000-default.conf

# Enable Apache modules
RUN a2enmod rewrite

# Start Apache in foreground
CMD ["apache2-foreground"]