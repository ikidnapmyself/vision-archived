@extends('layouts.app')
@section('title', $task->name)
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <task-component :task="{{ $task->toJson() }}"></task-component>
            </div>
        </div>
    </div>
@endsection
