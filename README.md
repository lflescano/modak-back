#Setup LARAVEL
Install dependencies
`composer install`

Copy .env.example to .env 
`cp .env.example .env`


Setup .env with your own database credentials
`DB_CONNECTION=mysql`
`DB_HOST=127.0.0.1`
`DB_PORT=3306`
`DB_DATABASE=modak`
`DB_USERNAME=modak`
`DB_PASSWORD=123456`

Generate encription token

`php artisan key:generate`

Generate jwt secret

`php artisan jwt:secret`

Run migrations with seeders

`php artisan migrate --seed`

To run tests

`php artisan test`

Is going to generate an test user and the data for each entity

`admin@admin.com / Ac123456`

Auth routes

`php artisan route:list`

In case some file didn't autoload

`composer dumpautoload`

Runserver

`php artisan serve --host=0.0.0.0 --port=8100`