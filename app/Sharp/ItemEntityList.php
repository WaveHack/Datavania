<?php

namespace App\Sharp;

use App\Models\Item;
use Code16\Sharp\EntityList\SharpEntityList;
use Code16\Sharp\EntityList\EntityListQueryParams;
use Code16\Sharp\EntityList\Containers\EntityListDataContainer;

class ItemEntityList extends SharpEntityList
{
    /**
     * Build list containers using ->addDataContainer()
     *
     * @return void
     */
    public function buildListDataContainers()
    {
        $this->addDataContainer(
            EntityListDataContainer::make('name')
                ->setLabel('Name')
                ->setSortable()
        )->addDataContainer(
            EntityListDataContainer::make('rarity')
                ->setLabel('Rarity')
                ->setSortable()
        )->addDataContainer(
            EntityListDataContainer::make('itemType:name')
                ->setLabel('Type')
                ->setSortable()
        );
    }

    /**
     * Build list layout using ->addColumn()
     *
     * @return void
     */

    public function buildListLayout()
    {
        $this->addColumn('name', 6)
            ->addColumn('rarity', 3)
            ->addColumn('itemType:name', 3);
    }

    /**
     * Build list config
     *
     * @return void
     */
    public function buildListConfig()
    {
        $this->setInstanceIdAttribute('id')// slug
        ->setSearchable()
            ->setDefaultSort('name', 'asc')
            ->setPaginated();
    }

    /**
     * Retrieve all rows data as array.
     *
     * @param EntityListQueryParams $params
     * @return array
     */
    public function getListData(EntityListQueryParams $params)
    {
        $items = Item::query()
            ->with('itemType')
            ->orderBy(
                $params->sortedBy(), $params->sortedDir()
            );

        collect($params->searchWords())
            ->each(function ($word) use ($items) {
                $items->where('name', 'like', $word)
                    ->orWhereHas('itemType', function ($itemTypes) use ($word) {
                        $itemTypes->where('name', 'like', $word);
                    });
            });

        return $this
            ->setCustomTransformer('rarity', function (int $rarity) {
                return collect(array_fill(0, $rarity, ''))
                    ->map(function () {
                        return '<i class="fa fa-star" style="color: #6cb2eb;"></i>';
                    })
                    ->implode('');
            })
            ->transform(
                $items->paginate(15)
            );
    }
}
