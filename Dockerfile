FROM ubuntu:latest
RUN apt-get update
RUN echo "y" | apt-get install wget
RUN wget --version
RUN wget -qO- https://get.docker.com/ | sh
RUN service docker start
RUN apt-get install -y php5
RUN php -v
EXPOSE 80
EXPOSE 9000
