# Challenge GH Archive Keyword for Yousign
This is a technical test given by Yousign. 
It is part of recruiting process, though, the project itself is really interesting and challenging ! 

I thank Yousign team to offer me the chance to challenge this. 

## Install & Requirements

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

* To access mongo shell
```bash
docker exec -it project-yousign_mongodb_container_1 /bin/sh
```

## Documentations
- [Symfony 5 & Docker](https://dev.to/martinpham/symfony-5-development-with-docker-4hj8)   
- [MongoDB with Docker](https://dev.to/sonyarianto/how-to-spin-mongodb-server-with-docker-and-docker-compose-2lef)
- [Doctrine Mongodb ODM](https://www.doctrine-project.org/projects/doctrine-mongodb-odm/en/latest/reference/introduction.html#setup)