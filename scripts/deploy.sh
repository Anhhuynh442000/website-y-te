#!/bin/bash
cd /var/www/ || exit 1
if [ ! -d "/var/www/phpmvc" ]; then
  git clone https://huntercq8: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@github.com/trunghieu0207/phpmvc.git
  chown -R apache.apache /var/www/phpmvc
  chmod -R 755 /var/www/phpmvc
fi

cd phpmvc/ || exit 1
git fetch
git reset --hard origin/master
if [ ! -d "/var/www/phpmvc/vendor" ]; then
  composer install
else
  rm -rf vendor
  composer install
fi

if [ ! -d "/var/www/phpmvc/node_modules" ]; then
  npm install
else
  rm -rf node_modules
  npm install
fi

npm run build

if [ -f "/var/www/phpmvc/.env" ]; then
  rm -rf /var/www/phpmvc/.env
  cp -rf /var/www/phpmvc/.env.server .env || exit 1
else
  cp -rf /var/www/phpmvc/.env.server .env || exit 1
fi

sed -i 's/\'\/public\'\;/\'\;/ /var/www/phpmvc/app/Core/View/Twig.php

rm -rf /var/www/phpmvc/cache/*
chown -R apache.apache /var/www/phpmvc/public/upload

service httpd restart
