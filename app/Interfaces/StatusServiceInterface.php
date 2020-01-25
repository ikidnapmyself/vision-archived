<?php

namespace App\Interfaces;

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
