<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Services\OrderBatchService;
use App\Http\Services\OrderService;

class OrderBatchController extends BaseController
{
    public $orderService;
    public $page = 10;
    public function __construct(OrderService $orderService,
                                OrderBatchService $orderBatchService)
    {
        $this->service = $orderBatchService;
        $this->orderService = $orderService;
    }

    public function index(Request $request)
    {
        $input = $request->input();
        $data = [];
        //必有参数
        $data['page'] = isset($input['page']) && $input['page'] ? $input['page'] : $this->page;
        $list = $this->service->getListByCondition($data);
        foreach ($list as &$value) {
            $value->total_number = $this->orderService->countByCondition(array('batch' => $value->batch));
            $value->unmatched_number = $this->orderService->countByCondition(array('batch' => $value->batch, 'end_site_id' => 0));
            $value->matched_number = $value['total_number'] - $value['unmatched_number'];
            $value->lng_lat_unchanged = $this->orderService->countByCondition(array('batch' => $value->batch, 'lng' => 0));
            $value->lng_lat_changed = $value['total_number'] - $value['lng_lat_unchanged'];
        }
        return view('admin/order-batch/index')->with([
            'data' => $list
        ]);
    }
}
