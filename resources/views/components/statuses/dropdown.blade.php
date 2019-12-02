@php
    $config= config('model-status');
@endphp
<div class="dropdown">
    <button class="btn btn-{{ $config['colors'][$model->status] }} dropdown-toggle"
            type="button" id="status-{{ $model->id }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="{{ $config['icons'][$model->status] }}"></i>
        @lang("status.{$model->status}")
    </button>
    <div class="dropdown-menu" aria-labelledby="status-{{ $model->id }}">
        @foreach($model->availableStatuses() as $status)
            @if($model->status !== $status)
            <a class="dropdown-item text-{{ $config['colors'][$status] }}" href="#">
                <i class="{{ $config['icons'][$status] }}"></i>
                @lang("status.{$status}")
            </a>
            @endif
        @endforeach
    </div>
</div>
