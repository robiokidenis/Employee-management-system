
## Project for test GR Tech

how to install

```composer install```

copy .env.example to .env

```cp .env.example .env```

generate key

```php artisan key:generate```

migrate with seeding

```php artisan migrate --seed ```

create storage link

```php artisan storage:link```

##  feature

- using custom middleware to check role (basic and very simple)
- template using adminlte
- email notification to company when new employee added ( dont forget to set MAIL_MAILER in .env using mailtrap or logs)