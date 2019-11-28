<?php

namespace App\Repositories;

class NotificationRepository extends Repository
{
    /**
     * Specify Model class name.
     *
     * @return string
     */
    public function model()
    {
        return 'App\\Models\\Notification';
    }
}
