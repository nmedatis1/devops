FROM debian:latest
MAINTAINER admin@edatis.com

## APACHE ##

RUN apt-get update && apt-get install -y curl apache2 php5 libapache2-mod-php5 php5-mysql supervisor
RUN rm -rf /var/www/html/*
COPY website/* /var/www/html/
EXPOSE 80

## MYSQL ##
RUN echo "mysql-server mysql-server/root_password password rootpass" | debconf-set-selections && \
    echo "mysql-server mysql-server/root_password_again password rootpass" | debconf-set-selections && \
    apt-get install -y mysql-server

COPY websql/carsdb.sql /tmp/dump.sql
RUN /bin/bash -c "/usr/bin/mysqld_safe &" && \
    sleep 3 && \
    mysql -uroot -prootpass -e "CREATE DATABASE mydb" && \
    mysql -uroot -prootpass mydb < /tmp/dump.sql

## SUPERVISOR ##

COPY supervisord/supervisord.conf /etc/supervisor/conf.d/supervisord.conf
CMD ["/usr/bin/supervisord"]

# clean packages
RUN apt-get clean
RUN rm -rf /var/cache/apt/archives/* /var/lib/apt/lists/*
