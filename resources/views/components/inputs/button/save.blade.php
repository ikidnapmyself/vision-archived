@component('components.inputs.button', [
    'type'  => $type ?? 'submit',
    'color' => 'success',
    'icon'  => 'fa fa-save',
    'class' => 'text-light',
    'value' => $value ?? __('components.inputs.button.save'),
])
@endcomponent
