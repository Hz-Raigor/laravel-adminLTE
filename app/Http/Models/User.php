<?php

namespace App\Http\Models;

class User extends BaseModel
{
    protected $table = 'user';

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }
}
