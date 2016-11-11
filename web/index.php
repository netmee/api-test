<?php
require_once __DIR__.'/../vendor/autoload.php';

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

$app->run();
