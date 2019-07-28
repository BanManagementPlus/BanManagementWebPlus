FROM ubuntu:latest
RUN apt-get update
RUN apt-get install wget
RUN wget --version
RUN wget -qO- https://get.docker.com/ | sh
RUN service docker start
EXPOSE 80
EXPOSE 9000
