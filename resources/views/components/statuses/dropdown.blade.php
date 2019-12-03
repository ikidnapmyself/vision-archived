@php
    $config= config('model-status');
@endphp
<div class="btn-group">
    <button class="btn btn-{{ $config['colors'][$model->status] }}"
            type="button" id="status-{{ $model->id }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="{{ $config['icons'][$model->status] }}"></i>
        @lang("status.{$model->status}")
    </button>
    <button type="button" class="btn btn-{{ $config['colors'][$model->status] }} dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <span class="sr-only">Toggle Dropdown</span>
    </button>
    <div class="dropdown-menu" aria-labelledby="status-{{ $model->id }}">
        <b class="px-3">@lang('components.statuses.Move to')</b>
        <div class="dropdown-divider"></div>
        @foreach($model->availableStatuses() as $status)
            @if($model->status !== $status)
                @if(View::exists("components.statuses.buttons.{$status}"))
                    @component("components.statuses.buttons.{$status}", [
                        'model' => $model,
                        'type'  => $type ?? 'dropdown',
                    ])
                    @endcomponent
                @else
                    <a class="dropdown-item text-{{ $config['colors'][$status] }}" href="#">
                        <i class="{{ $config['icons'][$status] }}"></i>
                        @lang("status.{$status}")
                    </a>
                @endif
            @endif
        @endforeach
    </div>
</div>
