# Challenge GH Archive Keyword for Yousign
This is a technical test given by Yousign. 
It is part of recruiting process, though, the project itself is really interesting and challenging ! 

I thank Yousign team to offer me the chance to challenge this. 

## Install & Requirements

### Prerequis
* you need [docker-compose](https://docs.docker.com/compose/install/), [docker](https://docs.docker.com/engine/install/), 
[composer](https://getcomposer.org/download/) and [gunzip](https://g.co/kgs/3gfDp5) installed on your computer.

### Install
* In a terminal:

```bash
docker-compose build
docker-compose up
```

* In another terminal (inside container):

```bash
docker exec -it -w /var/www php-fpm /bin/bash
cd var/www/
composer install
```

### Import data

* Exit from the container and import data from gharchive.org calling simply this scriipt on the branch:
```terminal
./import-gh-archive.sh
```

* If you want to access mongo shell to do directly query from mongodb
```bash
docker exec -it mongo /bin/sh
```

## Test
Go to http://localhost:81/search and try with any keywords. 

## Architecture
![diagram](http://www.plantuml.com/plantuml/proxy?cache=no&src=https://raw.githubusercontent.com/hwaseonchoi/project-yousign/master/architecture.puml)

- Use of MongoDB to store, process and query github archive json data
- Use of docker to power a application platform together with nginx, php-fpm and mongo images
- Importation of data with shell script and cli commands
- Front app with PHP & Symfony 5

## Documentations
- [Symfony 5 & Docker](https://dev.to/martinpham/symfony-5-development-with-docker-4hj8)   
- [MongoDB with Docker](https://dev.to/sonyarianto/how-to-spin-mongodb-server-with-docker-and-docker-compose-2lef)
- [mongodb/mongodb - Lib for PHP](https://github.com/mongodb/mongo-php-library)
- [Doctrine Mongodb ODM](https://www.doctrine-project.org/projects/doctrine-mongodb-odm/en/latest/reference/introduction.html#setup)
- [MongoDB query select filter child nessted array](https://techbrij.com/mongodb-query-select-filter-child-nested-array)