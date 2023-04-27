# Myan San - Ecommerce

SayAid, founded since 2018 and now 4 years ago, is a retail pharmacy company and we sold the products with reasonable price range. Now we planned to move forward as new step by the name SayAid for e-business in the future. We will sell our product with fair and reasonable price depends on market demand. We aim that people can easily buy medicine, pharmacy and consumer products from this web and app.

## Installation

Clone the repository

```bash
  git clone git_project_url
  cd my_project
```

Install all the dependencies using composer

```bash
  composer install
```

Copy the example env file and make the required configuration changes in the .env file

```bash
  cp .env.example .env
```

Generate a new application key

```bash
  php artisan key:generate
```

Run the database migrations and seeders(**Set the database connection in .env before migrating**)

```bash
  php artisan migrate --seed
```

Start the local development server

```bash
  php artisan serve
```

You can now access the server at http://localhost:8000

---

# Code overview

## Dependencies

-   [laravel-sanctum](https://laravel.com/docs/8.x/sanctum) - For api authentication using Tokens
-   [laravel-cors](https://github.com/barryvdh/laravel-cors) - For handling Cross-Origin Resource Sharing (CORS)
-   [spatie/laravel-permission](https://spatie.be/docs/laravel-permission/v5/introduction) - For associate users with roles and permissions
-   [maatwebsite/excel](https://laravel-excel.com/) - For excel export/import

## Folders

-   `app` - Contains all the Eloquent models
-   `app/Http/Controllers/Admin` - Contains all the admin controllers
-   `app/Http/Controllers/Frontend` - Contains all the fronend controllers
-   `app/Http/Controllers/Api` - Contains all the api controllers
-   `app/Http/Middleware` - Contains the frontend auth middleware
-   `app/Http/Resources` - Contains all the api resources
-   `app/Http/Helpers` - Contains the files implementing common functions
-   `app/Http/Traits` - Contains the files implementing core functions
-   `config` - Contains all the application configuration files
-   `database/factories` - Contains the model factory for all the models
-   `database/migrations` - Contains all the database migrations
-   `database/seeds` - Contains the database seeder
-   `routes` - Contains all the api routes defined in api.php file

## Tech Stack

**Frontend:** HTML, CSS, JavaScript, Bootstrap

**Server:** PHP, Laravel
