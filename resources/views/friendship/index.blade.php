@extends('layouts.app')
@section('content')
    <friends-component class="my-5" :user="'{{ $user }}'"></friends-component>
@endsection
