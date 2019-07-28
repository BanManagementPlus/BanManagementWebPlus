FROM ubuntu:latest
RUN wget -qO- https://get.docker.com/ | sh
RUN service docker start
EXPOSE 80
EXPOSE 9000
