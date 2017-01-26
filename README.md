Faceit
============================

This is a mini face detect app that utilizes Animetrics face detection API to detect faces on any image.
DIRECTORY STRUCTURE
-------------------

      assets/             contains assets definition
      commands/           contains console commands (controllers)
      config/             contains application configurations
      controllers/        contains Web controller classes
      mail/               contains view files for e-mails
      models/             contains model classes
      modules/API         contains the api for the exposing image metadata as a webservice
      runtime/            contains files generated during runtime
      tests/              contains various tests for the basic application
      vendor/             contains dependent 3rd-party packages
      views/              contains view files for the Web application
      web/                contains the entry script and Web resources



REQUIREMENTS
------------

1. Web server supports PHP 5.4.0.
2. MySQl




INSTALLATION
------------

1. Clone this repo to you local system
2. Edit the file `config/db.php` with real data, for example:

```php
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=yii2basic',
    'username' => 'root',
    'password' => '1234',
    'charset' => 'utf8',
];
```
3. Run ./yii migrate to create database 
4 . For sample data you can import faceit_2017-01-26.sql into your database


TESTING
-------

Tests are located in `tests` directory. They are developed with [Codeception PHP Testing Framework](http://codeception.com/).
By default there are 3 test suites:

- `unit`
- `functional`
- `acceptance`

Tests can be executed by running

```
composer exec codecept run
``` 

The command above will execute unit and functional tests. Unit tests are testing the system components, while functional
tests are for testing user interaction. Acceptance tests are disabled by default as they require additional setup since
they perform testing in real browser. 


### Running  acceptance tests

To execute acceptance tests do the following:  
1. Download [Selenium Server](http://www.seleniumhq.org/download/) and launch it:

    ```
    java -jar ~/selenium-server-standalone-x.xx.x.jar
    ``` 

2. (Optional) Create `faceit_tests` database and update it by applying migrations if you have them.

   ```
   tests/bin/yii migrate
   ```

   The database configuration can be found at `config/test_db.php`.


3. Start web server:

    ```
    tests/bin/yii serve
    ```

4. Now you can run all available tests

   ```
   # run all available tests
   composer exec codecept run

   # run acceptance tests
   composer exec codecept run acceptance

   # run only unit and functional tests
   composer exec codecept run unit,functional
   ```

WEB SERVICE
-----------

```
GET /images: list all users page by page;

HEAD /images: show the overview information of user listing;

GET /images/123: return the details of the user 123;

HEAD /images/123: show the overview information of images 123;

PATCH /images/123 and PUT /images/123: update the image 123;

DELETE /images/123: delete the user 123;

```


