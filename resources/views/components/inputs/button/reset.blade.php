@component('components.inputs.button', [
    'type'  => $type ?? 'reset',
    'color' => 'secondary',
    'icon'  => 'fa fa-redo-alt',
    'value' => $value ?? __('components.inputs.button.reset'),
])
@endcomponent
