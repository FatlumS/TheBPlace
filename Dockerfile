# Use the official PHP image from Docker Hub
FROM php:8.0-apache

# Set the working directory inside the container
WORKDIR /var/www/html

# Copy all files from the local directory to the container
COPY . .

# Expose the Apache HTTP server port
EXPOSE 80
