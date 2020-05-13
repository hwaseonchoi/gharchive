#!/bin/bash

FILE=tmp/$(date -v -1y '+%Y-%m-%d')-10.json

if [ ! -f "$FILE" ]; then
	mkdir tmp
	cd tmp
	wget https://data.gharchive.org/$(date -v -1y '+%Y-%m-%d')-10.json.gz
	gunzip $(date -v -1y '+%Y-%m-%d')-10.json.gz
else
	echo "$FILE" exists already
fi

