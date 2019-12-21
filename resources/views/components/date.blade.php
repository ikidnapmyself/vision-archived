<task-date-component
    ago="{{ $task->ago }}"
    date="{{ $task->created_at }}"
    formatted="{{ $task->date }}"
    :task="{{ $task->toJson() }}"></task-date-component>
