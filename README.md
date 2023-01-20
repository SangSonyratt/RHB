## Development environment setup

Install dependencies

```bash
$ composer install
```

Copy sample env format and change config to your database in the .env file

```bash
$ cp .env.example .env
```

Generate key

```bash
$ php artisan key:generate
```

Migrate database

```bash
$ php artisan migrate
```

Seed default data to database users table

```bash
$ php artisan db:seed
```

```bash
$ php artisan passport:install
```

Run the project

```bash
$ php artisan serve
```
