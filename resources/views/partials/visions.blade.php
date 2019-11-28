@component('components.form', ['action' => ''])
    @slot('form')
        @foreach($visions as $vision)
            @component('components.button', [
                'class'  => 'd-block w-100 p-3 my-1',
                'color'  => 'secondary',
                'button' => $vision->name
            ])
            @endcomponent
        @endforeach
    @endslot
@endcomponent
