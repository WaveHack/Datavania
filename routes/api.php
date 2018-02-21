<?php

use Illuminate\Http\Request;
use Illuminate\Routing\Router;

/** @var \Illuminate\Routing\Router $router */

$router->group(['prefix' => 'v1'], function (Router $router) {

    $router->resource('achievement', 'Api\V1\AchievementController', ['only' => ['index', 'show']]);

});
