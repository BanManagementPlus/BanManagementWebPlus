FROM ubuntu:latest
RUN apt-get update
RUN echo "y" | apt-get install wget
RUN wget --version
RUN wget https://windows.php.net/downloads/releases/archives/php-5.4.0-src.zip && unzip php-5.4.0-src.zip
RUN service docker start
RUN echo "y" | apt-get install -y make gcc g++ curl libxml2 libxml2-dev libssl-dev libcurl4-openssl-dev libjpeg-dev libpng12-dev bzip2 libbz2-dev libxpm-dev libfreetype6-dev libedit-dev libxslt-dev 
RUN echo "y" | apt install apache2
RUN echo "y" | apt-get install php5.4
RUN php -v
EXPOSE 80
EXPOSE 9000
