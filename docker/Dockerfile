FROM Docker.dafiti.io/tricae/web:php7-rabbit
MAINTAINER Luiz Fumes <lcfumes@gmail.com>

RUN apt-get update
RUN apt-get install -y php-pear 

RUN pecl install mongodb

RUN echo extension=mongodb.so > /etc/php/7.0/cli/conf.d/mongodb.ini
RUN echo extension=mongodb.so > /etc/php/7.0/fpm/conf.d/mongodb.ini

WORKDIR /catalog

EXPOSE 80

CMD ["/usr/bin/supervisord"]
