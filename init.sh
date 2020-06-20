#!/bin/bash
echo "ServerName jumpstart" >> /etc/httpd/httpd.conf
cd /srv/jumpstart/ip_demo
php composer.phar self-update
rm -f /srv/jumpstart/ip_demo/composer.lock
php composer.phar install
echo "Restoring database ..."
/etc/init.d/mysql start
sleep 5
mysql -uroot -v -e "CREATE DATABASE jumpstart;"
mysql -uroot -v -e "CREATE USER 'jumpstart'@'localhost' IDENTIFIED BY 'password';"
mysql -uroot -v -e "GRANT ALL PRIVILEGES ON *.* TO 'jumpstart'@'localhost';"
mysql -uroot -v -e "FLUSH PRIVILEGES;"
mysql -uroot -v -e "SOURCE /srv/jumpstart/sample_data/jumpstart.sql;" jumpstart
