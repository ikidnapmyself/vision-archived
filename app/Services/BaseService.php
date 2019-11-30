<?php
namespace App\Services;

use App\Interfaces\ServiceInterface;

class BaseService extends ValidationService implements ServiceInterface
{
    /**
     * @var mixed $repository
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
     * @inheritDoc
     */
    public function index()
    {
        return $this->repository->paginate();
    }

    /**
     * @inheritDoc
     */
    public function show(string $id)
    {
        return $this->repository()->find($id);
    }

    /**
     * @inheritDoc
     */
    public function create(?array $attributes = [])
    {
        $validated = $this->validate();

        $attributes = array_merge($attributes, $validated);

        return $this->repository()->create($attributes);
    }

    /**
     * @inheritDoc
     */
    public function update(string $id, ?array $attributes = [])
    {
        $validated = $this->validate();

        $attributes = array_merge($attributes, $validated);

        return $this->repository()->update($attributes, $id);
    }

    /**
     * @inheritDoc
     */
    public function delete(string $id)
    {
        return $this->repository()->delete($id);
    }
}
