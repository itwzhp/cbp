# CBP
[![Tests](https://github.com/itwzhp/cbp/workflows/Tests/badge.svg)](https://github.com/itwzhp/cbp/actions?query=workflow:"Tests")

### Coding standards

Running PINT (linter)

```shell
./vendor/bin/pint
```

Test suite

```shell
./vendor/bin/pest --parallel
```

###### Note: 
For tests to work one must prepare test database (call it `cbp_test`) and migrate and seed the DB:

```shell
php artisan migrate --database=testing
php artisan db:seed --database=testing
```

### Local development

Build assets (vite watch)

```shell
npm run dev
```

Serve the project:

```shell
php artisan serve
```

### Import data

1. Add new local database called `cbp_wp` and import mysql dump from Wordpress into it.
2. Set local envs:

```dotenv
DB_DATABASE_WP=cbp_wp
FILESYSTEM_DISK=wp_local
```

3. Run `php artisan wp:refresh`. **WARNING** - this will take down all db tables. It will fresh migrate them, seed and
   import data from `cbp_wp` database.
4. Enjoy


[API docs](ENDPOINTS.md)
