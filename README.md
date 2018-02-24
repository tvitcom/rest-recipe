# REST-RECIPE

Web application for recipes with rest api on user and recipe items.
Using [FlightPHP microframework](http://flightphp.com/learn), and two items/tables in database PostgreSQL.

# INSTALL:
If you’re using Composer, you can run the following command:
```
curl -sS https://getcomposer.org/installer | /usr/bin/php;
/usr/bin/php composer.phar update
```

## Routes using inteface:

```
URL: | Method: | REST-link:
---------------------------
/   [POST]  author/login
/   [GET]   author/select
/   [POST]  author/create
/   [POST]  author/update
/   [POST]  recipe/create
/   [GET]   recipe/select
/   [POST]  recipe/update
/   [POST]  recipe/delete
---------------------------

 //REST Api will return json-string like:
 
    {
        "context":"",
        "result":{},
        "error":[]
    }
```
