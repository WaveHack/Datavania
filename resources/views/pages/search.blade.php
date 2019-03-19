@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center my-3">
            <div class="col-md-6">
                @include('partials.global-search', ['placeholder' => $query])
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12 col-md-8 offset-md-2">
                <h1>Search Results</h1>

                @if (empty($result))
                    <p>No results found for '{{ $query }}'.</p>
                @else
                    <div class="card">
                        <div class="card-header">
                            <ul class="nav nav-tabs card-header-tabs">
                                @foreach (array_keys($result) as $type)
                                    <li class="nav-item">
                                        <a href="#{{ $type }}"
                                           class="nav-link {{ $loop->first ? 'active' : null }}"
                                           data-toggle="tab"
                                           role="tab"
                                           aria-controls="{{ $type }}"
                                           aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                                            {{ ucfirst($type) }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="tab-content">
                            @foreach (array_keys($result) as $type)
                                <div class="tab-pane {{ $loop->first ? 'active' : null }}"
                                     id="{{ $type }}"
                                     role="tabpanel"
                                     aria-labelledby="{{ $type }}-tab">
                                    <div class="table-responsive">
                                        @switch ($type)
                                            @case ('achievements')
                                                @include('partials.search-results.achievements', compact('type', 'result'))
                                                @break
                                        @endswitch
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
