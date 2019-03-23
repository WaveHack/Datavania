<?php

return [

    'entities' => [
        'item' => [
            'list' => \App\Sharp\ItemSharpList::class,
            'form' => \App\Sharp\ItemSharpForm::class,
            'validator' => null,
            'policy' => null,
        ],
        'item-type' => [
            'list' => \App\Sharp\ItemTypeSharpList::class,
            'form' => null,
            'validator' => null,
            'policy' => null,
        ],
    ],

    'menu' => [
        [
            'label' => 'Database',
            'entities' => [
                [
                    'label' => 'Items',
                    'entity' => 'item',
                ],
            ],
        ],
        [
            'label' => 'Misc',
            'entities' => [
                [
                    'label' => 'Item Types',
                    'entity' => 'item-type',
                ],
                // users
            ],
        ],
    ],
];
