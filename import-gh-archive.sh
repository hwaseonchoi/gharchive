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

docker exec -w /shared mongo sh -c "/usr/bin/mongo -u root -p rootpassword < init.js"

docker exec -w /shared mongo /usr/bin/mongoimport -u root -p rootpassword \
    --authenticationDatabase admin \
    --db test --collection gharchive_raw \
    --file $(date -v -1y '+%Y-%m-%d')-10.json

docker exec -w /shared mongo sh -c "/usr/bin/mongo -u root -p rootpassword < process.js"
