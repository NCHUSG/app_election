# app_election 三合一選舉系統

* 目前只有報名功能

## Installation

1. git clone this repo

        git clone <url provided at right side>

2. cd this repo

        cd app_election

3. download composer, if you dont have

        curl -sS https://getcomposer.org/installer | php

4. setup database, use HeidiSQL or something to add a user and database for app_election

5. copy config files

        cp app/config/app.example.php app/config/app.php
        cp app/config/database.example.php app/config/database.php
        cp app/config/packages/sb89/recaptcha/config.example.php app/config/packages/sb89/recaptcha/config.php
        cp /example.htaccess /.htaccess

6. add values to some required field in config files

        vim app/config/app.php
        //required field: url and key

        vim app/config/database.php
        //required field: connections

        vim app/config/packages/sb89/recaptcha/config.php
        //go to https://www.google.com/recaptcha to get public_key and private_key

        vim .htaccess
        //replace "to/the/app" to the url path for this app

7. setup composer

        php composer.phar install

8. setup database table

        php artisan migrate

9. if there are no error message occurs in the process, you are all set! open the browser to check it out!

## what repos and packages implemented

* https://github.com/laravel/laravel
* https://github.com/composer/composer
* http://github.com/sb89/Recaptcha
