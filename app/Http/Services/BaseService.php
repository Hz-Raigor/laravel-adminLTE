<?php

namespace App\Http\Services;

class BaseService
{

    public $repository;

    public function __construct()
    {

    }

    public function countByCondition($input)
    {
        $data = $this->repository->countByCondition($input);
        return $data;
    }
}
