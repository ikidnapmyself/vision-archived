@php
    $type   = $type ?? 'dropdown';
    $config = config('model-status');
@endphp
<a href="#" class="{{ ($type === 'dropdown') ? 'dropdown-item' : 'card-link'  }} text-{{ $config['colors']['deleted'] }}"
   onclick="event.preventDefault();document.getElementById('delete-{{ $model->id }}-form').submit();">
    <i class="{{ $config['icons']['deleted'] }}"></i>
    @lang("status.deleted")
</a>
@push('forms')
    <form id="delete-{{ $model->id }}-form" action="{{ route('task.destroy', ['task' => $model->id]) }}" method="POST" style="display: none;">
        @method('DELETE')
        @csrf
    </form>
@endpush
