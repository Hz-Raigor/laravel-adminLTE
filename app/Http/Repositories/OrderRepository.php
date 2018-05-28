<?php

namespace App\Http\Repositories;

use App\Http\Models\Order;
use Illuminate\Support\Facades\DB;

class OrderRepository extends BaseRepository
{

    public function __construct(Order $order)
    {
        //parent::__construct();
        $this->model = $order;
    }

    public function create($data)
    {
        $model = $this->model;
        foreach ($data as $dataKey => $dataValue) {
            if ($dataKey == 'goods') {
                continue;
            }
            $model->$dataKey = $dataValue;
        }
//        var_dump($model);die;
        $res = $this->model->save();
//        var_dump($res);die;
        return $res;

    }
}

