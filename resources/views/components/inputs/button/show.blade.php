@component('components.inputs.button', [
    'type'  => $type ?? 'submit',
    'color' => 'info',
    'icon'  => 'fa fa-search-plus',
    'class' => 'text-light',
    'value' => $value ?? __('components.inputs.button.show'),
])
@endcomponent
