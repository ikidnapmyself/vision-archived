<?php
namespace App\Models;

use Spatie\ModelStatus\Status as BaseStatus;

class Status extends BaseStatus
{
    const INBOX       = 'inbox';
    const BACKLOG     = 'backlog';
    const TODO        = 'todo';
    const PROGRESSING = 'progressing';
    const COMPLETED   = 'completed';
    const CANCELED    = 'canceled';
    const ARCHIVED    = 'archived';
    const DELETED     = 'deleted';
    const FAILED      = 'failed';
}
