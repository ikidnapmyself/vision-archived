<?php
namespace App\Repositories;

class NotificationRepository extends Repository {

    /**
     * Specify Model class name
     *
     * @return string
     */
    function model()
    {
        return "App\\Models\\Notification";
    }
}
