#!/bin/bash
exec > /tmp/install.log 2>&1

# Update list of available packages
sudo apt-get update -y

# Install PHP
sudo apt-get install software-properties-common apt-transport-https -y
sudo add-apt-repository ppa:ondrej/php -y
sudo apt-get update
sudo apt-get upgrade
sudo apt-get install -y php7.4-fpm php7.4-mysql php7.4-common php7.4-mbstring php7.4-xml php7.4-zip php7.4-bcmath zip unzip php7.4-curl

sudo curl -sS https://getcomposer.org/installer -o ~/composer-setup.php
sudo php ~/composer-setup.php --install-dir=/usr/local/bin --filename=composer
sudo rm ~/composer-setup.php

# Configure PHP
sudo sed -i 's/^upload_max_filesize.*/upload_max_filesize = 10M/' /etc/php/7.4/fpm/php.ini
sudo sed -i 's/^post_max_size.*/post_max_size = 10M/' /etc/php/7.4/fpm/php.ini

sudo service php7.4-fpm restart

# Install Nginx
sudo apt-get install -y nginx

sudo chown -R $USER:$USER /etc/nginx
sudo cat > /etc/nginx/sites-available/default << 'EOF'
server {
    listen 80;
    listen [::]:80;

    root /var/www/html/public;

    server_name _;

    client_max_body_size 10M;

    # remove /index.php/ from URL
    if ($request_uri ~* "^(.*/)index\.php(/?)(.*)") {
        return 301 $1$3;
    }

    index index.html index.php;

    location / {
        location / {
            try_files $uri /index.php?$query_string;
        }

        # don't cache the service worker
        location = /service-worker.js {
            try_files $uri /index.php?$query_string;
        }

        # cache static files
        location ~* ^.+\.(ico|css|js|gif|jpe?g|png|woff|woff2|eot|svg|ttf|webp|mp3|midi?)$ {
            try_files $uri /index.php?$query_string;
            add_header Cache-Control "public, max-age=31536000";
        }

        # pass PHP scripts to FastCGI server
        location ~ \.php$ {
            include snippets/fastcgi-php.conf;
            fastcgi_pass unix:/var/run/php/php7.4-fpm.sock;
        }
    }
}
EOF

sudo cat > /etc/nginx/conf.d/gzip.conf << EOF
gzip_comp_level 5;
gzip_min_length 256;
gzip_proxied any;
gzip_vary on;
gzip_types
application/atom+xml
application/javascript
application/json
application/rss+xml
application/vnd.ms-fontobject
application/x-font-ttf
application/x-web-app-manifest+json
application/xhtml+xml
application/xml
font/opentype
image/svg+xml
image/x-icon
text/css
text/plain
text/x-component;
EOF

sudo chown -R root:root /etc/nginx
sudo nginx -t
sudo service nginx restart

# Install MySQL
sudo apt-get install -y mysql-server

# Configure MySQL
sudo mysql -u root <<-EOF
CREATE DATABASE laravel;
CREATE USER 'laravel'@'%' IDENTIFIED WITH mysql_native_password BY 'laravel123';
GRANT ALL PRIVILEGES ON laravel.* TO 'laravel'@'%';
EOF

# Install Node.js
curl -sL https://deb.nodesource.com/setup_16.x | sudo -E bash -
sudo apt-get install -y nodejs
