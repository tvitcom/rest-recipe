# REST-RECIPE

Web application for recipes with rest api on user and recipe items.
Using [FlightPHP microframework](http://flightphp.com/learn), and two items/tables in database PostgreSQL.

For example #1, we can create GET request:
```
https://recipe/iface_v01/author/select?apikey=96cae35ce8a9b0244178bf28e4966c2ce1b8385723a96a6b838858cdd6ca0a1e
```
and recieve the json responce:
```
{"context":"\/iface_v01\/author\/select?apikey=96cae35ce8a9b0244178bf28e4966c2ce1b8385723a96a6b838858cdd6ca0a1e","result":
{"id":"1","name":"tester","email":"test1@test.test","pass_hash":"HxqWlNprnK0WzV9VmNmk97RGyXjlHbNg3eHdBvPq6R","api_key":"96cae35ce8a9b0244178bf28e4966c2ce1b8385723a96a6b838858cdd6ca0a1e","ts_create":"1519480215","ts_update":"1519480215","recover_key":""}
,"error":null}
```
Example #2 send GET with:
```
https://recipe/iface_v01/recipe/selectLast?apikey=96cae35ce8a9b0244178bf28e4966c2ce1b8385723a96a6b838858cdd6ca0a1e
```
and will get responce:
```
{"context":"\/iface_v01\/recipe\/selectLast?apikey=96cae35ce8a9b0244178bf28e4966c2ce1b8385723a96a6b838858cdd6ca0a1e","result":
[{"id":"6","author_id":"1","ts_create":"2018-02-27 05:22:55","title":"Special bsod recipe6","content":"Add some picture and voila","picture_uri":"a2657576604f8a70dfaf990ece77dcd3.png","is_enable":"1"},
{"id":"1","author_id":"1","ts_create":"2018-02-27 05:22:42","title":"Test title1","content":"Best of the best recipe in the world!!!","picture_uri":"123.jpg","is_enable":"1"},
{"id":"4","author_id":"1","ts_create":"2018-02-26 12:13:36","title":"Some recipe4","content":"Some some text in recipe4","picture_uri":"8a296e96b19ebf244fd3440b37569b991.jpg","is_enable":"1"},
{"id":"5","author_id":"1","ts_create":"0000-00-00 00:00:00","title":"Some recipe5","content":"Text about 5 recipes.","picture_uri":"0","is_enable":"1"},
{"id":"7","author_id":"1","ts_create":"0000-00-00 00:00:00","title":"Some title3","content":"Some text3","picture_uri":"0","is_enable":"1"}
],"error":null}
```
Example #3 we can send POST request with valid api_key:
```
Content-Type: multipart/form-data; boundary=---------------------------4542569731976795272962283586
Content-Length: 753

-----------------------------4542569731976795272962283586
Content-Disposition: form-data; name="apikey"

96cae35ce8a9b0244178bf28e4966c2ce1b8385723a96a6b838858cdd6ca0a1e
-----------------------------4542569731976795272962283586
Content-Disposition: form-data; name="id"

3
-----------------------------4542569731976795272962283586
Content-Disposition: form-data; name="title"

Some title321
-----------------------------4542569731976795272962283586
Content-Disposition: form-data; name="content"

Some text3214
-----------------------------4542569731976795272962283586
Content-Disposition: form-data; name="filename"; filename=""
Content-Type: application/octet-stream


-----------------------------4542569731976795272962283586--


```
and recieve some jsonify responce:
```
{"context":"\/iface_v01\/recipe\/updateOwn","result":1,"error":null}
```
All examples above from entry of some records in my test database. You can put some text records and get similar responses.

# INSTALL:
If you’re using Composer, you can run the following command:
```
curl -sS https://getcomposer.org/installer | /usr/bin/php;
/usr/bin/php composer.phar update
```
and you will create local database:"recipe" and approciate user:"recipe" with passwod:"pass_to_recipe"
and then load recipe.sql to database.
Then create dir in webroot server location:
```
mkdir -m 0750 filestorage    
```
And you'll be insert appropriate settings to models/config.php file.
If you finish and see index page with aside menu, you may register few tests users, create examples recipes and click some test link in aside menu. 

## Routes using inteface:

```
URL:       | Method:| REST-link:
----------------------------------------
/iface_v01/   [GET]  author/selectById
/iface_v01/   [GET]  author/selectByEmail
/iface_v01/   [GET]  author/selectByApikey
/iface_v01/   [POST] author/login
/iface_v01/   [POST] author/create
/iface_v01/   [GET]  recipe/selectLast
/iface_v01/   [GET]  recipe/selectById
/iface_v01/   [GET]  recipe/selectByAuthorId
/iface_v01/   [POST] recipe/create
/iface_v01/   [POST] recipe/updateOwn
/iface_v01/   [POST] recipe/deleteOwn
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
