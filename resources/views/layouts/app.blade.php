<!doctype html>
<html lang="{{ str_replace('_', '-', config('app.locale')) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') | {{ config('app.name', 'Vision') }}</title>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="{{ config('ui.mode') === 'dark' ? 'bg-secondary' : '' }}">
    <div id="app">
        @component('partials.navigation')
        @endcomponent
        @if (session('status'))
            <div class="alert alert-success m-0 py-3 px-lg-5" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <main>
            @yield('content')
        </main>
        <footer class="container py-4 text-center">
            <p>© {{ config('app.name') }} {{ date('Y') }} | <a href="{{ config('app.github') }}">GitHub</a></p>
        </footer>
    </div>
    <script src="//kit.fontawesome.com/{{ config('ui.font_awesome') }}.js" crossorigin="anonymous"></script>
    <script>
        let Application = {
            location: "{{ url('/') }}",
            locale: "{{ config('app.locale') }}",
            auth: {{ auth()->user() ? 'true' : 'false' }},
            statuses: {
                icons: @json(config('model-status.icons')),
                colors: @json(config('model-status.colors'))
            }
        };
        @if(auth()->user())
            Application.user = @json(auth()->user());
        let Operators = {
            'id': ['equal', 'not_equal', 'in', 'not_in'],
            'time': ['equal', 'not_equal', 'less', 'less_or_equal', 'greater', 'greater_or_equal', 'between', 'not_between'],
            'select': ['equal', 'not_equal'],
            'string': ['equal', 'begins_with', 'not_begins_with', 'contains', 'not_contains', 'ends_with', 'not_ends_with'],
            'boolean': ['equal'],
            'integer': ['equal', 'not_equal', 'less', 'less_or_equal', 'greater', 'greater_or_equal', 'between', 'not_between'],
        };
        let Presets = {
            'bool': {false: "{{ __('globals.False') }}", true: "{{ __('globals.True') }}"}
        };
        let Filters = [
            {
                id: 'assignees.id',
                label: '{{ __('fields.assignees') }} > {{ __('fields.id') }}',
                type: 'string',
                operators: Operators.id
            },
            {
                id: 'assignees.assigned_by',
                label: '{{ __('fields.assignees') }} > {{ __('fields.assigned_by') }}',
                type: 'string',
                input: 'select',
                operators: Operators.select,
                values: @json(session('users', []))
            },
            {
                id: 'assignees.user_id_string',
                field: 'assignees.user_id',
                label: '{{ __('fields.assignees') }} > {{ __('fields.user_id_string') }}',
                type: 'string',
                operators: Operators.id
            },
            {
                id: 'assignees.user_id',
                label: '{{ __('fields.assignees') }} > {{ __('fields.user_id') }}',
                type: 'string',
                input: 'select',
                operator: Operators.select,
                values: @json(session('users', []))
            },
            {
                id: 'assignees.task_id',
                label: '{{ __('fields.assignees') }} > {{ __('fields.task_id') }}',
                type: 'string',
                operator: Operators.id
            },
            {
                id: 'assignees.due',
                label: '{{ __('fields.assignees') }} > {{ __('fields.due') }}',
                format: 'datetime',
                type: 'datetime',
                operator: Operators.time
            },
            {
                id: 'assignees.defer',
                label: '{{ __('fields.assignees') }} > {{ __('fields.defer') }}',
                format: 'datetime',
                type: 'datetime',
                operator: Operators.time
            },
            {
                id: 'assignees.estimated_time',
                label: '{{ __('fields.assignees') }} > {{ __('fields.estimated_time') }}',
                type: 'integer',
                operator: Operators.integer
            },
            {
                id: 'assignees.blocker',
                label: '{{ __('fields.assignees') }} > {{ __('fields.blocker') }}',
                type: 'boolean',
                input: 'select',
                operator: Operators.boolean,
                values: Presets.bool
            },
            {
                id: 'assignees.flagged',
                label: '{{ __('fields.assignees') }} > {{ __('fields.flagged') }}',
                type: 'boolean',
                input: 'select',
                values: Presets.bool,
                operator: Operators.boolean
            },
            {
                id: 'assignees.created_at',
                label: '{{ __('fields.assignees') }} > {{ __('fields.created_at') }}',
                format: 'datetime',
                type: 'datetime',
                operator: Operators.time
            },
            {
                id: 'assignees.updated_at',
                label: '{{ __('fields.assignees') }} > {{ __('fields.updated_at') }}',
                format: 'datetime',
                type: 'datetime',
                operator: Operators.time
            },
            {
                id: 'projects.id',
                label: '{{ __('fields.projects') }} > {{ __('fields.id') }}',
                type: 'string',
                operators: Operators.id
            },
            {
                id: 'projects.name',
                label: '{{ __('fields.projects') }} > {{ __('fields.name') }}',
                type: 'string',
                operator: Operators.string
            },
            {
                id: 'projects.type',
                label: '{{ __('fields.projects') }} > {{ __('fields.type') }}',
                type: 'string'
            },
            {
                id: 'projects.due',
                label: '{{ __('fields.projects') }} > {{ __('fields.due') }}',
                format: 'datetime',
                type: 'datetime',
                operator: Operators.time
            },
            {
                id: 'projects.defer',
                label: '{{ __('fields.projects') }} > {{ __('fields.defer') }}',
                format: 'datetime',
                type: 'datetime',
                operator: Operators.time
            },
            {
                id: 'projects.deadline',
                label: '{{ __('fields.projects') }} > {{ __('fields.deadline') }}',
                format: 'datetime',
                type: 'datetime',
                operator: Operators.time
            },
            {
                id: 'projects.status',
                label: '{{ __('fields.projects') }} > {{ __('fields.status') }}',
                type: 'string'
            },
            {
                id: 'projects.flagged',
                label: '{{ __('fields.projects') }} > {{ __('fields.flagged') }}',
                type: 'boolean',
                input: 'select',
                values: Presets.bool,
                operator: Operators.boolean
            },
            {
                id: 'projects.last_action_complete',
                label: '{{ __('fields.projects') }} > {{ __('fields.last_action_complete') }}',
                type: 'boolean',
                input: 'select',
                values: Presets.bool,
                operator: Operators.boolean
            },
            {
                id: 'projects.completed_at',
                label: '{{ __('fields.projects') }} > {{ __('fields.completed_at') }}',
                format: 'datetime',
                type: 'datetime',
                operator: Operators.time
            },
            {
                id: 'projects.created_at',
                label: '{{ __('fields.projects') }} > {{ __('fields.created_at') }}',
                format: 'datetime',
                type: 'datetime',
                operator: Operators.time
            },
            {
                id: 'projects.updated_at',
                label: '{{ __('fields.projects') }} > {{ __('fields.updated_at') }}',
                format: 'datetime',
                type: 'datetime',
                operator: Operators.time
            },
            {
                id: 'tasks.id',
                label: '{{ __('fields.tasks') }} > {{ __('fields.id') }}',
                type: 'string',
                operators: Operators.id
            },
            {
                id: 'tasks.project_id',
                label: '{{ __('fields.tasks') }} > {{ __('fields.project_id') }}',
                type: 'string',
                operators: Operators.id
            },
            {
                id: 'tasks.top_id',
                label: '{{ __('fields.tasks') }} > {{ __('fields.top_id') }}',
                type: 'string',
                operators: Operators.id
            },
            {
                id: 'tasks.parent_id',
                label: '{{ __('fields.tasks') }} > {{ __('fields.parent_id') }}',
                type: 'string',
                operators: Operators.id
            },
            {
                id: 'tasks.name',
                label: '{{ __('fields.tasks') }} > {{ __('fields.name') }}',
                type: 'string',
                operator: Operators.string
            },
            {
                id: 'tasks.body',
                label: '{{ __('fields.tasks') }} > {{ __('fields.body') }}',
                type: 'string',
                operator: Operators.string
            },
            {
                id: 'tasks.status',
                label: '{{ __('fields.tasks') }} > {{ __('fields.status') }}',
                type: 'string',
                input: 'select',
                operators: Operators.select,
                values: Presets.bool
            },
            {
                id: 'tasks.completed_at',
                label: '{{ __('fields.tasks') }} > {{ __('fields.completed_at') }}',
                format: 'datetime',
                type: 'datetime',
                operator: Operators.time
            },
            {
                id: 'tasks.created_at',
                label: '{{ __('fields.tasks') }} > {{ __('fields.created_at') }}',
                format: 'datetime',
                type: 'datetime',
                operator: Operators.time
            },
            {
                id: 'tasks.updated_at',
                label: '{{ __('fields.tasks') }} > {{ __('fields.updated_at') }}',
                format: 'datetime',
                type: 'datetime',
                operator: Operators.time
            }
        ];
        @endif
    </script>
    @stack('scripts')
    @stack('forms')
</body>
</html>
