
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

## previews

Companies \
![image](https://user-images.githubusercontent.com/22372509/135702908-0217a1a4-7a3b-4f6c-b574-e063e0e0abb4.png)

Employees \
![screencapture-127-0-0-1-8000-employees-2021-10-02-10_47_55](https://user-images.githubusercontent.com/22372509/135702740-fa7db26f-d4e7-4dec-96ec-15d43cc1c892.png)
