@extends('layouts.app')

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
                <div class="row">
                    <div class="col-md-12">
                        <strong>Stats</strong>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="row {{ $item->stat_atk === 0 ? 'text-muted' : null }}">
                            <div class="col-md-6">ATK</div>
                            <div class="col-md-6">{{ $item->stat_atk }}</div>
                        </div>
                        <div class="row {{ $item->stat_str === 0 ? 'text-muted' : null }}">
                            <div class="col-md-6">STR</div>
                            <div class="col-md-6">{{ $item->stat_str }}</div>
                        </div>
                        <div class="row {{ $item->stat_int === 0 ? 'text-muted' : null }}">
                            <div class="col-md-6">INT</div>
                            <div class="col-md-6">{{ $item->stat_int }}</div>
                        </div>
                        <div class="row {{ $item->stat_lck === 0 ? 'text-muted' : null }}">
                            <div class="col-md-6">LCK</div>
                            <div class="col-md-6">{{ $item->stat_lck }}</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row {{ $item->stat_def === 0 ? 'text-muted' : null }}">
                            <div class="col-md-6">DEF</div>
                            <div class="col-md-6">{{ $item->stat_def }}</div>
                        </div>
                        <div class="row {{ $item->stat_con === 0 ? 'text-muted' : null }}">
                            <div class="col-md-6">CON</div>
                            <div class="col-md-6">{{ $item->stat_con }}</div>
                        </div>
                        <div class="row {{ $item->stat_mnd === 0 ? 'text-muted' : null }}">
                            <div class="col-md-6">MND</div>
                            <div class="col-md-6">{{ $item->stat_mnd }}</div>
                        </div>
                    </div>
                </div>

                {{-- Resistances --}}
                <div class="row mt-3">
                    <div class="col-md-12">
                        <strong>Resistances</strong>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="row {{ $item->resistance_strike === 0 ? 'text-muted' : null }}">
                            <div class="col-md-6">STR</div>
                            <div class="col-md-6 text-right">{{ $item->resistance_strike }}</div>

                        </div>
                        str: {{ $item->resistance_strike }}<br>
                        slh: {{ $item->resistance_slash }}<br>
                        pie: {{ $item->resistance_pierce }}
                    </div>
                    <div class="col-md-3">
                        fir: {{ $item->resistance_fire }}<br>
                        ice: {{ $item->resistance_ice }}<br>
                        lng: {{ $item->resistance_lightning }}
                    </div>
                    <div class="col-md-3">
                        pet: {{ $item->resistance_petrify }}<br>
                        hol: {{ $item->resistance_holy }}<br>
                        dar: {{ $item->resistance_darkness }}
                    </div>
                    <div class="col-md-3">
                        cur: {{ $item->resistance_curse }}<br>
                        poi: {{ $item->resistance_poison }}
                    </div>
                </div>

                {{-- Info box? --}}

                {{-- Usable By? --}}
            </div>

            <div class="col-md-4">
                space (drop list?)
            </div>

            <div class="col-md-4">
                space (?)
            </div>
        </div>

{{--        <br><br><pre>{{ print_r(json_decode($item), true) }}</pre>--}}
    </div>
@endsection
