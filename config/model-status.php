<?php

return [

    /*
     * The class name of the status model that holds all statuses.
     *
     * The model must be or extend `Spatie\ModelStatus\Status`.
     */
    'status_model' => App\Models\Status::class,

    /*
     * The name of the column which holds the ID of the model related to the statuses.
     *
     * You can change this value if you have set a different name in the migration for the statuses table.
     */
    'model_primary_key_attribute' => 'model_id',

    /*
     * Bootstrap 4 theme states.
     */
    'colors' => [
        'inbox'       => 'info',
        'backlog'     => 'muted',
        'todo'        => 'dark',
        'progressing' => 'primary',
        'completed'   => 'success',
        'canceled'    => 'warning',
        'archived'    => 'secondary',
        'deleted'     => 'danger',
        'failed'      => 'info',
    ],

    /*
     * Font Awesome icons.
     */
    'icons' => [
        'inbox'       => 'fa fa-inbox',
        'backlog'     => 'fa fa-folder-open',
        'todo'        => 'fa fa-tasks',
        'progressing' => 'fa fa-spinner fa-spin',
        'completed'   => 'fa fa-check',
        'canceled'    => 'fa fa-times',
        'archived'    => 'fa fa-archive',
        'deleted'     => 'fa fa-trash-alt',
        'failed'      => 'fa fa-diagnoses',
    ],
];
