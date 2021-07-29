# Suno - Reading URL Feed RSS 

## Features
- Send any url feed RSS and have a summary of the main news.
    - Title
    - Date
    - Link

## Tech

Suno API uses a number of open source projects to work properly:

- [DOCKER] - Just Development environment
- [LARAVEL] - v8.52.0
- [REDIS] - v6.2.5
- [PHP] - v8.0.8

## Installation

Suno API requires 
- [PHP] (https://www.apachefriends.org/pt_br/download.html) v7.4 + to run.
- [COMPOSER] (https://getcomposer.org/download/)
- [DOCKER] (https://www.docker.com/products/docker-desktop)


#### To run project with docker:
####
1º - copy .env-example to .env

```sh
-- 2º Build images docker
docker-compose up --build 
```
```sh
3º Access root directory image laravel app
docker exec -it suno_app_1 bash
```
```sh
4º Run composer install to download dependences
composer install
```
```sh
5º Run command to resolve any permission
chown -R www-data:www-data *
```

#### To run project without docker:
####
1º - copy .env-example to .env

```sh
-- 2º Build images docker
php artisan serve 
```


Verify the deployment by navigating to your server address in
your preferred browser.
```sh
127.0.0.1:8000
```

### To test 
    - install INSOMINIA (https://insomnia.rest/download) or POSTMAN (https://www.postman.com/downloads/)

### After install, create new request
  - [GET] -> 'http://localhost:8000/api/globo/notices/list' ->  Default RSS by https://g1.globo.com/rss/g1/economia/
  - [POST] -> 'http://localhost:8000/api/rss/notices/list' | Body: { "rss_url": "https://g1.globo.com/rss/g1/economia/" }
  Body accept any url feed rss, example:
    - “rss_url”: "https://g1.globo.com/rss/g1/economia/"
    - “rss_url”: "https://noticias.r7.com/feed.xml"

### PRODUCTION TEST
  - [GET] -> 'http://ec2-3-135-191-68.us-east-2.compute.amazonaws.com/api/globo/notices/list' ->  Default RSS by https://g1.globo.com/rss/g1/economia/
  - [POST] -> 'http://ec2-3-135-191-68.us-east-2.compute.amazonaws.com/api/rss/notices/list' | Body: { "rss_url": "https://g1.globo.com/rss/g1/economia/" }
  Body accept any url feed rss, example:
    - “rss_url”: "https://g1.globo.com/rss/g1/economia/"
    - “rss_url”: "https://noticias.r7.com/feed.xml"


### To Run Unit Tests with docker
```sh
docker exec -it suno_app_1 bash
```
```sh
./vendor/bin/phpunit
```

#### IF RUN TEST RETURN "Test directory "/var/www/html/./tests/Unit" not found" RUN THIS COMMAND AND TRY AGAIN!

```sh
php artisan make:test UserTest --unit
```

### To Run Unit Tests without docker
```sh
php artisan serve
```
```sh
./vendor/bin/phpunit
```

#### IF RUN TEST RETURN "Test directory "/var/www/html/./tests/Unit" not found" RUN THIS COMMAND AND TRY AGAIN!

```sh
php artisan make:test UserTest --unit
```

## License
MIT
