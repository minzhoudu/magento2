<?php

namespace BeeIT\RESTmodule\Api;

interface TodoItemRepositoryInterface
{
    /**
     * @return array
     */
    public function getAll(): array;

    /**
     * @return array
     */
    public function update(): array;

    /**
     * @return array
     */
    public function create(): array;

    /**
     * @return array
     */
    public function getById(): array;

    /**
     * @return array
     */
    public function delete(): array;
}
