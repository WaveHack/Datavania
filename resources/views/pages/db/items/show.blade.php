@extends('layouts.app')

@php
    function stat_row(\App\Models\Item $item, string $stat, string $label): string {
        $statValue = (int)$item->$stat;
        return sprintf('<div class="row">
                            <div class="col-md-6">
                                <span class="%s">%s</span>
                            </div>
                            <div class="col-md-6">
                                <span class="text-right %s">%s</span>
                            </div>
                        </div>',
            (($statValue === 0) ? 'text-muted' : null),
            $label,
            (($statValue < 0) ? 'text-danger' : (($statValue === 0) ? 'text-muted' : null)),
            number_format($statValue)
        );
    }
@endphp

@section('content')
    <div class="container">

        <div style="display: flex;">
            <div style="margin-right: 10px;">
                <i class="{{ $itemHelper->getImageClass($item) }}"
                   style="zoom: 4; image-rendering: pixelated;"></i>
            </div>
            <div style="flex-grow: 1;">
                <h1 style="margin-bottom: 0;">{{ $item->name  }}</h1>
                <em class="text-muted">{{ $item->description }}</em>
            </div>
            <div class="text-right">
                <h4>
                    {{ $item->itemType->name }}<br>
                    <small>
                        @for ($i = 0; $i < $item->rarity; $i++)
                            <i class="fa fa-star" style="color: #6cb2eb;"></i>
                        @endfor
                    </small>
                </h4>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-4">
                {{-- Stats --}}
                <h5>Stats</h5>
                <div class="row">
                    <div class="col-md-6">
                        {!! stat_row($item, 'stat_atk', 'Atk') !!}
                        {!! stat_row($item, 'stat_str', 'Str') !!}
                        {!! stat_row($item, 'stat_int', 'Int') !!}
                        {!! stat_row($item, 'stat_lck', 'Lck') !!}
                    </div>
                    <div class="col-md-6">
                        {!! stat_row($item, 'stat_def', 'Def') !!}
                        {!! stat_row($item, 'stat_con', 'Con') !!}
                        {!! stat_row($item, 'stat_mnd', 'Mnd') !!}
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-6">
                        {!! stat_row($item, 'stat_hp', 'HP') !!}
                    </div>
                    <div class="col-md-6">
                        {!! stat_row($item, 'stat_mp', 'MP') !!}
                    </div>
                </div>

                {{-- Resistances --}}
                <h5 class="mt-4">Resistances</h5>
                <div class="row">
                    <div class="col-md-6">
                        <strong>Physical</strong>
                        {!! stat_row($item, 'resistance_strike', 'Strike') !!}
                        {!! stat_row($item, 'resistance_slash', 'Slash') !!}
                        {!! stat_row($item, 'resistance_pierce', 'Pierce') !!}

                        <div class="mt-3">
                            <strong>Status</strong>
                        </div>
                        {!! stat_row($item, 'resistance_petrify', 'Petrify') !!}
                        {!! stat_row($item, 'resistance_curse', 'Curse') !!}
                        {!! stat_row($item, 'resistance_poison', 'Poison') !!}
                    </div>
                    <div class="col-md-6">
                        <strong>Magical</strong>
                        {!! stat_row($item, 'resistance_fire', 'Fire') !!}
                        {!! stat_row($item, 'resistance_ice', 'Ice') !!}
                        {!! stat_row($item, 'resistance_lightning', 'Lightning') !!}
                        {!! stat_row($item, 'resistance_holy', 'Holy') !!}
                        {!! stat_row($item, 'resistance_darkness', 'Darkness') !!}
                    </div>
                </div>

                {{-- Info box? --}}

                {{-- Usable By? --}}
            </div>

            <div class="col-md-4">
                <h5>Source</h5>

                store purchaseable OR
                    monster drop
                    || chest drop

                <h5 class="mt-4">Farming</h5>

                recommended farming location (todo probs)
            </div>

            <div class="col-md-4">
                <h5>Extra</h5>
                <div class="row">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-6">Value</div>
                            <div class="col-md-6">{{ number_format($item->value) }}</div>
                        </div>
                        @if ($item->attribute1 !== null)
                            <div class="row">
                                <div class="col-md-6">Attribute</div>
                                <div class="col-md-6">{{ ucfirst($item->attribute1) }}</div>
                            </div>
                            @if ($item->attribute2 !== null)
                                <div class="row">
                                    <div class="col-md-6">Attribute 2</div>
                                    <div class="col-md-6">{{ ucfirst($item->attribute2) }}</div>
                                </div>
                            @endif
                        @endif
                        {{-- todo: hidden effect --}}
                    </div>
                    <div class="col-md-6">
                        {!! $item->is_starter ? '<p>Starter item</p>' : null !!}
                        {!! $item->is_shoppable ? '<p>Buyable from shop</p>' : null !!}
                        {!! $item->is_consumable ? '<p>Consumable</p>' : null !!}
                        {{-- todo: consumed for how much hp/mp and buffs? --}}
                        {!! $item->is_consumed_over_time ? '<p>Consumed over time</p>' : null !!}
                    </div>
                </div>

                <h5 class="mt-4">Usable By</h5>
                todo
            </div>
        </div>

{{--        <br><br><pre>{{ print_r(json_decode($item), true) }}</pre>--}}
    </div>
@endsection
