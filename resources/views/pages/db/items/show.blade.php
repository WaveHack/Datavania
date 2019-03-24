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
                <h5>Stats</h5>
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
                <div class="row mt-3">
                    <div class="col-md-6">
                        <div class="row {{ $item->stat_hp === 0 ? 'text-muted' : null }}">
                            <div class="col-md-6">HP</div>
                            <div class="col-md-6">{{ $item->stat_hp }}</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row {{ $item->stat_mp === 0 ? 'text-muted' : null }}">
                            <div class="col-md-6">MP</div>
                            <div class="col-md-6">{{ $item->stat_mp }}</div>
                        </div>
                    </div>
                </div>

                {{-- Resistances --}}
                <h5 class="mt-4">Resistances</h5>
                <div class="row">
                    <div class="col-md-6">
                        <strong>Physical</strong>

                        <div class="row {{ $item->resistance_strike === 0 ? 'text-muted' : null }}">
                            <div class="col-md-6">Strike</div>
                            <div class="col-md-6">{{ $item->resistance_strike }}</div>
                        </div>
                        <div class="row {{ $item->resistance_slash === 0 ? 'text-muted' : null }}">
                            <div class="col-md-6">Slash</div>
                            <div class="col-md-6">{{ $item->resistance_slash }}</div>
                        </div>
                        <div class="row {{ $item->resistance_pierce === 0 ? 'text-muted' : null }}">
                            <div class="col-md-6">Pierce</div>
                            <div class="col-md-6">{{ $item->resistance_pierce }}</div>
                        </div>

                        <div class="mt-3">
                            <strong>Status</strong>
                        </div>

                        <div class="row {{ $item->resistance_petrify === 0 ? 'text-muted' : null }}">
                            <div class="col-md-6">Petrify</div>
                            <div class="col-md-6">{{ $item->resistance_petrify }}</div>
                        </div>
                        <div class="row {{ $item->resistance_curse === 0 ? 'text-muted' : null }}">
                            <div class="col-md-6">Curse</div>
                            <div class="col-md-6">{{ $item->resistance_curse }}</div>
                        </div>
                        <div class="row {{ $item->resistance_poison === 0 ? 'text-muted' : null }}">
                            <div class="col-md-6">Poison</div>
                            <div class="col-md-6">{{ $item->resistance_poison }}</div>
                        </div>

                    </div>
                    <div class="col-md-6">
                        <strong>Magical</strong>

                        <div class="row {{ $item->resistance_fire === 0 ? 'text-muted' : null }}">
                            <div class="col-md-6">Fire</div>
                            <div class="col-md-6">{{ $item->resistance_fire }}</div>
                        </div>
                        <div class="row {{ $item->resistance_ice === 0 ? 'text-muted' : null }}">
                            <div class="col-md-6">Ice</div>
                            <div class="col-md-6">{{ $item->resistance_ice }}</div>
                        </div>
                        <div class="row {{ $item->resistance_lightning === 0 ? 'text-muted' : null }}">
                            <div class="col-md-6">Lightning</div>
                            <div class="col-md-6">{{ $item->resistance_lightning }}</div>
                        </div>
                        <div class="row {{ $item->resistance_holy === 0 ? 'text-muted' : null }}">
                            <div class="col-md-6">Holy</div>
                            <div class="col-md-6">{{ $item->resistance_holy }}</div>
                        </div>
                        <div class="row {{ $item->resistance_darkness === 0 ? 'text-muted' : null }}">
                            <div class="col-md-6">Darkness</div>
                            <div class="col-md-6">{{ $item->resistance_darkness }}</div>
                        </div>
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
