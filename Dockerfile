FROM rosti/php:5.4
MAINTAINER Mryan2005
WORKDIR ../BanManagementWebPlus
RUN php -S 127.0.0.1:80
EXPOSE 80