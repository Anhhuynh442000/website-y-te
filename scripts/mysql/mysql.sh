#!/bin/bash
MYSQL="mysql -uroot -pAbc@1234"

echo "Drop database"
$MYSQL -e "DROP DATABASE IF EXISTS phpmvc;"

echo "Create database"
$MYSQL -e "CREATE DATABASE IF NOT EXISTS phpmvc;"

echo "Import database"
$MYSQL -e "source /home/install/mysql/dump.sql;"

echo "Import sample data"
$MYSQL -e "source /home/install/mysql/sample_data.sql;"

