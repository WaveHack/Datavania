<?php

use CloudCreativity\LaravelJsonApi\Routing\ApiGroup;
use Illuminate\Http\Request;
use Illuminate\Routing\Router;

/** @var \Illuminate\Routing\Router $router */

JsonApi::register('v1', ['namespace' => 'Api\V1'], function (ApiGroup $api, Router $router) {

    $api->resource('achievements', [
        'only' => ['index', 'read'],
    ]);

});
