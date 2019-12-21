@php
    /**
     * @var \Carbon\Carbon $task->created_at
     */
    $formatted = date("j F Y, H:i", $task->created_at->timestamp);
@endphp
<task-date-component
    ago="{{ $task->created_at->diffForHumans() }}"
    date="{{ $task->created_at->toDateTimeString() }}"
    formatted="{{ $formatted }}"
    :task="{{ $task->toJson() }}"></task-date-component>
