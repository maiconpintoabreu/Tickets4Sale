# Tickets4Sale

## API
The API is running in Laravel

[Click here to know how to run only the `api`](api/README.md)
## Frontend
The Frontend is running in AngularJS

[Click here to know how to run only the `frontend`](frontend/README.md)
## Docker-Composer
### With Seeding the Database
```docker-composer up --build```
#### 4 Containers will be created on this process:
* `db` - MySQL Server
* `api` - PHP Project with Laravel (This container depends on `db` to run and it will create all database structure and populate the tables)
* `frontend` - AngularJs Project with Nginx
* `ingress` - Nginx to connect (`frontend` and `api` serving a unique address)
### Without Seeding the Database
```docker-composer -f docker-composer-no-seeding.yaml up --build```
#### 4 Containers will be created on this process:
* `db` - MySQL Server
* `api` - PHP Project with Laravel
* `frontend` - AngularJs Project with Nginx
* `ingress` - Nginx to connect (`frontend` and `api` serving a unique address)