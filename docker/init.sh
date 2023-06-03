#!/bin/bash

# create the sqlite3 database if it does not exist yet
DB=/sqlite3/cousinsmatter.db
SCHEMA=/sqlite3/schema.sql
echo 'checking if sqlite3 db exists...'
if [ ! -f $DB ]; then
	echo 'creating empty database'
	sqlite3 $DB < $SCHEMA
	chown www-data:www-data $DB
	chmod ug+rwx /sqlite3
	chmod ug+rw $DB
fi
echo 'initialized sqlite3 db'
echo 'starting docker php entry point with apache2-foreground '"$@"
exec docker-php-entrypoint apache2-foreground "$@"
