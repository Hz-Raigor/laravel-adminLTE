<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\GuoyaoInterfaceService;
use App\Http\Services\OrderService;

class GuoyaoInterfaceController extends Controller
{
    public $guoyaoInterfaceService;
    public $orderService;
    public function __construct(GuoyaoInterfaceService $guoyaoInterfaceService,OrderService $orderService)
    {
        //parent::__construct();
        $this->guoyaoInterfaceService = $guoyaoInterfaceService;
        $this->orderService = $orderService;
    }

    public function index()
    {
        $data = $this->guoyaoInterfaceService->index();
        return view('admin/guoyao_interface/index',['data' => $data]);
    }

    /**
     * @todo 国药统计详情
     */
    public function statistics(Request $request)
    {
        $time = $request->has('search_createtime') ? $request->get('search_createtime') : '';
        if (!$time) {
            die('缺少search_createtime参数');
        }
        $data = [
            'daily' => $time
        ];
        $arrIds = $this->guoyaoInterfaceService->statistics($time);
        $orderList = [];
        $data['dailyOrderNumber'] = count($arrIds);
        if ($data['dailyOrderNumber']) {
            $arrIds = array_map('reset',$arrIds);
            $order = $this->orderService->getListByCondition([
                'fields' => "status,count(*) AS statusNumber",
                'where_in' => $arrIds,
                'group' => 'status'
            ]);
            $data['canceled'] = $this->orderService->countByCondition([
                                'where_in' => $arrIds,
                                'where' => ['canceled' => 1]
                            ]);
            $data['abnormal'] = $this->orderService->countByCondition([
                'where_in' => $arrIds,
                'where' => [['abnormal_status', '=', 1],['status', '!=', 6]]
            ]);
            foreach ($order as $orderInfo) {
                $data['status_info'][$orderInfo['status']] = $orderInfo['statusNumber'];
            }
            $orderList = $this->orderService->getListByCondition([
                'fields' => 'id,status,createtime,canceled,abnormal_status',
                'where_in' => $arrIds,
                'where' => ['canceled' => 1],
                'or_where' => [['abnormal_status', '=', 1],['status', '!=', 6]]
            ]);
        }

        return view('admin/guoyao_interface/statistics',[
                'data' => $data,
                'orderList' => $orderList
            ]);
    }
}
