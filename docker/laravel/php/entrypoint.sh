#!/bin/bash

#/usr/bin/supervisord -c /etc/supervisor/supervisord.conf

chmod -R 777 /var/www/html/storage
chmod -R 777 /var/www/html/bootstrap/cache

php-fpm