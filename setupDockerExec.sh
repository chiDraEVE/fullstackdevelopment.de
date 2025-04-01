#!/bin/bash
# Setze den Container-Namen
CONTAINER_NAME=fullstackdevelopment

# Führe das setupDocker.sh Skript im Docker-Container aus
docker exec -it $CONTAINER_NAME /bin/bash -c "/setupDocker.sh"