FROM ubuntu:20.04

EXPOSE 80

ARG DEBIAN_FRONTEND=noninteractive

RUN apt-get update && apt-get upgrade -y
RUN apt-get install -y software-properties-common curl git zip unzip apt-utils htop nano bash-completion sudo
RUN add-apt-repository -y ppa:ondrej/php && apt-get update -y
RUN DEBIAN_FRONTEND="noninteractive" apt-get install -y apache2 php8.3 libapache2-mod-php8.3 && service apache2 restart

RUN DEBIAN_FRONTEND="noninteractive" apt-get install -y php8.3-curl php8.3-gd php-pear php8.3-imagick php8.3-pdo \
    php8.3-mbstring php8.3-pgsql php8.3-mysql php8.3-sqlite3 php8.3-zip php8.3-gmp php8.3-bcmath \
    php8.3-common php8.3-xml php8.3-sybase php8.3-imap php-memcache php8.3-ps mcrypt php8.3-pspell \
    php8.3-snmp php8.3-tidy php8.3-xmlrpc php-xdebug

RUN a2enmod rewrite headers proxy proxy_http proxy_wstunnel && service apache2 restart

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && php composer-setup.php && \
    php -r "unlink('composer-setup.php');" && \
    mv composer.phar /usr/local/bin/composer

RUN chown -R $USER:www-data /var/www && chmod -R 755 /var/www && rm /var/www/html/index.html

WORKDIR /var/www/html

RUN composer

COPY vhost.conf /etc/apache2/sites-available/000-default.conf

CMD ["/usr/sbin/apachectl", "-D", "FOREGROUND"]