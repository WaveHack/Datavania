<?php

namespace App\Models;

use Laravel\Scout\Searchable;

/**
 * App\Models\Music
 *
 * @property int $id
 * @property string $slug
 * @property string $name
 * @property string|null $youtube_id
 * @property string $original_game
 * @property int|null $dlc_id
 * @property string|null $notes
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Dlc|null $dlc
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Music newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Music newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Music query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Music whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Music whereDlcId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Music whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Music whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Music whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Music whereOriginalGame($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Music whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Music whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Music whereYoutubeId($value)
 * @mixin \Eloquent
 */
class Music extends AbstractModel
{
    use Searchable;

    protected $table = 'music';

    public function dlc()
    {
        return $this->belongsTo(Dlc::class);
    }

    public function searchableAs()
    {
        return 'search';
    }

    public function toSearchableArray()
    {
        return [
            'slug' => $this->slug,
            'name' => $this->name,
            'type' => 'Music',
            'typeSlug' => 'music',
            'iconClass' => 'sprite sprite-music',
        ];
    }
}
