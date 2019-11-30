@extends('layouts.app')
@section('title', __('home.home'))
@section('content')
<div class="jumbotron">
    <div class="container">
        <h1 class="display-3">@lang('home.hello', ['name' => Auth::user()->full_name])</h1>
        <p>@lang('home.Intro')</p>
        <p><a class="btn btn-primary btn-lg" href="{{ route('task.create') }}" role="button">@lang('home.Create Task')</a></p>
    </div>
</div>
<div class="container">
    <div class="row justify-content-center">
        @component('components.deck')
            @slot('body')
                @component('components.card', [
                        'title' => __('home.Hourly'),
                        'body'  => '<i class="fa fa-clock-o"></i>'
                    ])
                @endcomponent
                @component('components.card', [
                        'title' => __('home.Daily'),
                        'body'  => '<i class="fa fa-calendar-day"></i>'
                    ])
                @endcomponent
                @component('components.card', [
                        'title' => __('home.Weekly'),
                        'body'  => '<i class="fa fa-calendar-alt"></i>'
                    ])
                @endcomponent
            @endslot
        @endcomponent
    </div>
    <div class="row justify-content-center">
        @component('components.deck')
            @slot('body')
                @component('components.card', [
                        'title' => __('home.Personal'),
                        'body'  => '<i class="fa fa-clock-o"></i>'
                    ])
                @endcomponent
                @component('components.card', [
                        'title' => __('home.Board'),
                        'body'  => '<i class="fa fa-calendar-day"></i>'
                    ])
                @endcomponent
                @component('components.card', [
                        'title' => __('home.Team'),
                        'body'  => '<i class="fa fa-calendar-alt"></i>'
                    ])
                @endcomponent
            @endslot
        @endcomponent
    </div>
</div>
@endsection
