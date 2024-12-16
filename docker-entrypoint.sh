#!/bin/sh

# Install npm dependencies if they are missing
if [ ! -d "node_modules" ]; then
    echo "Installing npm dependencies..."
    npm install
fi

# Run npm build
echo "Running npm build..."
npm run build

# Start PHP-FPM process
echo "Starting PHP-FPM..."
php-fpm
