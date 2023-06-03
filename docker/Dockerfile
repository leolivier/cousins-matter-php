FROM php:8.1-apache
ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

RUN chmod +x /usr/local/bin/install-php-extensions && \
   install-php-extensions mysqli intl sockets

RUN apt update && apt upgrade -y && apt install -y sqlite3

COPY index.html cousinsmatter favicon.ico /var/www/html
COPY init.sh /usr/local/bin/init-cousinsmatter.sh
COPY schema.sql /sqlite3/schema.sql

VOLUME /sqlite3

ENTRYPOINT ["init-cousinsmatter.sh"]
