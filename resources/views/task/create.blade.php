@extends('layouts.app')
@section('title', __('task.create.Create'))
@section('content')
    <div class="container my-5">
        <h3 class="title">@lang('task.create.Create')</h3>
        <div class="row">
            <div class="col-12">
                @component('components.form', ['action' => route('task.store')])
                    @slot('form')
                        <div class="card">
                            <div class="card-body">
                                @component('components.group', [
                                    'code'   => 'name',
                                    'lang'   => __('task.edit.name'),
                                    'inline' => __('task.edit.name_inline'),
                                ])
                                @endcomponent
                                @component('components.group', [
                                    'input'  => 'textarea',
                                    'code'   => 'body',
                                    'lang'   => __('task.edit.body'),
                                    'inline' => __('task.edit.body_inline'),
                                ])
                                @endcomponent
                                @component('components.forms.create')
                                @endcomponent
                            </div>
                        </div>
                    @endslot
                @endcomponent
            </div>
        </div>
    </div>
@endsection
