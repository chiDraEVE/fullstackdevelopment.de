#!/bin/bash

# Set variables
BACKUP_DIR=./db
DEST_DIR=/mnt/e/OneDrive/db-dumps

# Create backup directory if it doesn't exist
mkdir -p $BACKUP_DIR

# Check if wp-cli is available
if ! command -v wp &> /dev/null; then
  echo "wp-cli is not available. Please install wp-cli."
  exit 1
fi

# Execute wp db export and save the output to a file
BACKUP_FILE=$BACKUP_DIR/fullstackdevelopment_local_$(date +%F_%H-%M-%S).sql
if wp db export $BACKUP_FILE --path=./wp ; then
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