cd code

cp -i provision/vagrant/.env.example .env
cp -i provision/vagrant/.env.testing.example .env.testing

rm -rf public/storage
php artisan storage:link

composer install

php artisan migrate

php artisan db:seed

mysql --execute="
CREATE DATABASE homestead_test COLLATE utf8_general_ci;
GRANT ALL PRIVILEGES ON homestead_test.* TO 'homestead'@'localhost' WITH GRANT OPTION;
GRANT ALL PRIVILEGES ON homestead_test.* TO 'homestead'@'%' WITH GRANT OPTION;
"

php artisan migrate --env=testing

php artisan db:seed --env=testing
