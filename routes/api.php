<?php

use CloudCreativity\LaravelJsonApi\Routing\ApiGroup;
use Illuminate\Http\Request;
use Illuminate\Routing\Router;

/** @var \Illuminate\Routing\Router $router */

$router->group(['prefix' => 'api'], function (Router $router) {

    // API discoverability, yay
    $router->get('/', function (Request $request) {
        return json_encode(['apis' => [
            'v1' => ['link' => url('api/v1'), 'format' => 'JSON API'],
        ]]);
    });

    $router->get('/v1', function (Request $request) {
        return json_encode(['resources' => [
            'achievements' => url('api/v1/achievements'),
        ]]);
    });

});

JsonApi::register('v1', ['namespace' => 'Api\V1'], function (ApiGroup $api, Router $router) {

    $api->resource('achievements', [
        'only' => ['index', 'read'],
    ]);

});
