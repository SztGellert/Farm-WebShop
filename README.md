# Farmer_WebShop

MY first CakePHP WebShop.

![alt text](docs/home.png "WebShop Open Page")
![alt text](docs/products.png "Products")
![alt text](docs/orders.png "Orders")
![alt text](docs/daily.png "Orders/Daily View")

## Usage

Prerequisites: docker, docker-compose

```docker-compose -f docker-compose.yml up -d```

Figure out the ip using

```docker inspect --format='{{range .NetworkSettings.Networks}}{{.IPAddress}}{{end}}'  cakeweb```


