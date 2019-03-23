<?php

namespace App\Models;

/**
 * App\Models\ItemType
 *
 * @property int $id
 * @property string $slug
 * @property string $name
 * @property string|null $notes
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Item[] $items
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemType query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemType whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemType whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ItemType whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ItemType extends AbstractModel
{
    public function items()
    {
        return $this->hasMany(Item::class);
    }
}
