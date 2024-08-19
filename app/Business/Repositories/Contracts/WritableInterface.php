<?php

namespace App\Business\Repositories\Contracts;

interface WritableInterface
{
    public function store(array $data);
    public function update(int $id, array $data);
}