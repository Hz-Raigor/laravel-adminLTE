<?php

namespace App\Http\Repositories;

use App\Http\Models\CustomerWarehouse;

class CustomerWarehouseRepository extends BaseRepository
{

    public function __construct(CustomerWarehouse $customerWarehouse)
    {
        $this->model = $customerWarehouse;
    }
}