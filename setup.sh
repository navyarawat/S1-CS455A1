#!/bin/bash

# Update Package Index
sudo apt update

# Install Apache2, MySQL, PHP
sudo apt install apache2 mysql-server php php-mysql libapache2-mod-php php-cli

# Allow to run Apache on boot up
sudo systemctl enable apache2

# Restart Apache Web Server
sudo systemctl start apache2

# Adjust Firewall
sudo ufw allow in "Apache Full"

# Allow Read/Write for Owner
sudo chmod -R 0755 /var/www/html/

# Create info.php for testing php processing
sudo echo "<?php phpinfo(); ?>" > /var/www/html/info.php


cp -rf ./Webpage /var/www/html/CS455A1

cd /var/www/html/CS455A1
php -f install.php
php -f index.php
php -f results.php

xdg-open "http://localhost/CS455A1/index.php"
xdg-open "http://localhost/CS455A1/results.php"

