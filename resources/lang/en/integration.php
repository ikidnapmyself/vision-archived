<?php

return [
    'integrate' => 'Integrate',
    'github' => [
        'name' => 'GitHub',
        'read more' => 'Understanding scopes for OAuth Apps...',
        'scopes' => [
            'no-scope' => 'Grants read-only access to public information (includes public user profile info, public 
            repository info, and gists)',
            'public_repo' => 'Limits access to public repositories. That includes read/write access to code, 
            commit statuses, repository projects, collaborators, and deployment statuses for public repositories 
            and organizations. Also required for starring public repositories.',
            'read:user' => 'Grants access to read a user\'s profile data.',
            'read:org' => 'Read-only access to organization membership, organization projects, and team membership.',
        ],
    ],
];
