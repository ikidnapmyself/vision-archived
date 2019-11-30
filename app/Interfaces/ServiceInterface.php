<?php

namespace App\Interfaces;

interface ServiceInterface
{
    public function repository();

    public function index();

    /**
     * Display model.
     *
     * @param string $id
     * @return mixed
     */
    public function show(string $id);

    public function create();

    /**
     * Update a model.
     *
     * @param array $attributes
     * @param string $id
     * @return mixed
     */
    public function update(array $attributes, string $id);

    public function delete();
}
