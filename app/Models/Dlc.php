<?php

namespace App\Models;

use Laravel\Scout\Searchable;

/**
 * App\Models\Dlc
 *
 * @property int $id
 * @property string $slug
 * @property string $name
 * @property string $description
 * @property string|null $type
 * @property int $msp
 * @property \Illuminate\Support\Carbon $release_date
 * @property string $size
 * @property string|null $notes
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Chapter[] $chapters
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Character[] $characters
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Music[] $music
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Dlc newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Dlc newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Dlc query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Dlc whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Dlc whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Dlc whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Dlc whereMsp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Dlc whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Dlc whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Dlc whereReleaseDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Dlc whereSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Dlc whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Dlc whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Dlc whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Dlc extends AbstractModel
{
    use Searchable;

    protected $casts = [
        'msp' => 'int',
    ];

    protected $dates = [
        'release_date',
        'created_at',
        'updated_at',
    ];

    public function chapters()
    {
        return $this->hasMany(Chapter::class);
    }

    public function characters()
    {
        return $this->hasMany(Character::class);
    }

    public function music()
    {
        return $this->hasMany(Music::class);
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
            'type' => 'DLC',
            'typeSlug' => 'dlc',
            'iconClass' => 'sprite sprite-dlc',
        ];
    }
}
