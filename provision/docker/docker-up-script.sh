#!/usr/bin/env bash

# Cloning laradock
rm -rf laradock
git clone https://github.com/laradock/laradock.git
# Checkout to 7.8.0 version
cd laradock
git checkout v7.8.0
cd ..

# Copy env files
cp -v "./provision/docker/.env.example" ./.env
cp -v "./provision/docker/.env.testing.example" ./.env.testing

# Changing laradock env-example file and copy him to env
sed -i "s/MYSQL_DATABASE=default/MYSQL_DATABASE=basic_func_db/" ./laradock/env-example
sed -i "s/MYSQL_USER=default/MYSQL_USER=basic_func/" ./laradock/env-example
sed -i "s/COMPOSE_PROJECT_NAME=laradock/COMPOSE_PROJECT_NAME=basic_func/" ./laradock/env-example
cp laradock/env-example laradock/.env

# Adding config for fix the problem with auth method in MySQL v8.*
echo "default_authentication_plugin=mysql_native_password" >> laradock/mysql/my.cnf

# Go to laradock directory
cd laradock

# Run docker
docker-compose up -d --build nginx mysql
docker-compose exec workspace composer install

# Create main DB and for testing
# Create an users and giving them privileges to DBs
docker-compose exec mysql mysql --execute="
CREATE DATABASE IF NOT EXISTS basic_func_db COLLATE utf8_general_ci;
CREATE DATABASE IF NOT EXISTS basic_func_db_test COLLATE utf8_general_ci;
CREATE USER 'basic_func'@'localhost' IDENTIFIED WITH mysql_native_password BY 'secret';
GRANT ALL PRIVILEGES ON basic_func_db.* TO 'basic_func'@'localhost' WITH GRANT OPTION;
GRANT ALL PRIVILEGES ON basic_func_db_test.* TO 'basic_func'@'localhost' WITH GRANT OPTION;
CREATE USER 'basic_func'@'%' IDENTIFIED WITH mysql_native_password BY 'secret';
GRANT ALL PRIVILEGES ON basic_func_db.* TO 'basic_func'@'%' WITH GRANT OPTION;
GRANT ALL PRIVILEGES ON basic_func_db_test.* TO 'basic_func'@'%' WITH GRANT OPTION;
"

# Clear configs
docker-compose exec workspace php artisan config:clear
docker-compose exec workspace php artisan config:cache

# Run migrations and seeds
docker-compose exec workspace php artisan migrate
docker-compose exec workspace php artisan db:seed

# Clear configs
docker-compose exec workspace php artisan config:clear
docker-compose exec workspace php artisan config:cache

# Run migrations and seeds for testing DB
docker-compose exec workspace php artisan migrate --env=testing
docker-compose exec workspace php artisan db:seed --env=testing

# Create a symbolic link from "public/storage" to "storage/app/public"
docker-compose exec workspace rm -rf public/storage
docker-compose exec workspace php artisan storage:link

# Create a passport clients
#docker-compose exec workspace php artisan passport:install --force

docker-compose exec workspace bash

## Run this commands into container
## su - laradock
## cd /var/www/