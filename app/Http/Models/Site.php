<?php

namespace App\Http\Models;

class Site extends BaseModel
{
    protected $table = 'site';

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }
}
