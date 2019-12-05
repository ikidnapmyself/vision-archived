@extends('layouts.app')
@section('content')
<div class="container my-5">
    <div class="row">
        <div class="col-12">
            @component('partials.vision')
            @endcomponent
        </div>
        <div class="col-12">
            {!! $tasks->links() !!}
        </div>
        <div class="col-8">
            <div class="list-group mb-3">
                @foreach($tasks as $task)
                <span class="list-group-item list-group-item-action">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">
                            <b-link href="{{ route('task.show', [$task->id]) }}">
                                {{ $task->name }}
                            </b-link>
                        </h5>
                        <div>
                            <small>{{ $task->created_at }}</small>
                        </div>
                    </div>
                    <p class="mb-1">
                        {{ \Illuminate\Support\Str::limit($task->body, 200) }}
                    </p>
                    <task-manager-component
                        :model="{{ $task->toJson() }}"
                        :current="{{ $task->status()->toJson() }}"
                        :statuses="{{ json_encode($task->availableStatuses()) }}">
                    </task-manager-component>
                </span>
                @endforeach
            </div>
        </div>
        <div class="col-4">
            @component('partials.visions', ['visions' => $visions])
            @endcomponent
        </div>
        <div class="col-12">
            {!! $tasks->links() !!}
        </div>
    </div>
</div>
@endsection
