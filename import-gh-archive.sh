#!/bin/bash

set -e

FILE=docker/mongo/shared/$(date -v -1y '+%Y-%m-%d')-10.json

if [ ! -f "$FILE" ]; then
	cd docker/mongo/shared
	wget https://data.gharchive.org/$(date -v -1y '+%Y-%m-%d')-10.json.gz
	gunzip $(date -v -1y '+%Y-%m-%d')-10.json.gz
else
	echo "$FILE" exists already
fi

#docker exec mongo /usr/bin/mongoimport -u root -p rootpassword --authenticationDatabase admin --db test --collection testCollection --file 2019-05-13-10.json