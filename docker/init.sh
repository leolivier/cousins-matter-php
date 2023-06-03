#!/bin/bash

# create the sqlite3 database if it does not exist yet
DB=/sqlite3/cousinsmatter.db
SCHEMA=/sqlite3/schema.sql
test -f $DB || sqlite3 $DB < $SCHEMA

exec docker-php-entrypoint "$@"
