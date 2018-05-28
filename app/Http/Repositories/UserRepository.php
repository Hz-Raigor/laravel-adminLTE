<?php

namespace App\Http\Repositories;

use App\Http\Models\User;

class UserRepository extends BaseRepository
{

    public function __construct(User $user)
    {
        $this->model = $user;
    }
}