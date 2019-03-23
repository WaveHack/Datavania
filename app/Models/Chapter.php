<?php

namespace App\Models;

use Laravel\Scout\Searchable;

/**
 * App\Models\Chapter
 *
 * @property int $id
 * @property string $slug
 * @property int $chapter
 * @property string $name
 * @property int $chests_blue
 * @property int $chests_brown
 * @property int $chests_green
 * @property int $chests_red
 * @property int $chests_purple
 * @property int|null $hidden_item_id
 * @property int|null $stage_music_id
 * @property int|null $boss_music_id
 * @property int|null $boss2_music_id
 * @property int|null $dlc_id
 * @property string|null $notes
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Music|null $boss2Music
 * @property-read \App\Models\Music|null $bossMusic
 * @property-read \App\Models\Dlc|null $dlc
 * @property-read \App\Models\Item|null $hiddenItem
 * @property-read \App\Models\Music|null $stageMusic
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Chapter newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Chapter newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Chapter query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Chapter whereBoss2MusicId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Chapter whereBossMusicId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Chapter whereChapter($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Chapter whereChestsBlue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Chapter whereChestsBrown($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Chapter whereChestsGreen($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Chapter whereChestsPurple($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Chapter whereChestsRed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Chapter whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Chapter whereDlcId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Chapter whereHiddenItemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Chapter whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Chapter whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Chapter whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Chapter whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Chapter whereStageMusicId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Chapter whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Chapter extends AbstractModel
{
    use Searchable;

    protected $casts = [
        'chapter' => 'int',
        'chests_blue' => 'int',
        'chests_red' => 'int',
        'chests_brown' => 'int',
        'chests_green' => 'int',
        'chests_purple' => 'int',
    ];

    public function bossMusic()
    {
        return $this->belongsTo(Music::class);
    }

    public function boss2Music()
    {
        return $this->belongsTo(Music::class);
    }

    public function dlc()
    {
        return $this->belongsTo(Dlc::class);
    }

    public function hiddenItem()
    {
        return $this->belongsTo(Item::class);
    }

    public function stageMusic()
    {
        return $this->belongsTo(Music::class);
    }

    public function searchableAs()
    {
        return 'search';
    }

    public function toSearchableArray()
    {
        return [
            'slug' => $this->slug,
            'name' => "{$this->chapter}: {$this->name}",
            'type' => 'Chapter',
            'typeSlug' => 'chapter',
            'iconClass' => 'sprite sprite-chapter',
        ];
    }
}
