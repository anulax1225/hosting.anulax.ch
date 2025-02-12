FROM ubuntu:latest

WORKDIR /app


RUN apt -y update
RUN apt -y upgrade
RUN apt install -y default-jre wget 
RUN wget https://piston-data.mojang.com/v1/objects/4707d00eb834b446575d89a61a11b5d548d8c001/server.jar
RUN echo 'eula=true' > eula.txt

VOLUME [ "/app" ]

ENTRYPOINT ["java", "-Xmx2048M", "-Xms1024M", "-jar", "./server.jar", "nogui"]
 