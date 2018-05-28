<?php

namespace App\Http\Models;

class OrderBatch extends BaseModel
{
    protected $table = 'order_batch';

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

    /**
     * 获取对应的订单表
     */
    public function order()
    {
        return $this->belongsTo('App\Http\Models\Order','batch','batch');
    }

}
