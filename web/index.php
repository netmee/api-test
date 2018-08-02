<?php
require_once __DIR__.'/../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\ParameterBag;

$app = new Silex\Application();
$app['debug'] = true;

$users = array(
    1 => array(
        "id" => 1,
        "name" => "Leanne Graham",
        "username" => "Bret",
        "email" => "Sincere@april.biz",
        "rand" => rand(),
        "address" => array(
            "street" => "Kulas Light",
            "suite" => "Apt. 556",
            "city" => "Gwenborough",
            "zipcode" => "92998-3874",
            "geo" => array(
                "lat" => "-37.3159",
                "zipcode" => "81.1496"
            )
        )
    ),
    2 => array(
        "id" => 2,
        "name" => "Ervin Howell",
        "username" => "Antonette",
        "email" => "Shanna@melissa.tv",
        "rand" => rand(),
        "address" => array(
            "street" => "Victor Plains",
            "suite" => "Suite 879",
            "city" => "Wisokyburgh",
            "zipcode" => "90566-7771",
            "geo" => array(
                "lat" => "-43.9509",
                "zipcode" => "-34.4618"
            )
        )
    ),
    3 => array(
        "id" => 3,
        "name" => "Clementine Bauch",
        "username" => "Samantha",
        "email" => "Nathan@yesenia.net",
        "rand" => rand(),
        "address" => array(
            "street" => "Douglas Extension",
            "suite" => "Suite 847",
            "city" => "McKenziehaven",
            "zipcode" => "59590-4157",
            "geo" => array(
                "lat" => "-68.6102",
                "zipcode" => "-47.0653"
            )
        )
    )
);

$app->before(function (Request $request) {
    if (0 === strpos($request->headers->get('Content-Type'), 'application/json')) {
        $data = json_decode($request->getContent(), true);
        $request->request->replace(is_array($data) ? $data : array());
    }
});

$app->get('/users', function (Silex\Application $app) use ($users) {
    return $app->json($users);
});

$app->get('/users/{id}', function (Silex\Application $app, $id) use ($users) {
    if (!isset($users[$id])) {
        $app->abort(404, "User $id does not exist.");
    }

    $user = $users[$id];

    return  $app->json($user);
});

$app->post('/api/v1/checktoken', function (Request $request) use ($app) {
    error_log(time() . "\n", 3, __DIR__."/debug.log");
    error_log(print_r($request->request, TRUE) . "\n", 3, __DIR__."/debug.log");
    $response = array(
        "status" => "OK",
        "timestamp" => time()
    );
    return $app->json($response, 200);
});

$app->run();
