#!/bin/bash

# Set permissions
chmod -R 777 storage/
chmod -R 777 bootstrap/cache

# Install PHP dependencies
composer install

# Generate application key
php artisan key:generate

# Run migrations and seed the database
php artisan migrate

# Execute the command provided to CMD
exec "$@"
