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
            'characters' => url('api/v1/character'),
            'dlcs' => url('api/v1/dlc'),
            'music' => url('api/v1/music'),
        ]]);
    });

    $router->resource('achievement', 'Api\V1\AchievementController', ['only' => ['index', 'show']]);
    $router->resource('character', 'Api\V1\CharacterController', ['only' => ['index', 'show']]);
    $router->resource('dlc', 'Api\V1\DlcController', ['only' => ['index', 'show']]);
    $router->resource('music', 'Api\V1\MusicController', ['only' => ['index', 'show']]);

});
