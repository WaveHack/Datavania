<?php

use App\Http\Controllers\Api\SearchController;
use Illuminate\Http\Request;
use Illuminate\Routing\Router;

/** @var \Illuminate\Routing\Router $router */

$router->get('search', [SearchController::class, 'index']);

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
            'chapters' => url('api/v1/chapter'),
            'characters' => url('api/v1/character'),
            'dlcs' => url('api/v1/dlc'),
            'items' => url('api/v1/item'),
            'music' => url('api/v1/music'),
        ], 'other' => [
            'item-types' => url('api/v1/item-types'),
        ]]);
    });

    $router->resource('achievement', 'Api\V1\AchievementController', ['only' => ['index', 'show']]);
    $router->resource('chapter', 'Api\V1\ChapterController', ['only' => ['index', 'show']]);
    $router->resource('character', 'Api\V1\CharacterController', ['only' => ['index', 'show']]);
    $router->resource('dlc', 'Api\V1\DlcController', ['only' => ['index', 'show']]);
    $router->resource('item', 'Api\V1\ItemController', ['only' => ['index', 'show']]);
    $router->resource('item-types', 'Api\V1\ItemTypeController', ['only' => ['index', 'show']]);
    $router->resource('music', 'Api\V1\MusicController', ['only' => ['index', 'show']]);

});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
