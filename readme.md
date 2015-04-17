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
        cp app/config/app_const.example.php app/config/app_const.php
        cp app/config/database.example.php app/config/database.php
        cp app/config/packages/sb89/recaptcha/config.example.php app/config/packages/sb89/recaptcha/config.php
        cp /example.htaccess /.htaccess

6. add values to some required field in config files

        vim app/config/app.php
        //required field: debug, url, key, timezone

        vim app/config/database.php
        //required field: connections

        vim app/config/packages/sb89/recaptcha/config.php
        //go to https://www.google.com/recaptcha to get public_key and private_key

        vim .htaccess
        //replace "to/the/app" to the url path for this app

        vim app/config/app_const.php
        // replace Timestamp_allowRegis, Timestamp_allowRegisEnd to the start/end registration time by http://www.epochconverter.com/
        // set ForceAllowRegis to true to ignore Timestamp_allowRegis, Timestamp_allowRegisEnd
        // set time_table_info with html tags, this is the "選舉日程" content
        // set contact_info with html tags, this is the "聯絡選委會" content
        //
        // To enable admin login, you need to create a group under ilt (https://ilt.nchusg.org) and get the developer OAuth2 identity
        // Give ilt "[Your website base url]/oauth" for "Redirect URIs"
        // fill up ilt_key, ilt_secret, ilt_authorized_group and set enable_login to true to enable

7. setup composer

        php composer.phar install

8. setup database table

        php artisan migrate

9. if there are no error message occurs in the process, you are all set! open the browser to check it out!

## what repos and packages implemented

* https://github.com/laravel/laravel
* https://github.com/composer/composer
* http://github.com/sb89/Recaptcha
