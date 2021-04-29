<?php

namespace App\Interfaces\Services;

use Illuminate\Support\Collection;

interface StatusServiceInterface
{
    /**
     * Paginate models.
     *
     * @return Collection
     */
    public function index(): Collection;
}
