@extends('layouts.app')
@section('title', __('home.home'))
@section('content')
<home-intro-component :user="{{ auth()->user()->toJson() }}"></home-intro-component>
<div class="container">

</div>
@endsection
