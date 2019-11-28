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
                <a href="{{ route('task.show', [$task->id]) }}" class="list-group-item list-group-item-action">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">{{ $task->name }}</h5>
                        <div>
                            <span title="starred">
                                <i class="fa fa-star{{ $task->starred ? ' text-primary' : '' }}"></i>
                            </span>
                            <span title="flagged">
                                <i class="fa fa-flag{{ $task->flagged ? ' text-primary' : '' }}"></i>
                            </span>
                        </div>
                    </div>
                    <p class="mb-1">{{ \Illuminate\Support\Str::limit($task->body, 200) }}</p>
                    <small>{{ $task->created_at }}</small>
                </a>
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
