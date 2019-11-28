@extends('layouts.app')
@section('title', __('task.edit.Edit', ['name' => $task->name]))
@section('content')
    <div class="container my-5">
        <h3 class="title">@lang('task.edit.Edit', ['name' => $task->name])</h3>
        <div class="row">
            <div class="col-12">
                @component('components.form', ['action' => ''])
                    @slot('form')
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">{{ $task->name }}</h5>
                                <p class="card-text">{{ $task->body }}</p>
                            </div>
                        </div>
                    @endslot
                @endcomponent
            </div>
            <div class="col-12 my-2">
                @component('partials.assignees', ['assignees' => $task->assignees])
                @endcomponent
            </div>
        </div>
    </div>
@endsection
