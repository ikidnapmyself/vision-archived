@extends('layouts.app')
@section('content')
<div class="container my-5">
    <div class="row">
        <div class="col">
            <tasks-component :tasks="{{ $tasks->toJson() }}"></tasks-component>
        </div>
    </div>
</div>
@endsection
