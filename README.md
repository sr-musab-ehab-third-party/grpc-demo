# GRPC demo


To run the project you need to have [Docker](https://www.docker.com/) installed in your local machine.

#### NOTE 
building the project may take couple of minutes to install `grpc`


## Build the project 

You can run the project in 2 differnt ways:

#### 1. Using Make 
to install make on your machine you can follow these steps:

* [macOS](https://stackoverflow.com/a/56403672)
* [Linux](https://linuxhint.com/install-make-ubuntu/)

then you can run this command: ```make up_build```.

#### 2. build the project manually
You can use the follwing commands to build the project:
```
	docker-compose down
	docker-compose up --build -d
	docker-compose exec php_service rm -rf vendor composer.lock
	docker-compose exec php_service composer install --no-interaction
```

it's the equivalent for running the ```make up_build``` command but you don't need to install make.


## Use the logger service
After building the project you can go to http://localhost/ to view the testing page and use the logger service.

## MongoDB
You can use [Compass](https://www.mongodb.com/products/compass) to connect to mongo database and view the logs.

you can use this connection string directly to connect to mongo:

```mongodb://admin:password@localhost:27017/?authMechanism=DEFAULT```

