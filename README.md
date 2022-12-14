# cbp

### Coding standards

Running PINT (linter)

```shell
./vendor/bin/pint
```

Test suite

```shell
./vendor/bin/phpunit
```

###### Note: 
For tests to work one must prepare test database:
1. Create DB called `cbp_test`
2. Temporary change used db in `.env`, set

   ```dotenv
    DB_DATABASE=cbp_test
   ```

3. Migrate and seed the DB:
    ```shell
   php artisan migrate
   php artisan db:seed
   ```
4. Set the env back to normal db

   ```dotenv
    DB_DATABASE=cbp
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
