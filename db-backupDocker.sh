#!/bin/bash

# Set variables
CONTAINER_NAME=db_fullstack
DB_NAME=fullstackdevelopment
DB_USER=root
DB_PASSWORD=root
BACKUP_DIR=./db-dumps
DEST_DIR=/mnt/e/OneDrive/db-dumps

# Create backup directory if it doesn't exist
mkdir -p $BACKUP_DIR

# Check if Docker is available
if ! command -v docker &> /dev/null; then
  echo "Docker is not available in this environment. Please ensure Docker is installed and integrated with WSL 2."
  exit 1
fi

# Execute mysqldump inside the container and save the output to a file on the host
BACKUP_FILE=$BACKUP_DIR/fullstackdevelopment_local_$(date +%F_%H-%M-%S).sql
if docker exec $CONTAINER_NAME mysqldump -u $DB_USER --password=$DB_PASSWORD $DB_NAME > "$BACKUP_FILE";
  then
    echo "Backup completed successfully"

    # Copy the backup file to the destination directory
    if cp "$BACKUP_FILE" "$DEST_DIR"; then
      echo "Copy successful: $BACKUP_FILE to $DEST_DIR"
      # Display the output of the copy command
      ls -l "$DEST_DIR"
    else
      echo "Copy failed"
    fi
  else
    echo "Backup failed"
    exit 1
  fi