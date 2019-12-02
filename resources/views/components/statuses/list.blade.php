@php
    $config= config('model-status');
@endphp
<a href="#" class="card-link text-{{ $config['colors'][$model->status] }}">
    <i class="{{ $config['icons'][$model->status] }}"></i>
    @lang("status.{$model->status}")
</a>
@foreach($model->availableStatuses() as $status)
    @if($model->status !== $status)
        <a href="#" class="card-link text-{{ $config['colors'][$status] }}">
            <i class="{{ $config['icons'][$status] }}"></i>
            @lang("status.{$status}")
        </a>
    @endif
@endforeach
@push('script')
    <script>

    </script>
@endpush

<a onclick="event.preventDefault();document.getElementById('delete-{{ $task->id }}-form').submit();" class="card-link text-danger">
    <i class="fa fa-trash-alt"></i>
    @lang('task.show.Delete')
</a>
<form id="delete-{{ $task->id }}-form" action="{{ route('task.destroy', ['task' => $task->id]) }}" method="POST" style="display: none;">
    @method('DELETE')
    @csrf
</form>
