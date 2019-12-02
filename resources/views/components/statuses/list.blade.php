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
