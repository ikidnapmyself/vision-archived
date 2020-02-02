<?php

namespace App\Services;

use App\Interfaces\Services\StatusServiceInterface;
use App\Repositories\TaskRepository;
use Illuminate\Support\Collection;

class StatusService implements StatusServiceInterface
{
    /**
     * @var TaskRepository $repository
     */
    public $repository;

    /**
     * @inheritDoc
     */
    public function index(): Collection
    {
        return collect(config('model-status.allowed_statuses'));
    }
}
