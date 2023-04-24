# Mono wallet

Mono wallet is a demo (test) application built in Laravel 10, for the purposes of portfolio enrichment

Application doesn't have GUI. It has 4 endpoints + fake login endpoint added as a simple mechanism for assigning a user to a promotion.

## Tech stack:

-   [Laravel 10](https://laravel.com/docs/10.x)
-   PHP 8.1
-   MySQL
-   Docker

## Endpoints

1.  **GET** /api/backoffice/promotion-codes

    Returns all promotios (with relationships).

2.  **GET** /api/backoffice/promotion-codes/{id}

    Returns a single promotion (with relationships).

3.  **POST** /api/backoffice/promotion-codes

    Creates a new promotion. Request body parameters are:

    ```
    {
        "start_date": "2021-12-18 18:30",
        "end_date": "2022-12-18 18:30",
        "amount": 500,
        "quota": 5
    }
    ```

4.  **POST** /api/assign-promotion (sanctum protected, **Reqests $header['Authorization']['Bearer']**)

    Assign user to a promotion.

    Prior to calling this endpoint, you must call the 'fake login' method, which will only create and retrieve access token so you can call this route.

5.  **POST** /api/login

    Requests for user token. The request body parameters are:

    ```
    {
        "username": {{ find any username in DB::table('users') }}
    }
    ```

## Starting instructions

Here is the [link](https://github.com/dev-domagojsamardzic/mono-wallet) to the public git repo.

1.  Clone the project into local repository. In my case, name of the repository is `mono-wallet`

```
git clone git@github.com:dev-domagojsamardzic/mono-wallet.git mono-wallet
```

`cd mono-wallet`

2.  Run this command to build initial application's dependencies. See more [here](https://laravel.com/docs/10.x/sail#installing-composer-dependencies-for-existing-projects)

```
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php82-composer:latest \
    composer install --ignore-platform-reqs
```

3.  Set up .env file. For initial setup, it is enough to copy .env.example:

`cp .env.example .env`

4.  Generate APP_KEY

`sail artisan key:generate`

4. Run container (you can run it in detached mode, by setting `-d` flag at the end of command)

`sail up -d`

5. Run migrations and seeders

`sail artisan migrate --seed`

You are good to go!
