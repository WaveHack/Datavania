<?php

return [

    'entities' => [

        'item' => [
            'list' => \App\Sharp\ItemEntityList::class,
            'form' => null,
            'validator' => null,
            'policy' => null,
        ],

    ],

    'menu' => [

        [
            'label' => 'Items',
            'entity' => 'item',
        ],

    ],

];
