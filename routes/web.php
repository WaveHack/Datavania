<?php

use Illuminate\Routing\Router;

/** @var \Illuminate\Routing\Router $router */

$router->get('/', function () {
    return view('welcome');
});
