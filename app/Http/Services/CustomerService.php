<?php

namespace App\Http\Services;

use App\Http\Repositories\CustomerRepository;

class CustomerService extends BaseService
{

    public function __construct(CustomerRepository $customerRepository)
    {
        $this->repository = $customerRepository;
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
