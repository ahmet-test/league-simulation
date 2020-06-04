# League Simulation

![](presentation.gif)

## Project Structure

https://dbdiagram.io/d/5ed7a14439d18f5553002d75

## Build

Containers Runs with Modifying Environment Settings

```shell script
cp src/.env.example src/.env
```

install composer globally and our project using this command

```shell script
docker run --rm -v $(pwd)/src/:/app composer install
```

Run docker containers

````shell script
docker-compose up -d
````

---

### Key Generate

````shell script
docker-compose exec app php artisan key:generate
````

### Make Migrate

````shell script
docker-compose exec app php artisan migrate
````

### Run Seeder

````shell script
docker-compose exec app php artisan db:seed --class=TeamTableSeeder
````

### Create Cache
````shell script
docker-compose exec app php artisan config:cache
````
