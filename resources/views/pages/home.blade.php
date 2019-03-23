@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center myt-3">
            <img src="/images/logo.png" alt="Datavania">
        </div>

        <div class="row justify-content-center my-3">
            <div class="col-md-6">
                @include('partials.global-search')
                <p class="text-muted text-right mt-1 pr-2">
                    Press / to focus the search bar <i class="fa fa-level-up-alt" style="margin-right: 10px;"></i>
                </p>
            </div>
        </div>
    </div>
@endsection
