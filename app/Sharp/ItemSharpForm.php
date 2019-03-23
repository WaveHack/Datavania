<?php

namespace App\Sharp;

use App\Models\Item;
use App\Models\ItemType;
use Code16\Sharp\Form\Fields\SharpFormAutocompleteField;
use Code16\Sharp\Form\Fields\SharpFormAutocompleteListField;
use Code16\Sharp\Form\Fields\SharpFormSelectField;
use Code16\Sharp\Form\SharpForm;
use Code16\Sharp\Form\Layout\FormLayoutColumn;
use Code16\Sharp\Form\Fields\SharpFormTextField;
use Code16\Sharp\Form\Eloquent\WithSharpFormEloquentUpdater;

class ItemSharpForm extends SharpForm
{
    use WithSharpFormEloquentUpdater;

    public function buildFormFields()
    {
        $this->addField(
            SharpFormAutocompleteField::make('item_type_id', 'local')
                ->setLabel('Item Type')
                ->setLocalSearchKeys(['name'])
                ->setLocalValues(ItemType::all())
                ->setListItemInlineTemplate('{{name}}')
                ->setResultItemInlineTemplate('{{name}}')
        )->addField(
            SharpFormTextField::make('name')
                ->setLabel('Name')
        )->addField(
            SharpFormTextField::make('description')
                ->setLabel('Description')
        )->addField(
            SharpFormSelectField::make(
                'rarity',
                array_combine(range(1, 5), range(1, 5))
            )
                ->setLabel('Rarity')
                ->setDisplayAsDropdown()
        );
        // type
        // name
        // description
        // rarity
    }

    public function buildFormLayout()
    {
        $this->addColumn(6, function (FormLayoutColumn $column) {
            $column->withSingleField('name')
                ->withFields('item_type_id|6', 'rarity|6');
        });
    }

    public function find($id): array
    {
        return $this->transform(
            Item::findOrFail($id)
        );
    }

    public function update($id, array $data)
    {
        $instance = $id ? Item::findOrFail($id) : new Item;

        return tap($instance, function ($item) use ($data) {
            $this->save($item, $data);
        })->id;
    }

    public function delete($id)
    {
        Item::findOrFail($id)->delete();
    }
}
