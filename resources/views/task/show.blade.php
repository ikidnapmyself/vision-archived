@extends('layouts.app')
@section('title', $task->name)
@section('content')
    <div class="container my-5">
        <div class="row">
            <div class="col-8">
                <div class="card mb-3">
                    <div class="card-header">
                        <ul class="nav nav-pills card-header-pills">
                            <li class="nav-item">
                                <a class="nav-link active" href="#">Active</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Active</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Active</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body text-center">
                        <h5 class="card-title">
                            <b-link href="{{ route('task.show', [$task->id]) }}">
                                {{ $task->name }}
                            </b-link>
                        </h5>
                        <p class="card-text">{{ $task->body }}</p>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col col-xs-12">
                                <task-manager-component
                                    :model="{{ $task->toJson() }}"
                                    :current="{{ $task->status()->toJson() }}"
                                    :statuses="{{ json_encode($task->availableStatuses()) }}">
                                </task-manager-component>
                            </div>
                            <div class="col col-xs-12 text-right">
                                @component('components.date', ['date' => $task->created_at])
                                @endcomponent
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <!--
                 BLADE VERSION
                 resources/views/partials/assignees.blade.php
                 //-->
                <task-self-assign-component
                    :assignees="{{ $task->assignees }}">
                </task-self-assign-component>
                <task-assignees-component
                    :assignees="{{ $task->assignees }}">
                </task-assignees-component>
            </div>
        </div>
    </div>
@endsection
