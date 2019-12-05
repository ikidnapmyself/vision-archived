@extends('layouts.app')
@section('title', $task->name)
@section('content')
    <div class="container my-5">
        <div class="row">
            <div class="col-8">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">
                            @if($task->completed_by)
                                <i class="fa fa-check text-success"></i>
                            @endif
                            {{ $task->name }}
                        </h5>
                        @if($task->completed_by)
                            <h6 class="card-subtitle mb-2 text-muted">{{ $task->completed_by }}</h6>
                        @endif
                        <p class="card-text">{{ $task->body }}</p>
                        <status-component
                            :model="{{ $task->toJson() }}"
                            :current="{{ $task->status()->toJson() }}"
                            :statuses="{{ json_encode($task->availableStatuses()) }}">
                        </status-component>
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
