<?php

/** @var \Illuminate\Routing\Router $router */

$router->get('/', function () {
    return view('welcome');

    return \App\Models\Music::first();


    return \App\Models\Chapter::with([
        'bossMusic',
        'boss2Music',
        'dlc',
        'hiddenItem',
        'stageMusic',
    ])->get();

    $input = [

['caught-in-the-cradle-of-decay', 1, 'Caught in the Cradle of Decay', 5, 3, 2, 4, 2, 'Bell', 1, 4, NULL, NULL, NULL],
['lord-of-the-unseen-strings', 2, 'Lord of the Unseen Strings', 3, 4, 6, 5, 3, 'Crown', 2, 4, NULL, NULL, NULL],
['the-end-of-chaos', 3, 'The End of Chaos', 3, 2, 2, 3, 4, 'Moai', 3, 5, NULL, NULL, NULL],
['esquisse-of-violence', 4, 'Esquisse of Violence', 4, 4, 3, 4, 5, 'Goemon', 8, 10, NULL, NULL, NULL],
['song-of-the-unslakable-blade', 5, 'Song of the Unslakable Blade', 4, 3, 3, 1, 3, 'Vic Viper', 12, 14, NULL, NULL, NULL],
['come-sweet-hour-of-death', 6, 'Come Sweet Hour of Death', 3, 4, 4, 4, 2, 'Konami Man', 13, 15, 16, NULL, NULL],
['beauty-desire-situation-dire', 7, 'Beauty, Desire, Situation Dire', 4, 4, 7, 5, 5, 'Vick13', 7, 9, NULL, 14, NULL],
['the-one-who-is-many', 8, 'The One Who Is Many', 4, 5, 5, 3, 4, 'Lucky Cat', 33, 34, NULL, 7, NULL],
['lord-of-flies', 9, 'Lord of Flies', 5, 3, 5, 4, 5, 'Twin Bee', 31, 32, NULL, 6, NULL],
['origins', 10, 'Origins', 6, 2, 4, 2, 5, NULL, 20, 21, NULL, 5, NULL],
['the-legend-of-fuma', 11, 'The Legend of Fuma', 5, 3, 4, 3, 6, 'Facade Card', 18, 19, NULL, 1, NULL],

    ];

    $columns = [
        'slug',
        'chapter',
        'name',
        'chests_blue',
        'chests_brown',
        'chests_green',
        'chests_red',
        'chests_purple',
        'hidden_item',
        'stage_music',
        'boss_music',
        'boss2_music',
        'dlc',
        'notes',
    ];

    $data = [];
    foreach ($input as $row) {
        reset($columns);
        $dataRow = [];

        foreach ($row as $k => $v) {
            $key = current($columns);

            // typecasting
            if (in_array($key, ['chests_blue', 'chests_brown', 'chests_green', 'chests_red', 'chests_purple'])) $v = (int)$v;

            // relations
            if ($key === 'dlc' && $v !== null) {
                $id = $v;

                $dataRow['__relations'][] = [
                    'type' => 'dlc',
                    'slug' => \App\Models\Dlc::find($id)->slug ?: '##########',
                ];

                next($columns);
                continue;
            }

            if ($key === 'hidden_item' && $v !== null) {
                $dataRow['__relations'][] = [
                    'type' => 'hidden-item',
                    'slug' => '##########',
                ];

                next($columns);
                continue;
            }

            if (in_array($key, ['stage_music', 'boss_music', 'boss2_music']) && $v !== null) {
                $id = $v;

                $dataRow['__relations'][] = [
                    'type' => $key,
                    'slug' => \App\Models\Music::find($id)->slug ?: '##########',
                ];

                next($columns);
                continue;
            }













            if ($v !== null) {
                $dataRow[$key] = $v;
            }

            next($columns);
        }

        $data[] = $dataRow;
    }

    return json_encode($data);
//    return view('welcome');

});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
