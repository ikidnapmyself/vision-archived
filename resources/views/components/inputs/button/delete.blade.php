@component('components.inputs.button', [
    'type'  => $type ?? 'submit',
    'color' => 'danger',
    'icon'  => 'fa fa-trash-alt',
    'value' => $value ?? __('components.inputs.button.delete'),
])
@endcomponent
