## USER
### ADMIN
```
http://localhost:8000/panel/login
username : admin@gmail.com
pass : p@ssw0rd
```
### Customer Service Layer 1
```
http://localhost:8000/panel/login
username : csl1@gmail.com
pass : p@ssw0rd
```
### Customer Service Layer 2
```
http://localhost:8000/panel/login
username : csl2@gmail.com
pass : p@ssw0rd
```

## WITH DOCKER
### FIRST SETUP
```bash 
docker-compose build
```
```bash
docker compose run -it php chown -R www-data:www-data /var/www/html
```
```bash
docker compose run -it php chmod -R 775 /var/www/html/storage
```
```bash
cp .env.example .env
```
```bash
docker compose run php composer dump-autoload
```
```bash
docker compose run php composer update
```
```bash
docker compose run php php artisan migrate
```
```bash
docker compose run php php artisan db:seed
```
### RUN
```bash
docker compose up
```
```bash
http://localhost:8000
```
## WITHOUT DOCKER | PHP VERSION 7.4 | mysql:8.0.40
### FIRST SETUP
```bash
cp .env.example .env
```
```bash
composer update
```
```bash
php artisan migrate OR import file db_project.sql
```
```bash
php artisan db:seed
```
### RUN
```bash
php artisan serve
```
```bash
http://localhost:8000
```