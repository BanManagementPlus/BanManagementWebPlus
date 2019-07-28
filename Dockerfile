FROM ubuntu:latest
RUN apt-get update
RUN apt-get install php5-fpm
RUN apt-get install nginx
RUN apt-get install git
RUN /etc/init.d/php5-fpm start
RUN rm /usr/local/lib/libgd*
RUN /etc/init.d/php5-fpm stop
RUN /etc/init.d/php5-fpm start
EXPOSE 80
EXPOSE 9000
