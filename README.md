# cbp

### Coding standards

Running PINT

```shell
./vendor/bin/pint
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

#### Files

If you want to test files on local env, download all directories from `wp-content/uploads` into `storage/wp/` directory.

For file links to work on local environment one must create symbolic link from storage to public directory. Just run helper command:

```shell
php artisan wp:storage
```
## API

Go to:

[API docs](ENDPOINTS.md)
