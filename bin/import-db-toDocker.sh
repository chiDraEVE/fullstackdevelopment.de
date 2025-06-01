#!/bin/bash

# Lade die Umgebungsvariablen aus der .env Datei
export $(grep -v '^#' .env | xargs)

# Warte, bis der MySQL-Server im Docker-Container bereit ist
while ! docker exec db_fullstack mysqladmin ping -h"$WORDPRESS_DB_HOST" --silent; do
    echo "Warten auf MySQL-Server im Docker-Container..."
    sleep 5
done

# Importiere das Datenbank-Backup in den MySQL-Container
if docker exec -i db_fullstack mysql -h"$WORDPRESS_DB_HOST" -u"$WORDPRESS_DB_USER" -p"$WORDPRESS_DB_PASSWORD" "$WORDPRESS_DB_NAME" < db/fullstackdevelopment_local_2025-02-28_17-35-05.sql; then
    echo "Datenbankimport erfolgreich"
else
    echo "Datenbankimport fehlgeschlagen"
    exit 1
fi