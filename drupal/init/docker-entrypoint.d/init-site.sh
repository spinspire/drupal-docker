#!/bin/sh

if [ ! -d vendor ]; then
  composer install
fi

if [ ! -f web/sites/default/settings.php ]; then
  cp init/settings.php web/sites/default/settings.php
fi

echo "*******************************************"
echo "*******************************************"
echo "*******************************************"
echo "If you restored from database backup files in db-init then your site should be ready."
echo "Otherwise, you can run this to initialize Drupal"
echo "         docker-compose exec php drush site-install"
echo "         docker-compose exec php drush uli"
echo "*******************************************"
echo "*******************************************"
echo "*******************************************"

#echo "PINGing web container to show you its IP"
#ping -q -4 -c 1 web