FROM ubuntu:latest

WORKDIR /app

ENV LD_LIBRARY_PATH=.

COPY ./bedrock-server-1.21.60.10.zip ./bedrock-server.zip

RUN apt -y update
RUN apt -y upgrade
RUN apt install -y 7zip curl 
RUN 7z x ./bedrock-server.zip
RUN chmod +x ./bedrock_server
RUN rm -rf ./bedrock-server.zip
VOLUME [ "/app" ]

ENTRYPOINT [ "./bedrock_server" ]
 