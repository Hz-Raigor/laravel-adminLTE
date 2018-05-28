<?php

namespace App\Http\Repositories;

use App\Http\Models\OrderBatch;
use Illuminate\Support\Facades\DB;

class OrderBatchRepository extends BaseRepository
{

    public function __construct(OrderBatch $orderBatch)
    {
        //parent::__construct();
        $this->model = $orderBatch;
    }
}

