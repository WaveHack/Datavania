<?php

namespace App\Models;

use Laravel\Scout\Searchable;

/**
 * App\Models\Character
 *
 * @property int $id
 * @property string $slug
 * @property string $name
 * @property int $base_str
 * @property int $base_con
 * @property int $base_int
 * @property int $base_mnd
 * @property int $base_lck
 * @property int|null $dlc_id
 * @property string|null $notes
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Dlc|null $dlc
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Character newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Character newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Character query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Character whereBaseCon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Character whereBaseInt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Character whereBaseLck($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Character whereBaseMnd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Character whereBaseStr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Character whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Character whereDlcId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Character whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Character whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Character whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Character whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Character whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Character extends AbstractModel
{
    use Searchable;

    protected $casts = [
        'base_str' => 'int',
        'base_con' => 'int',
        'base_int' => 'int',
        'base_mnd' => 'int',
        'base_lck' => 'int',
    ];

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
            'type' => 'Character',
            'typeSlug' => 'character',
            'iconClass' => "sprite sprite-character sprite-character-{$this->slug}",
        ];
    }
}
