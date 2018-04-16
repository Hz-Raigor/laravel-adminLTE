<?php

namespace App\Http\Services;

use App\Http\Repositories\OrderRepository;

class OrderService extends BaseService
{

    public $orderRepository;
    public function __construct(OrderRepository $orderRepository)
    {
        //parent::__construct();
        $this->orderRepository = $orderRepository;
    }

    public function getListByCondition($input)
    {
        $data = $this->orderRepository->getListByCondition($input);
        return $data;
    }

    public function countByCondition($input)
    {
        $data = $this->orderRepository->countByCondition($input);
        return $data;
    }
}
