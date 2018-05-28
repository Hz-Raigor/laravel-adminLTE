<?php

namespace App\Http\Services;

use App\Http\Repositories\CustomerWarehouseRepository;

class CustomerWarehouseService extends BaseService
{

    public function __construct(CustomerWarehouseRepository $customerWarehouseRepository)
    {
        $this->repository = $customerWarehouseRepository;
    }

    public function getListByCondition($input)
    {
        $data = $this->repository->getListByCondition($input);
        return $data;
    }

    public function countByCondition($input)
    {
        $data = $this->repository->countByCondition($input);
        return $data;
    }
}
