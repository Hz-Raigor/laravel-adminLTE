<?php

namespace App\Http\Services;

use App\Http\Repositories\OrderBatchRepository;

class OrderBatchService extends BaseService
{

    public function __construct(OrderBatchRepository $orderBatchRepository)
    {
        //parent::__construct();
        $this->repository = $orderBatchRepository;
    }

    public function getListByCondition($input)
    {
        $input['DESC'] = 'updatetime';
        $data = $this->repository->getListByCondition($input);
        return $data;
    }

    public function countByCondition($input)
    {
        $data = $this->repository->countByCondition($input);
        return $data;
    }
}
