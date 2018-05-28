<?php

namespace App\Http\Services;

use App\Http\Repositories\UserRepository;

class UserService extends BaseService
{

    public function __construct(UserRepository $userRepository)
    {
        $this->repository = $userRepository;
    }

    public function getListByCondition($input)
    {
        $data = $this->repository->getListByCondition($input);
        return $data;
    }

    public function countByCondition($input)
    {
        $data = $this->repository->countByCondition($input);
        return $data;
    }
}
