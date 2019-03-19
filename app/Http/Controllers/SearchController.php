<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->get('q');

        if (in_array($query, ['', null], true)) {
            return redirect()->route('home');
        }

        $data = [];

        $achievements = Achievement::query()
            ->where('name', 'like', "%{$query}%")
            ->get();

        if (!$achievements->isEmpty()) {
            $data['achievements'] = $achievements;
        }

        // todo: other models

        // Check if we have only one result, then we can redirect to the show page right away
        if (count($data) === 1) {
            /** @noinspection SuspiciousLoopInspection */
            foreach ($data as $type => $entities) {
                if ($entities->count() === 1) {
                    return redirect()->route("db.{$type}.show", $entities->first()->slug);
                }
            }
        }

        return view('pages.search', [
            'query' => $query,
            'result' => $data,
        ]);
    }
}
