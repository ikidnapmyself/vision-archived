<?php

return [
    'vision' => [
        'Vision' => 'Vision',
    ],

    'shared' => [
        'connection-error' => [
            'message' => 'It will try to fetch data :second seconds...',
        ],
    ],

    'inputs' => [
        'button' => [
            'find'   => 'Find',
            'delete' => 'Delete',
            'reset'  => 'Reset',
            'update' => 'Update',
            'save'   => 'Save',
            'search' => 'Search',
            'show'   => 'Show',
        ],
    ],

    'task'  => [
        'Assignees' => 'Assignees',
        'Assign'    => 'Assign',
        'Timeline'  => 'Timeline',
        'Go to task'=> 'Go to task',
        'New'       => 'New',
        'Overview'  => 'Overview',
        'Read All'  => 'Read All',
        'Update'    => 'Update',
        'Share'     => 'Share',
        'Flagged Nav' => 'Flagged',
        'Flagged'   => '":task_name" is not important anymore.',
        'No Flag'   => '":task_name" is marked as important.',
        'Flag Failed'   => 'Unable to update flag status. Please try again later.',

        'assignees' => [
            'Assign Yourself' => 'Assign Yourself',
            'Already Assigned' => 'Assigned to You',
            'Assign' => 'Assign',
            'Assignee' => 'Assignee',
            'Assigned' => ':full_name successfully assigned to ":task_name".',
            'Assignee Failed' => 'Unable to assign. Please try again later.',
            'Blocker'   => 'Blocker',
            'Blocker Sub Title'   => 'Blocking may prevent completion of a project.',
            'Created At'   => 'Created At',
            'Complete'   => 'Complete',
            'Completed'   => '":task_name" successfully completed by :user_name',
            'Complete Failed'   => 'Unable to complete the task. Please try again later.',
            'Completed At'   => 'Completed At',
            'Defer'   => 'Defer',
            'Defer Sub Title'   => 'Deferring will hide it for a clear vision until the time, you set.',
            'Deferred'   => 'Deferred',
            'Deleted At'   => 'Deleted At',
            'Due'   => 'Due',
            'Due Sub Title'   => 'Blocking may prevent completion of a project.',
            'Edit'   => 'Update Assignee',
            'Copy'   => 'Copy E-mail',
            'Difficulty'   => 'Task Difficulty',
            'Difficulty Sub Title'   => 'Task difficulty defines compatibility of this assignee and the task.',
            'Difficulty DevNote'   => 'Any task may hard or easy. 
                                       But on the another hand an easy task may hard if it is badly engaged. 
                                       Negative direction referring lower qualification with too much attachments.',
            'Estimated Time'   => 'Estimated Time',
            'Estimated Time Sub Title'   => 'An objective time estimation will help you to measure project with better assignments.',
            'Estimated Time Unit'   => 'min.',
            'Friends Failed' => 'Unable to fetch your friend list. Please try again later.',
            'Mail To'   => 'Send E-mail',
            'No Friend' => 'You have no friends',
            'title' => 'Assignees',

            'Unassign'   => 'Unassign',
            'Unassigned'   => ':user_name successfully unassigned.',
            'Unassign Failed'   => 'Unable to unassign the user. Please try again later.',
            'Updated At'   => 'Updated At',
            'Updated' => 'Assignee successfully updated.',
            'Update Failed' => 'Unable to assign. Please try again later.',

            'New Assignee' => 'Assignable Friends (:friendsLeft)',
            'No Assignee Body' => 'You can assign yourself or someone else who is in your network as your friend.',
            'Assign Your Friends' => 'Assign Your Friends',
            'No Assignee Lead' => 'You have no assignee for this task. Assignees are useful to track you work and collaborations. To assign this task, you might use shortcut buttons below.',

            'No' => 'No',
            'Yes' => 'Yes',

            'Update' => 'Update',
            'Failed' => 'An error occurred while updating assignation.',
            'Reset'  => 'Reset',
        ],

        'date'  => [
            'Switch' => 'Switch',
            'Update'   => 'Update Timing',
            'Copy'   => 'Copy',
            'Defer'  => 'Defer',
            'Remind me today'  => 'Remind me today',
            'Custom'  => 'Custom',
            'Later'  => 'Later',
        ],

        'developers-note'  => [
            'Developers Note' => 'Developer\'s Note',
            'Contribute' => 'Contribute',
        ],

        'overview'  => [
            'Toggle' => 'Toggle Task Description',
            'Copy'   => 'Copy Link',
        ],

        'statuses' => [
            'Move to' => 'Move to',
            'Add Your Reason' => 'You may add your reason before you update the status from :From to :New',
            'Reason' => 'Status update reason or note.',
            'Updated' => 'Status has changed successfully.',
            'Failed' => 'An error occurred while changing status.',
        ],

        'tab-edit'  => [
            'Task' => 'Task',
            'Task Description'   => 'Describe your task as lean as possible, it should contain at least six characters.',
            'title' => 'Update This Task',
            'Body' => 'Task Description',
            'Body Description'   => 'A few words to provide details.',
            'Update' => 'Update',
            'Updated' => 'The task has been updated successfully.',
            'Failed' => 'An error occurred while updating status.',
            'Reset'  => 'Reset',
        ],

        'timeline' => [
            'title' => 'Activity Timeline',
        ],
    ],

    'user' => [
        'no friend yet' => 'No Friend',
        'number of friends' => ':friends_length Friends',
        'no groups yet' => 'No Group',
        'number of groups' => ':groups_length Groups',
        'no boards yet' => 'No Board',
        'number of boards' => ':boards_length Boards',
    ],

    'toaster' => [
        'primary'   => 'Primary',
        'secondary' => 'Secondary',
        'danger'    => 'Danger',
        'warning'   => 'Warning',
        'success'   => 'Success',
        'info'      => 'Info',
    ],

];
