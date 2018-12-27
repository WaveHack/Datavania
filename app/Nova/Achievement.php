<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;

class Achievement extends Resource
{
    public static $model = \App\Models\Achievement::class;
    public static $title = 'name';

    public static $search = [
        'name', 'description'
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            // todo: image

            Text::make('Slug')
                ->hideFromIndex()
                ->hideWhenCreating()
                ->hideWhenUpdating(),

            Text::make('Name')
                ->sortable()
                ->rules(['required', 'max:255']),

            Text::make('Description')
                ->hideFromIndex(),

            Number::make('Points')
                ->sortable(),

            Text::make('Notes')
                ->hideFromIndex(),
        ];
    }
}