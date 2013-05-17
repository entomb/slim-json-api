#slim-jsonAPI
This is an extention to the [SLIM framework](https://github.com/codeguy/Slim) to implement json API's with great ease.


##usage
To include the middleware and view you just have to load them using the default _Slim_ way.

```php
    require 'vendor/autoload.php';

    $app = new \Slim\Slim();

    $app->view(new \JsonView());
    $app->add(new \JsonApiMiddleware());
```

after this, all your requests will be returning json output.

the usage will be `$app->render(HTTP_CODE, array DATA);`

```php

    $app->get('/', function() use ($app) {
        $app->render(200,array(
                'msg' => 'welcome to my API!',
            ));
    });

```

to export an error just set the 'error' variable in your data array

```php

    $app->get('/user/:id', function($id) use ($app) {

        //your code here

        $app->render(404,array(
                'error' => TRUE,
                'msg'   => 'user not found',
            ));
    });

```

