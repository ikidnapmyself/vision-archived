@extends('layouts.app')
@section('content')
<div class="container my-5">
    <div class="row">
        <div class="col">
            <users-component :users="{{ $users->toJson() }}"></users-component>
        </div>
    </div>
</div>
@endsection
