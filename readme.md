# app_election 三合一選舉系統

* 目前只有報名功能

## Installation

1. git clone this repo

        git clone <url provided at right side>

2. cd this repo

        cd app_election

3. download composer, if you dont have

        curl -sS https://getcomposer.org/installer | php

4. setup composer

        php composer.phar install

5. setup database, use HeidiSQL or something to add a user and database for app_election

6. copy config files

        cp app/config/app.example.php app/config/app.php
        cp app/config/database.example.php app/config/database.php
        cp app/config/packages/sb89/recaptcha/config.example.php app/config/packages/sb89/recaptcha/config.php

7. add values to some required field in config files

        vim app/config/app.php
        //required field: url and key

        vim app/config/database.php
        //required field: connections

        vim app/config/packages/sb89/recaptcha/config.php
        //go to https://www.google.com/recaptcha to get public_key and private_key

8. setup database table

        php artisan migrate


## what repos and packages implemented

* https://github.com/laravel/laravel
* https://github.com/composer/composer
* http://github.com/sb89/Recaptcha
