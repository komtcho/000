# 000 Project

Fleet-management system

## install

### install on the local server

- Clone this project `git clone https://github.com/komtcho/000.git`
- Install dependencies `composer install`
- Create env file `cp .env.example .env` and update your database information
- Migrate database and dummy data `php artisan migrate --seed`
- Run app `php artisan serve`

### Install via docker

- Clone this project `git clone https://github.com/komtcho/000.git`
- Install dependencies `composer install`
- Use `Laravel sail` You an run `./vendor/bin/sail up`
- To destroy running container run `./vendor/bin/sail down​`

### Testing

You can test Features by run `php artisan test`

Thanks.