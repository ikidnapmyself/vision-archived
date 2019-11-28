@extends('layouts.app')
@section('title', $task->name)
@section('content')
<div class="container my-5">
    <div class="row">
        <div class="col-8">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ $task->name }}</h5>
                    @if($task->completed_by)
                    <h6 class="card-subtitle mb-2 text-muted">{{ $task->completed_by }}</h6>
                    @endif
                    <p class="card-text">{{ $task->body }}</p>
                    <!--
                    <a href="#" class="card-link">Complete</a>
                    <a href="#" class="card-link">New Task</a>
                    //-->
                </div>
            </div>
        </div>
        <div class="col-4">
            @component('partials.assignees', ['assignees' => $task->assignees])
            @endcomponent
        </div>
    </div>
</div>
@endsection
