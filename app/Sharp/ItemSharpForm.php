<?php

namespace App\Sharp;

use App\Models\Item;
use App\Models\ItemType;
use Code16\Sharp\Form\Eloquent\WithSharpFormEloquentUpdater;
use Code16\Sharp\Form\Fields\SharpFormAutocompleteField;
use Code16\Sharp\Form\Fields\SharpFormSelectField;
use Code16\Sharp\Form\Fields\SharpFormTextareaField;
use Code16\Sharp\Form\Fields\SharpFormTextField;
use Code16\Sharp\Form\Layout\FormLayoutColumn;
use Code16\Sharp\Form\SharpForm;

class ItemSharpForm extends SharpForm
{
    use WithSharpFormEloquentUpdater;

    public function buildFormFields()
    {
        $this->addField(
            SharpFormAutocompleteField::make('item_type_id', 'local')
                ->setLabel('Item Type')
                ->setLocalSearchKeys(['name'])
                ->setLocalValues(ItemType::all()->toArray())
                ->setListItemInlineTemplate('{{name}}')
                ->setResultItemInlineTemplate('{{name}}')
        )->addField(
            SharpFormTextField::make('name')
                ->setLabel('Name')
        )->addField(
            SharpFormTextareaField::make('description')
                ->setLabel('Description')
        )->addField(
            SharpFormSelectField::make(
                'rarity',
                array_combine(range(1, 5), range(1, 5))
            )
                ->setLabel('Rarity')
                ->setDisplayAsDropdown()
        );
    }

    public function buildFormLayout()
    {
        $this->addColumn(6, function (FormLayoutColumn $column) {

            $column->withSingleField('name')
                ->withFields('rarity|6', 'item_type_id|6');

        })->addColumn(6, function (FormLayoutColumn $column) {

            $column->withSingleField('description');

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
