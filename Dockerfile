FROM php:7-apache

RUN apt-get update -y && apt-get install libmcrypt-dev -y
RUN apt-get install -y libfreetype6-dev libjpeg62-turbo-dev && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ && docker-php-ext-install -j$(nproc) gd
RUN docker-php-ext-install mysqli
#RUN docker-php-ext-configure mcrypt && docker-php-ext-install mcrypt
RUN docker-php-ext-install pdo_mysql
#RUN docker-php-ext-install php7.0-gd

# Used for debugging, remove when done using.
RUN apt-get install vim -y

ADD ./config/000-default.conf /etc/apache2/sites-enabled/000-default.conf
ADD ./config/default-ssl.conf /etc/apache2/sites-enabled/default-ssl.conf
ADD ./config/php.ini /usr/local/etc/php/
ADD ./certs/ssl.key /etc/ssl/private/ssl.key
ADD ./certs/ssl.pem /etc/ssl/certs/ssl.pem
ADD ./certs/ca.thawte.com.crt /etc/ssl/certs/ca.thawte.com.crt

RUN a2enmod headers && a2enmod expires && a2enmod rewrite
RUN a2enmod ssl
#RUN service apache restart

#ADD ./src/* /var/www/html/
ADD ./src /var/www
#ADD ./src/public /var/www/html

WORKDIR /var/www
RUN chmod -R 777 /var/www/storage
RUN chmod -R 777 /var/www/bootstrap
RUN cd /var/www && php artisan config:clear
