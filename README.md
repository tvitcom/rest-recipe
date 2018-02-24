# REST-RECIPE

Web application for recipes with rest api on user and recipe items.
Using [FlightPHP microframework](http://flightphp.com/learn), and two items/tables in database PostgreSQL.

For example, we can create GET request:
```
https://recipe/iface_v01/author/select?apikey=96cae35ce8a9b0244178bf28e4966c2ce1b8385723a96a6b838858cdd6ca0a1e
```
and recieve the json responce:
```
{"context":"\/iface_v01\/author\/select?apikey=96cae35ce8a9b0244178bf28e4966c2ce1b8385723a96a6b838858cdd6ca0a1e","result":{"id":"1","name":"tester","email":"test1@test.test","pass_hash":"HxqWlNprnK0WzV9VmNmk97RGyXjlHbNg3eHdBvPq6R","api_key":"96cae35ce8a9b0244178bf28e4966c2ce1b8385723a96a6b838858cdd6ca0a1e","ts_create":"1519480215","ts_update":"1519480215","recover_key":""},"error":null}
```
for example we can send POST request without valid api_key:
```

```
and recieve some jsonify responce:
```

```

# INSTALL:
If you’re using Composer, you can run the following command:
```
curl -sS https://getcomposer.org/installer | /usr/bin/php;
/usr/bin/php composer.phar update
```
and you will create local database:"recipe" and approciate user:"recipe" with passwod:"pass_to_recipe"
and then load recipe.sql to database.

## Routes using inteface:

```
URL:       | Method:| REST-link:
----------------------------------------
/iface_v01/   [POST]  author/login
/iface_v01/   [POST]  author/create
/iface_v01/   [GET]   recipe/selectLast
/iface_v01/   [POST]  recipe/createOwn
/iface_v01/   [POST]  recipe/updateOwn
/iface_v01/   [POST]  recipe/deleteOwn
----------------------------------------
//REST Api will receive POST or GET REQUEST string like:

[
    "apikey":"api_key_string",
    ...
]

//REST Api will return json-string like:
 
    {
        "context":"",
        "result":"",
        "error":""
    }
```
