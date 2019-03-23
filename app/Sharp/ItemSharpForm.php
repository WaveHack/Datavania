<?php

namespace App\Sharp;

use App\Helpers\AttributeHelper;
use App\Models\Item;
use App\Models\ItemType;
use Code16\Sharp\Form\Eloquent\WithSharpFormEloquentUpdater;
use Code16\Sharp\Form\Fields\SharpFormAutocompleteField;
use Code16\Sharp\Form\Fields\SharpFormCheckField;
use Code16\Sharp\Form\Fields\SharpFormNumberField;
use Code16\Sharp\Form\Fields\SharpFormSelectField;
use Code16\Sharp\Form\Fields\SharpFormTextareaField;
use Code16\Sharp\Form\Fields\SharpFormTextField;
use Code16\Sharp\Form\Layout\FormLayoutColumn;
use Code16\Sharp\Form\SharpForm;

class ItemSharpForm extends SharpForm
{
    use WithSharpFormEloquentUpdater;

    /** @var AttributeHelper */
    protected $attributeHelper;

    public function __construct(AttributeHelper $attributeHelper)
    {
        $this->attributeHelper = $attributeHelper;
    }

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
        )->addField(
            SharpFormCheckField::make('is_starter', 'Starter Item?')
        )->addField(
            SharpFormCheckField::make('is_shoppable', 'Shoppable?')
        )->addField(
            SharpFormNumberField::make('value')
                ->setLabel('value')
        );

        foreach (['atk', 'def', 'str', 'con', 'int', 'mnd', 'lck', 'hp', 'mp'] as $stat) {
            $this->addField(
                SharpFormNumberField::make("stat_{$stat}")
                    ->setLabel(strtoupper($stat))
                    ->setPlaceholder(0)
            );
        }

        foreach ($this->attributeHelper->getAttributes() as $attribute) {
            $this->addField(
                SharpFormNumberField::make("resistance_{$attribute}")
                    ->setLabel(strtoupper($attribute))
                    ->setPlaceholder(0)
            );
        }

        // stat atk, def, str, con, int, mnd, lck, hp, mp
        // restistance strike, slash, pierce, fire, ice, lightning, petrify, holy, darkness, curse, poison
        // attribute 1, 2
        // is_cobsumable
        // is_consumed_over_time
        // dlc
        // notes
    }

    public function buildFormLayout()
    {
        $this->addColumn(6, function (FormLayoutColumn $column) {

            $column->withSingleField('name')
                ->withFields('value|4', 'rarity|4', 'item_type_id|4')
                ->withFields('stat_atk|3', 'stat_def|3', 'stat_hp|3')
                ->withFields('stat_str|3', 'stat_con|3', 'stat_mp|3')
                ->withFields('stat_int|3', 'stat_mnd|3', 'stat_lck|3');

            collect($this->attributeHelper->getAttributes())
                ->chunk(4)
                ->each(function ($attributes) use ($column) {
//                    $attributes->each(function ($attribute) use ($column) {
//                        $column->withSingleField("resistance_{$attribute}|3");
//                    });
                    $column->withFields(
                        $attributes->map(function ($attribute) {
                            return "resistance_{$attribute}|3";
                        })
                    );
                });
            // attributes
            // stats
            // resistances

        })->addColumn(6, function (FormLayoutColumn $column) {

            $column->withSingleField('description')
                ->withFields('is_starter|6', 'is_shoppable|6');
            // is consumable
            // dlc
            // notes

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
