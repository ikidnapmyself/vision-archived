<?php

namespace App\Interfaces;

interface ServiceInterface
{
    /**
     * Get repository.
     *
     * @return mixed
     */
    public function repository();

    /**
     * Paginate models.
     *
     * @return mixed
     */
    public function index();

    /**
     * Display model.
     *
     * @param string $id
     * @return mixed
     */
    public function show(string $id);

    /**
     * Utilize repository to create a model.
     *
     * @param array|null $attributes
     * @return mixed
     */
    public function create(?array $attributes = []);

    /**
     * Update a model.
     *
     * @param string $id
     * @param array|null $attributes
     * @return mixed
     */
    public function update(string $id, ?array $attributes = []);

    /**
     * Delete a model.
     *
     * @param string $id
     * @return mixed
     */
    public function delete(string $id);
}
