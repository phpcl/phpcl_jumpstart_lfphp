#
# PHP-CL JumpStart LfPHP
#

# Pull base image.
FROM asclinux/linuxforphp-8.2-ultimate:7.4-nts

# Init database + web server config
RUN echo "Restoring application ..."
RUN git clone https://github.com/phpcl/phpcl_jumpstart_lfphp /srv/jumpstart
RUN chmod +x /srv/jumpstart/init.sh
RUN /srv/jumpstart/init.sh
ENTRYPOINT ["/bin/lfphp"]
CMD ["--mysql", "--phpfpm", "--apache"]