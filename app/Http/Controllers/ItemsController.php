<?php

namespace App\Http\Controllers;

use App\Helpers\ItemHelper;
use App\Models\Item;

class ItemsController extends Controller
{
    public function index()
    {
        $items = Item::paginate(15);

        return view('pages.db.items.index', compact('items'));
    }

    public function show(string $slug)
    {
        $item = Item::query()
            ->with('itemType')
            ->where('slug', $slug)
            ->firstOrFail();

        return view('pages.db.items.show', [
            'item' => $item,
            'itemHelper' => app(ItemHelper::class),
        ]);
    }
}
