# Challenge GH Archive Keyword for Yousign
This is a technical test given by Yousign. 
It is part of recruiting process, though, the project itself is really interesting and challenging ! 

I thank Yousign team to offer me the chance to challenge this. 

## Install & Requirements

### Prerequis
* you need docker-compose, docker, composer installed on your computer.


* In a terminal:

```bash
docker-compose build
docker-compose up
```
https://dev.to/sonyarianto/how-to-spin-mongodb-server-with-docker-and-docker-compose-2lef
* In another terminal (inside container):

```bash
docker exec -it -w /var/www php-fpm /bin/bash
composer install
```

* Exit from the container and import data from gharchive.org calling simply this scriipt on the branch:
```terminal
./import-gh-archive.sh
```

* If you want to access mongo shell to do directly query from mongodb
```bash
docker exec -it mongo /bin/sh
```

## Documentations
- [Symfony 5 & Docker](https://dev.to/martinpham/symfony-5-development-with-docker-4hj8)   
- [MongoDB with Docker](https://dev.to/sonyarianto/how-to-spin-mongodb-server-with-docker-and-docker-compose-2lef)
- [Doctrine Mongodb ODM](https://www.doctrine-project.org/projects/doctrine-mongodb-odm/en/latest/reference/introduction.html#setup)
- [MongoDB query select filter child nessted array](https://techbrij.com/mongodb-query-select-filter-child-nested-array)