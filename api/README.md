# Tickets4Sale
## Requirements
* PHP 7.1.3+
* php-mysql
* composer 1.9.0
* MySQL Database
## Drivers Configuration
To configurate a database or any other drivers just update the file [`.env`](.env)
#### Sample 
```
DB_CONNECTION=mysql // Driver
DB_HOST=127.0.0.1 // Host address
DB_PORT=3306 // Port
DB_DATABASE=tickets4sale // Database Sample
DB_USERNAME=root // User Sample
DB_PASSWORD=Tickets4Sale123 // Password Sample
```

## Creating and Populating the Database use Artisan

### Create Database (Required)
```php artisan mysql:createdb```
### Create Tables (Required)
```php artisan migrate```
### Populate Tables
```php artisan migrate --seed````

## Creating and Populating the Database importing from a file
To import to a file you will need to have access to the database and run this [`tickets4sale.sql`](tickets4sale.sql)

## Start
```php artisan serve``