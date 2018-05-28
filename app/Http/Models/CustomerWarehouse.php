<?php

namespace App\Http\Models;

class CustomerWarehouse extends BaseModel
{
    protected $table = 'custom_worehouse';
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

    public function customer()
    {
        return $this->belongsTo('App\Http\Models\Customer','id','custom_id');
    }

}
