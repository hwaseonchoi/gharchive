#!/bin/bash

set -e

DEST_DIR=docker/mongo/shared
FILES="2019-04-01-10.json 2019-04-01-11.json 2019-04-01-12.json "
GREEN="\033[0;32m"
NOCOLOR="\033[0m"
echo
echo -e "${GREEN}>>> Retrieving $FILE from GH Archive...${NOCOLOR}"
echo

cd $DEST_DIR
for file in $FILES; do
    if [ ! -f "$file" ]; then
        wget https://data.gharchive.org/${file}.gz
        gunzip ${file}.gz
    else
        echo ${file} exists
    fi
done

echo
echo -e "${GREEN}>>> Initialising the MongoDB collections...${NOCOLOR}"
echo

docker exec -w /shared mongo sh -c "/usr/bin/mongo -u root -p rootpassword < init.js"

echo
echo -e "${GREEN}>>> Importing raw data into MongoDB...${NOCOLOR}"
echo

for file in $FILES; do
    docker exec -w /shared mongo /usr/bin/mongoimport -u root -p rootpassword \
        --authenticationDatabase admin \
        --db test --collection gharchive_raw \
        --file ${file}
done

echo
echo -e "${GREEN}>>> Processing raw data into gharchive collection...${NOCOLOR}"
echo

docker exec -w /shared mongo sh -c "/usr/bin/mongo -u root -p rootpassword < process.js"
