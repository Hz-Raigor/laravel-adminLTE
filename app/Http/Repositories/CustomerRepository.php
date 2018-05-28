<?php

namespace App\Http\Repositories;

use App\Http\Models\Customer;

class CustomerRepository extends BaseRepository
{

    public function __construct(Customer $customer)
    {
        $this->model = $customer;
    }
}