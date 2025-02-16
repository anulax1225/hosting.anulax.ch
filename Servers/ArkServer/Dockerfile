FROM ubuntu:latest 

WORKDIR /app

COPY ./run.sh ./run.sh

RUN apt -y update
RUN apt -y upgrade

RUN apt -y install sudo software-properties-common
RUN dpkg --add-architecture i386
RUN apt-add-repository multiverse
RUN apt -y update
RUN echo steam steam/question select "I AGREE" | sudo debconf-set-selections
RUN echo steam steam/license note '' | sudo debconf-set-selections
RUN apt install -y steamcmd lib32gcc-s1
RUN echo "fs.file-max=100000" > /etc/sysctl.conf
RUN echo "* soft nofile 100000" > /etc/security/limits.conf
RUN echo "* hard nofile 100000" > /etc/security/limits.conf
RUN echo "session required pam_limits.so" > /etc/pam.d/common-session

RUN useradd -m ark
RUN chown -R ark:ark .
RUN sudo -u ark -s

RUN chmod +x ./run.sh
RUN ulimit -n 100000
RUN /usr/games/steamcmd +force_install_dir /app +login anonymous +app_update 376030 validate +exit
#RUN chmod +x ./ShooterGame/Binaries/Linux/ShooterGameServer


ENTRYPOINT [ "./run.sh" ]