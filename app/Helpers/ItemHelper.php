<?php

namespace App\Helpers;

use App\Models\Item;

class ItemHelper
{
    public function getImageClass(Item $item): string
    {
        $useTypeSlugForIcon = in_array($item->itemType->slug, [
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

        $iconClass = ($useTypeSlugForIcon ? $item->itemType->slug : $item->slug);

        return "sprite sprite-item sprite-item-{$iconClass}";
    }
}
