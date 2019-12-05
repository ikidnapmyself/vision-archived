<?php

namespace App\Services;

use App\Interfaces\ServiceInterface;

class BaseService extends ValidationService implements ServiceInterface
{
    /**
     * @var mixed
     */
    protected $repository;

    /**
     * Get repository.
     *
     * @return mixed
     */
    public function repository()
    {
        return $this->repository;
    }

    /**
     * {@inheritdoc}
     */
    public function index()
    {
        return $this->repository->paginate();
    }

    /**
     * {@inheritdoc}
     */
    public function show(string $id)
    {
        return $this->repository()->find($id);
    }

    /**
     * {@inheritdoc}
     */
    public function create(?array $attributes = [])
    {
        $validated = $this->validate();

        $attributes = array_merge($attributes, $validated);

        return $this->repository()->create($attributes);
    }

    /**
     * {@inheritdoc}
     */
    public function update(string $id, ?array $attributes = [])
    {
        $validated = $this->validate();

        $attributes = array_merge($attributes, $validated);

        return $this->repository()->update($attributes, $id);
    }

    /**
     * {@inheritdoc}
     */
    public function delete(string $id)
    {
        return $this->repository()->delete($id);
    }
}
