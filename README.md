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

to display an error just set the `error=>true` in your data array.
All requests have an `error` var and it default to false
The HTTP code will also default to `200`

```php

    $app->get('/user/:id', function($id) use ($app) {

        //your code here

        $app->render(404,array(
                'error' => TRUE,
                'msg'   => 'user not found',
            ));
    });

```


##middleware
The middleware will set some static routes for default requests.
if you dont want to use it, you can copy this code into your bootstrap file

```php

    // Mirrors the API request
    $app->get('/return', function() use ($app) {
        $app->render(200,array(
            'method'    => $app->request()->getMethod(),
            'name'      => $app->request()->get('name'),
            'headers'   => $app->request()->headers(),
            'params'    => $app->request()->params(),
        ));
    });

    // Generic error handler
    $app->error(function (Exception $e) use ($app) {
        $app->render(500,array(
            'error' => TRUE,
            'msg'   => $e->getMessage(),
        ));
    });

    // Not found handler (invalid routes, invalid method types)
    $app->notFound(function() use ($app) {
        $app->render(400,array(
            'error' => TRUE,
            'msg'   => 'Invalid route',
        ));
    });

    // Handle Empty response body
    $app->hook('slim.after.router', function () use ($app) {
        if (strlen($app->response()->body()) == 0) {
            $app->render(500,array(
                'error' => TRUE,
                'msg'   => 'Empty response',
            ));
        }
    });


```
