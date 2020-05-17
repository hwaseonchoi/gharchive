#!/bin/bash

set -e

FILE=docker/mongo/shared/$(date -v -1y '+%Y-%m-%d')-10.json
GREEN="\033[0;32m"
NOCOLOR="\033[0m"
echo
echo -e "${GREEN}>>> Retrieving $FILE from GH Archive...${NOCOLOR}"
echo

if [ ! -f "$FILE" ]; then
	cd docker/mongo/shared
	wget https://data.gharchive.org/$(date -v -1y '+%Y-%m-%d')-10.json.gz
	gunzip $(date -v -1y '+%Y-%m-%d')-10.json.gz
else
	echo "$FILE" exists already
fi

echo
echo -e "${GREEN}>>> Initialising the MongoDB collections...${NOCOLOR}"
echo

docker exec -w /shared mongo sh -c "/usr/bin/mongo -u root -p rootpassword < init.js"

echo
echo -e "${GREEN}>>> Importing raw data into MongoDB...${NOCOLOR}"
echo

docker exec -w /shared mongo /usr/bin/mongoimport -u root -p rootpassword \
    --authenticationDatabase admin \
    --db test --collection gharchive_raw \
    --file 2019-05-14-10.json \
    --file 2019-05-15-10.json \
    --file $(date -v -1y '+%Y-%m-%d')-10.json

echo
echo -e "${GREEN}>>> Processing raw data into gharchive collection...${NOCOLOR}"
echo

docker exec -w /shared mongo sh -c "/usr/bin/mongo -u root -p rootpassword < process.js"
