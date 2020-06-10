#!/bin/bash
echo "ServerName jumpstart" >> /etc/httpd/httpd.conf
echo "Restoring application ..."
cd /srv
git clone https://github.com/phpcl/phpcl_jumpstart_lfphp jumpstart
cd /srv/jumpstart/ip_demo
if [ -f /srv/jumpstart/ip_demo/composer.phar ]
then
    php composer.phar self-update
else
    wget https://getcomposer.org/composer.phar
fi
if [ -f /srv/jumpstart/ip_demo/composer.lock ]
then
    rm /srv/jumpstart/ip_demo/composer.lock
fi
php composer.phar install
echo "Restoring database ..."
/etc/init.d/mysql start
sleep 5
mysql -uroot -v -e "CREATE DATABASE jumpstart;"
mysql -uroot -v -e "CREATE USER 'jumpstart'@'localhost' IDENTIFIED BY 'password';"
mysql -uroot -v -e "GRANT ALL PRIVILEGES ON *.* TO 'jumpstart'@'localhost';"
mysql -uroot -v -e "FLUSH PRIVILEGES;"
mysql -uroot -v -e "SOURCE /srv/jumpstart/sample_data/jumpstart.sql;" jumpstart
echo "Configuring Apache ... "
if [ -f /srv/www ]
then
  mv /srv/www /srv/www_old
fi
ln -s -v /srv/jumpstart/ip_demo/public /srv/www
chown apache:apache /srv/www
chown -R apache:apache /srv/jumpstart/ip_demo
chmod -R 775 /srv/jumpstart/ip_demo
