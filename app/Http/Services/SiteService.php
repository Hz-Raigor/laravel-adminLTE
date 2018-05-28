<?php

namespace App\Http\Services;

use App\Http\Repositories\SiteRepository;

class SiteService extends BaseService
{

    public function __construct(SiteRepository $siteRepository)
    {
        $this->repository = $siteRepository;
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
