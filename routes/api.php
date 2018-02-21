<?php

use Illuminate\Http\Request;
use Illuminate\Routing\Router;

/** @var \Illuminate\Routing\Router $router */

// API discoverability
$router->get('/', function (Request $request) {
    return json_encode(['apis' => [
        'v1' => ['link' => url('api/v1'), 'status' => 'current'],
    ]]);
});

$router->group(['prefix' => 'v1'], function (Router $router) {

    // API discoverability
    $router->get('/', function (Request $request) {
        return json_encode(['resources' => [
            'achievements' => url('api/v1/achievement'),
            'dlcs' => url('api/v1/dlc'),
        ]]);
    });

    $router->resource('achievement', 'Api\V1\AchievementController', ['only' => ['index', 'show']]);
    $router->resource('dlc', 'Api\V1\DlcController', ['only' => ['index', 'show']]);

});
