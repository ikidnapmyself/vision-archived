<?php

namespace App\Traits;

use Spatie\ModelStatus\HasStatuses as BaseTrait;

trait HasStatuses
{
    use BaseTrait;

    /**
     * Pre-defined statuses.
     *
     * @var array
     */
    private $statuses = [
        'backlog', 'todo', 'progressing', 'completed', 'canceled', 'archived', 'deleted', 'failed',
    ];

    /**
     * Custom status validation.
     *
     * @param string $name
     * @param string|null $reason
     * @return bool
     */
    public function isValidStatus(string $name, ?string $reason = null): bool
    {
        return in_array($name, $this->statuses);
    }
}
