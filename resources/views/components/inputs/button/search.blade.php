@component('components.inputs.button', [
    'type'  => $type ?? 'submit',
    'color' => 'info',
    'icon'  => 'fa fa-search',
    'class' => 'text-light',
    'value' => $value ?? __('components.inputs.button.search'),
])
@endcomponent
