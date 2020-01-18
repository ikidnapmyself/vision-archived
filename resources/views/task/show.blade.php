@extends('layouts.app')
@section('title', $task->name)
@section('content')
    <task-component :task="{{ $task->toJson() }}"></task-component>
@endsection
