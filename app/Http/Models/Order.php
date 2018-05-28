<?php

namespace App\Http\Models;

class Order extends BaseModel
{
    protected $table = 'order';

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

    /**
     * 获取对应的客户表
     */
    public function customer()
    {
        return $this->belongsTo('App\Http\Models\Customer','custom_id');
    }

    /**
     * 获取对应的用户表
     */
    public function userSorting()
    {
        return $this->belongsTo('App\Http\Models\User','driver_sorring_id');
    }

    /**
     * 获取对应的用户表
     */
    public function userAllocate()
    {
        return $this->belongsTo('App\Http\Models\User','driver_allocate_id');
    }
}
