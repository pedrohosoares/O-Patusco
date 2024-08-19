<?php

namespace App\Business\Repositories\Contracts;

interface ReadableInterface
{
    public function show($id);
    public function index($params);
}
