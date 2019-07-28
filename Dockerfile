FROM ubuntu:latest
RUN sudo apt-get update
RUN sudo apt-get install python-software-properties 
RUN sudo add-apt-repository ppa:yola/php5
RUN sudo apt-get update
RUN sudo apt-get install apt-get install php5-fpm
RUN sudo apt-get install nginx
RUN sudo apt-get install git
RUN sudo /etc/init.d/php5-fpm start
RUN sudo rm /usr/local/lib/libgd*
RUN sudo /etc/init.d/php5-fpm stop
RUN sudo /etc/init.d/php5-fpm start
EXPOSE 80
EXPOSE 9000