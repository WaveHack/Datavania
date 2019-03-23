<?php

namespace App\Models;

use Laravel\Scout\Searchable;

/**
 * App\Models\Achievement
 *
 * @property int $id
 * @property string $slug
 * @property string $name
 * @property string $description
 * @property int $points
 * @property string|null $notes
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Achievement newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Achievement newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Achievement query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Achievement whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Achievement whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Achievement whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Achievement whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Achievement whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Achievement wherePoints($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Achievement whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Achievement whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Achievement extends AbstractModel
{
    use Searchable;

    protected $casts = [
        'points' => 'int',
    ];

    public function searchableAs()
    {
        return 'search';
    }

    public function toSearchableArray()
    {
        return [
            'slug' => $this->slug,
            'name' => $this->name,
            'type' => 'Achievement',
            'typeSlug' => 'achievement',
            'iconClass' => 'sprite sprite-achievement',
        ];
    }
}
