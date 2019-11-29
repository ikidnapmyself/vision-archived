@component('components.inputs.button', [
    'type'  => $type ?? 'submit',
    'color' => 'primary',
    'icon'  => 'fa fa-sync-alt',
    'class' => 'text-light',
    'value' => $value ?? __('components.inputs.button.update'),
])
@endcomponent
