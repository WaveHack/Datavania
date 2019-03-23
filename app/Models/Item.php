<?php

namespace App\Models;

use Laravel\Scout\Searchable;

/**
 * App\Models\Item
 *
 * @property int $id
 * @property string $slug
 * @property int $item_type_id
 * @property string $name
 * @property string|null $description
 * @property int $rarity
 * @property bool $is_starter
 * @property bool $is_shoppable
 * @property int|null $value
 * @property int $stat_atk
 * @property int $stat_def
 * @property int $stat_str
 * @property int $stat_con
 * @property int $stat_int
 * @property int $stat_mnd
 * @property int $stat_lck
 * @property int $stat_hp
 * @property int $stat_mp
 * @property int $resistance_strike
 * @property int $resistance_slash
 * @property int $resistance_pierce
 * @property int $resistance_fire
 * @property int $resistance_ice
 * @property int $resistance_lightning
 * @property int $resistance_petrify
 * @property int $resistance_holy
 * @property int $resistance_darkness
 * @property int $resistance_curse
 * @property int $resistance_poison
 * @property string|null $attribute1
 * @property string|null $attribute2
 * @property bool $is_consumable
 * @property bool $is_consumed_over_time
 * @property int|null $dlc_id
 * @property string|null $notes
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\ItemType $itemType
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item whereAttribute1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item whereAttribute2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item whereDlcId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item whereIsConsumable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item whereIsConsumedOverTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item whereIsShoppable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item whereIsStarter($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item whereItemTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item whereRarity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item whereResistanceCurse($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item whereResistanceDarkness($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item whereResistanceFire($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item whereResistanceHoly($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item whereResistanceIce($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item whereResistanceLightning($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item whereResistancePetrify($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item whereResistancePierce($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item whereResistancePoison($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item whereResistanceSlash($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item whereResistanceStrike($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item whereStatAtk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item whereStatCon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item whereStatDef($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item whereStatHp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item whereStatInt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item whereStatLck($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item whereStatMnd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item whereStatMp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item whereStatStr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item whereValue($value)
 * @mixin \Eloquent
 */
class Item extends AbstractModel
{
    use Searchable;

    protected $casts = [
        'rarity' => 'int',
        'is_starter' => 'bool',
        'is_shoppable' => 'bool',
        'value' => 'int',
        'stat_atk' => 'int',
        'stat_def' => 'int',
        'stat_str' => 'int',
        'stat_con' => 'int',
        'stat_int' => 'int',
        'stat_mnd' => 'int',
        'stat_lck' => 'int',
        'stat_hp' => 'int',
        'stat_mp' => 'int',
        'resistance_strike' => 'int',
        'resistance_slash' => 'int',
        'resistance_pierce' => 'int',
        'resistance_fire' => 'int',
        'resistance_ice' => 'int',
        'resistance_lightning' => 'int',
        'resistance_petrify' => 'int',
        'resistance_holy' => 'int',
        'resistance_darkness' => 'int',
        'resistance_curse' => 'int',
        'resistance_poison' => 'int',
        'is_consumable' => 'bool',
        'is_consumed_over_time' => 'bool',
    ];

    public function itemType()
    {
        return $this->belongsTo(ItemType::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function searchableAs()
    {
        return 'search';
    }

    public function toSearchableArray()
    {
        $useTypeSlugForIcon = in_array($this->itemType->slug, [
            'weapon-glyph',
            'bullet-soul',
            'dark-magic',
            'bound-spell',
            'glyph-spell',
            'guardian-soul',
            'enchantment-soul',
            'martial-arts',
            'personal-action',
        ], true);

        $iconClass = ($useTypeSlugForIcon ? $this->itemType->slug : $this->slug);

        return [
            'slug' => $this->slug,
            'name' => $this->name,
            'type' => $this->itemType->name,
            'typeSlug' => 'item',
            'iconClass' => "sprite sprite-item sprite-item-{$iconClass}",
        ];
    }
}
