# Docker Demo

Contains a sample PHP application that can be run in a Docker container.

## Requirements

- Docker installed and running (make sure to check [https://docs.docker.com/engine/installation/mac/](https://docs.docker.com/engine/installation/mac/) if you are using a Mac)

## Setup

1. Clone this repository and change into the cloned directory
2. Run ```docker-compose up -d``` to start all containers
3. Sending a GET Request to ```http://<docker-host>/``` should give you this response body:
```
{
    message: "Hello World"
}
```

If you are on a Mac, you need to use the IP address of your Docker machine, which usually is ```192.168.99.100```.