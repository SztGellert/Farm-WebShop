# Farmer_WebShop

MY first CakePHP WebShop.

![alt text](docs/1.png "Products open page")
![alt text](docs/2.png "Add new product")
![alt text](docs/3.png "New product added")

## Usage

Prerequisites: docker, docker-compose

```docker-compose -f docker-compose.yml up -d```

Figure out the ip using

```docker inspect --format='{{range .NetworkSettings.Networks}}{{.IPAddress}}{{end}}'  cakeweb```


