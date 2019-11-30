@foreach($visions as $vision)
    @component('components.inputs.button', [
        'class' => 'd-block w-100 p-3 my-1',
        'color' => 'secondary',
        'value' => $vision->name
    ])
    @endcomponent
@endforeach
