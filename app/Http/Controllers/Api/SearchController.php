<?php

namespace App\Http\Controllers\Api;

use App\Models\Achievement;
use Illuminate\Http\Request;

class SearchController extends AbstractApiController
{
    public function index(Request $request)
    {
        $query = $request->get('q');

        if (in_array($query, ['', null], true)) {
            return response()
                ->json();
        }

        $results = [];

        $achievements = Achievement::query()
            ->where('name', 'like', "%{$query}%")
            ->orderBy('name')
            ->get();

        if (!$achievements->isEmpty()) {
            $achievements->each(function ($achievement) use (&$results) {
                $results[] = [
                    'type' => 'Achievement',
                    'slug' => $achievement->slug,
                    'name' => $achievement->name,
                    'points' => $achievement->points,
                ];
            });
        }

        if (in_array($query, ['v', 'va', 'val'])) {
            $results[] = [
                'type' => 'Item',
                'slug' => 'valmanway',
                'name' => 'Valmanway',
                'icon' => 'valmanway.png',
            ];

            $results[] = [
                'type' => 'Item',
                'slug' => 'valmanway-1',
                'name' => 'Valmanway +1',
                'icon' => 'valmanway.png',
            ];
        }

        // todo: other models



        return response()
            ->json($results);
    }
}
