<?php

namespace App\Http\Repositories;

use App\Http\Models\Order;
use Illuminate\Support\Facades\DB;

class OrderRepository extends BaseRepository
{

    public $order;
    public function __construct(Order $order)
    {
        //parent::__construct();
        $this->order = $order;
        $this->model = $this->order;
    }
}
