@component('components.form', ['action' => '', 'class' => 'my-5'])
    @slot('form')
        <vision-component></vision-component>
        @component('components.button', [
            'color'  => 'primary',
            'icon'   => 'fa fa-search',
            'button' => __('components.vision.Vision')
        ])
        @endcomponent
    @endslot
@endcomponent
