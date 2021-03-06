<?php
namespace App\Repositories;

use App\Models\Notification;

class NotificationRepository extends Repository {

    /**
     * Specify Model class name
     *
     * @return string
     */
    function model()
    {
        return Notification::class;
    }
}
