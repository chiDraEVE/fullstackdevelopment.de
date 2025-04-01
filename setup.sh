#!/bin/bash
if ! wp user get chidraeve --path=/var/www/html > /dev/null 2>&1; then
  wp user create chidraeve wordpress@fullstackdevelopment.de --role=administrator --user_pass=and14life --path=/var/www/html
fi

wp plugin uninstall hello-dolly akismet
wp plugin install query-monitor advanced-custom-fields --activate