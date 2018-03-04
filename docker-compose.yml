FROM ubuntu:latest
MAINTAINER Brian Clincy <bclincy@gmail.com>
LABEL Description="Cutting-edge LAMP stack, based on Ubuntu latest. Includes .htaccess support and popular PHP7 features, including composer and mail() function." \
	License="Apache License 2.0" \
	Usage="docker run -d -p [HOST WWW PORT NUMBER]:80 -p [HOST DB PORT NUMBER]:3306 -v [HOST WWW DOCUMENT ROOT]:/var/www/html -v [HOST DB DOCUMENT ROOT]:/var/lib/mysql fauria/lamp" \
	Version="1.0"

RUN apt-get update
RUN apt-get upgrade -y

COPY debconf.selections /tmp/
RUN debconf-set-selections /tmp/debconf.selections

RUN apt-get install -y \
	php7.1 \
	php7.1-cli \
	php7.1-common \
	php7.1-curl \
	php7.1-dev \
	php7.1-enchant \
	php7.1-fpm \
	php7.1-gd \
	php7.1-gmp \
	php7.1-imap \
	php7.1-json \
	php7.1-ldap \
	php7.1-mcrypt \
	php7.1-mysql \
	php7.1-opcache \
	php7.1-phpdbg \
	php7.1-pspell \
	php7.1-readline \
	php7.1-recode \
	php7.1-snmp \
	php7.1-tidy \
	php7.1-xmlrpc \
	php7.1-xsl \
	php7.1-xml \
	php7.1-zip \
RUN apt-get install nginx -y
RUN apt-get install mysql-common mariadb-server mariadb-client -y
RUN apt-get install postfix -y
RUN apt-get install git nodejs npm composer nano tree vim curl ftp -y
RUN npm install -g bower grunt-cli gulp

ENV LOG_STDOUT **Boolean**
ENV LOG_STDERR **Boolean**
ENV LOG_LEVEL warn
ENV ALLOW_OVERRIDE All
ENV TZ=America/New_York
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone
ENV TERM dumb

COPY index.php /var/www/html/
COPY run-lamp.sh /usr/sbin/

RUN a2enmod rewrite
RUN ln -s /usr/bin/nodejs /usr/bin/node
RUN chmod +x /usr/sbin/run-lamp.sh
RUN chown -R www-data:www-data /var/www/html

VOLUME /var/www/html
VOLUME /var/log/httpd
VOLUME /var/lib/mysql
VOLUME /var/log/mysql

EXPOSE 80
EXPOSE 3306

CMD ["/usr/sbin/run-lamp.sh"]
