## Laravel skeleton application

[![PHP >= 7.1+](https://img.shields.io/badge/php-%3E%3D7.1-blue.svg)](https://php.net/)

[![Build Status](https://img.shields.io/travis/ShkrutDenis/demo-laravel/master.svg?style=flat)](https://travis-ci.org/ShkrutDenis/demo-laravel?branch=master)

[![Coverage Status](https://img.shields.io/coveralls/ShkrutDenis/demo-laravel/master.svg?style=flat)](https://coveralls.io/r/ShkrutDenis/demo-laravel?branch=master)

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/ShkrutDenis/demo-laravel/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/ShkrutDenis/demo-laravel/?branch=master)

![GitHub](https://img.shields.io/github/license/ShkrutDenis/demo-laravel.svg?style=flat)

Features:
 - authorization;
 - registration;
 - verify account by link (sending to email);
 - recovery password by link (sending to email);
 - simple ACL;
 - management users (CRUD).
 
App dependencies:
 - PHP : ^7.1.3;
 - Laravel : 5.8.*;
 - Vue : ^2.5.17;
 - Vuex : ^3.0.1;
 - Element-ui: ^2.4.11;

## Getting started

### Installation

Clone repository to your local machine:

- git clone https://github.com/ShkrutDenis/demo-laravel.git

- git checkout -b develop

- git pull https://github.com/ShkrutDenis/demo-laravel.git develop

Next step, you should setup environment. You can choose environment between `vagrant` or `docker`

#### Setup environment

##### vagrant (homestead):

> Project used homestead, so first of all your need to install VirtualBox v 5.* and vagrant 2.2.*
    
1) Run bash command:
    ```
        bash ./provision/vagrant/init.sh
    ```
    > After installing homestead you will be log in into VM `(vagrant ssh)` and go to project directory `(cd code)`
    
3) Run migrations and seeders:
    ```
        php artisan migrate
        php artisan db:seed
    ```
    > All artisan commands we have to run into VM
    
4) Run setup super admin:
    ```
        php artisan setup:super-admin
    ```

5) Now you can get access to the site. Copy and past into your browser this link:
    ```
        http://130.131.132.133
    ```
    
    > You can change path or any params in Homestead.yaml in root project directory
    
##### docker (laradock v7.8.0):

1) Run bash command:
    ```
        bash ./provosion/docker/docker-up-script.sh
    ```
    > You will be logged in "workspace" docker container
    
2) Change user from root to laradock:
    ```
        su - laradock
        cd /var/www/
    ``` 
3) Now you can get access to the site. Copy and past into your browser this link:
    ```
       http://localhost
    ```
    
### Testing

> All commands must be run on the virtual machine (vagrant) or inside container (docker).

Run tests:
```
    php vendor/bin/codecept run
```
Check code style by codesniffer
```
    php vendor/bin/phpcs
```
Check copy-paste
```
    php vendor/bin/phpcpd app/
```