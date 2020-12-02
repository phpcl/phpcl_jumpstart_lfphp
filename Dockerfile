FROM asclinux/linuxforphp-8.2-ultimate:7.4-nts
MAINTAINER doug.bierer@etista.com
RUN git clone https://github.com/phpcl/phpcl_jumpstart_lfphp /srv/jumpstart
RUN chmod +x /srv/jumpstart/init.sh
RUN /srv/jumpstart/init.sh
RUN \
  cd /srv && \
  mv -f -v /srv/www /srv/www.OLD && \
  ln -s -f -v /srv/jumpstart/ip_demo/public /srv/www
RUN chown apache:apache /srv/www
RUN chown -R apache:apache /srv/jumpstart
RUN chmod -R 775 /srv/jumpstart
CMD lfphp --mysql --phpfpm --apache
