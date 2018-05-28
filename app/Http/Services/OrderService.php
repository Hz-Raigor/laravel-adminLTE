<?php

namespace App\Http\Services;

use App\Http\Repositories\OrderRepository;
use Illuminate\Support\Facades\DB;
use App\Exceptions\CustomException;

class OrderService extends BaseService
{

    public function __construct(OrderRepository $orderRepository)
    {
        //parent::__construct();
        $this->repository = $orderRepository;
    }

    public function getListByCondition($input)
    {
        $input['DESC'] = 'updatetime';
        $data = $this->repository->getListByCondition($input);
        return $data;
    }

    public function create($data)
    {
        DB::beginTransaction();
        try{
            $id = $this->repository->create($data);

            DB::commit();
            return $id;
        } catch(\Exception $e) {
            DB::rollBack();
            return 0;
        }
    }
}
