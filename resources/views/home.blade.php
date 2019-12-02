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

</div>
@endsection
