@extends('layouts.app')
@section('content')
<div class="container my-5">
    <div class="row">
        <div class="col-12">
            {!! $tasks->links() !!}
        </div>
        <div class="col-12">
            @foreach($tasks as $task)
                <task-component :task="{{ $task->toJson() }}"></task-component>
            @endforeach
        </div>
        <div class="col-12">
            {!! $tasks->links() !!}
        </div>
    </div>
</div>
@endsection
