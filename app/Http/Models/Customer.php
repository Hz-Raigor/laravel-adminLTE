<?php

namespace App\Http\Models;

class Customer extends BaseModel
{
    protected $table = 'custom';
//    protected $fillable = ['id','province_id','name'];  //可被批量赋值的字段
//    protected $connection = 'system_hub';
//
//    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

    public function order()
    {
        return $this->hasMany('App\Http\Models\Order','custom_id');
    }

    public function customerWarehouse()
    {
        return $this->hasOne('App\Http\Models\CustomerWarehouse','custom_id');
    }
}
