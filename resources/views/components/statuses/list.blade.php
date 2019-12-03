@php
    $config= config('model-status');
@endphp
<b>@lang('components.statuses.Move to'):</b>
<a href="#" class="card-link text-{{ $config['colors'][$model->status] }}">
    <i class="{{ $config['icons'][$model->status] }}"></i>
    @lang("status.{$model->status}")
</a>
@foreach($model->availableStatuses() as $status)
    @if($model->status !== $status)
        @if(View::exists("components.statuses.buttons.{$status}"))
            @include("components.statuses.buttons.{$status}")
        @else
            <a href="#" class="card-link text-{{ $config['colors'][$status] }}">
                <i class="{{ $config['icons'][$status] }}"></i>
                @lang("status.{$status}")
            </a>
        @endif
    @endif
@endforeach
