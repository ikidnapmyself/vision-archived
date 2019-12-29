@extends('layouts.app')
@section('title', $user->full_name)
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <user-component :user="{{ $user->toJson() }}"></user-component>
            </div>
        </div>
    </div>
@endsection
