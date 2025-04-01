#!/bin/bash
  # Lade die Umgebungsvariablen aus der .env Datei
  export $(grep -v '^#' .env | xargs)

  # Überprüfen, ob wp-cli bereits installiert ist
  if ! command -v wp &> /dev/null; then
    curl -O https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar
    chmod +x wp-cli.phar
    mv wp-cli.phar /usr/local/bin/wp
  fi

  # Warten, bis WordPress installiert ist
  while [ ! -f /var/www/html/wp-config.php ]; do
    echo "Warten auf WordPress-Installation..."
    sleep 5
  done

  # Überprüfen, ob der Benutzer existiert
  if ! wp user get chidraeve --path=/var/www/html --allow-root > /dev/null 2>&1; then
    wp user create chidraeve wordpress@fullstackdevelopment.de --role=administrator --user_pass=$WP_USER_PASSWORD --path=/var/www/html --allow-root
  fi

  wp plugin uninstall hello-dolly akismet --allow-root
  wp plugin install query-monitor advanced-custom-fields create-block-theme regenerate-thumbnails --activate --allow-root