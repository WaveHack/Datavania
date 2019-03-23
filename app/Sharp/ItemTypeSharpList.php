<?php

namespace App\Sharp;

use App\Models\ItemType;
use Code16\Sharp\EntityList\SharpEntityList;
use Code16\Sharp\EntityList\EntityListQueryParams;
use Code16\Sharp\EntityList\Containers\EntityListDataContainer;

class ItemTypeSharpList extends SharpEntityList
{
    public function buildListDataContainers()
    {
        $this->addDataContainer(
            EntityListDataContainer::make('name')
                ->setLabel('Name')
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
        $this->addColumn('name', 12);
    }

    /**
    * Build list config
    *
    * @return void
    */
    public function buildListConfig()
    {
        $this->setInstanceIdAttribute('id')
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
        $itemTypes = ItemType::query()
            ->orderBy(
                $params->sortedBy(), $params->sortedDir()
            );

        collect($params->searchWords())
            ->each(function ($word) use ($itemTypes) {
                $itemTypes->where('name', 'like', $word);
            });

        return $this->transform(ItemType::paginate(15));
    }
}
