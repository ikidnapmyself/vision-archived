@extends('layouts.app')
@section('title', __('task.edit.Edit', ['name' => $task->name]))
@section('content')
    <div class="container my-5">
        <h3 class="title">@lang('task.edit.Edit', ['name' => $task->name])</h3>
        <div class="row">
            <div class="col-12">
                @component('components.form', ['action' => route('task.update', ['task' => $task->id])])
                    @slot('form')
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">{{ $task->name }}</h5>
                                @component('components.group', [
                                    'code'   => 'name',
                                    'value'  => $task->name,
                                    'lang'   => __('task.edit.name'),
                                    'inline' => __('task.edit.name_inline'),
                                ])
                                @endcomponent
                                @component('components.group', [
                                    'input'  => 'textarea',
                                    'code'   => 'body',
                                    'value'  => $task->body,
                                    'lang'   => __('task.edit.body'),
                                    'inline' => __('task.edit.body_inline'),
                                ])
                                @endcomponent
                                @component('components.forms.update')
                                @endcomponent
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
