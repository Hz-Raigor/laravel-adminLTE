<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Services\OrderService;
use App\Http\Services\CustomerService;
use App\Http\Services\SiteService;
use App\Http\Services\UserService;

class OrderController extends BaseController
{
    public $customerService;
    public $siteService;
    public $userService;
    public $perPage = 10;

    /**
     * 指定从 CSRF 验证中排除的URL
     *
     * @var array
     */
//    protected $except = [
//        '*'
//    ];
    public function __construct(OrderService $orderService,
                                CustomerService $customerService,
                                SiteService $siteService,
                                UserService $userService)
    {
        $this->service = $orderService;
        $this->customerService = $customerService;
        $this->siteService = $siteService;
        $this->userService = $userService;
    }

    public function index(Request $request)
    {
        $input = $request->input();
        $data = [];
        //必有参数
        $data['per_page'] = isset($input['per_page']) && $input['per_page'] ? $input['per_page'] : $this->perPage;
        $data['where']['canceled'] = isset($input['canceled']) && $input['canceled'] ? 1 : 0;
        $data['where']['count_number'] = isset($input['merge']) && $input['merge'] ? 0 : 1;
        //可选参数
        isset($input['status_rush']) && $input['status_rush'] ? $data['where']['status_rush'] = 1 : 0;
        isset($input['orderid']) && $input['orderid'] ? $data['where']['orderid'] = trim($input['orderid']) : '';  //订单号
        isset($input['batch']) && $input['batch'] ? $data['where']['batch'] = trim($input['batch']) : ''; //批次
        isset($input['source_type']) && $input['source_type'] ? $data['where']['source_type'] = $input['source_type'] : 0; //来源
        //like查询
        isset($input['end_city']) && $input['end_city'] ? $endCity = trim($input['end_city']) : ''; //配送区域
        if (isset($endCity)) {
            $data['where'][] = ['end_city','like','%'.$endCity.'%'];
        }
        //综合like查询
        isset($input['end_info']) && $input['end_info'] ? $endInfo = $input['end_info'] : ''; //收货人信息，end_address，end_contact，end_phone
        if (isset($endInfo)) {
            $data['or_where'] = [
                ['end_contact','like','%'.$endInfo.'%'],
                ['end_phone','like','%'.$endInfo.'%'],
                ['end_address','like','%'.$endInfo.'%']
            ];
        }
        //联表查询参数
        $customerName = isset($input['customer_name']) && $input['customer_name'] ? trim($input['customer_name']) : ''; //发货单位
        if ($customerName) {
            $where = [
                'where' => [
                    ['realname','like','%'.$customerName.'%']
                ]
            ];
            $customerList = $this->customerService->getListByCondition($where)->toArray();
            $uids = array_map('reset', $customerList);
            $data['where_in']['custom_id'] = $uids;
        }
        $endSiteName = isset($input['end_site_name']) && $input['end_site_name'] ? trim($input['end_site_name']) : '';
        if ($endSiteName) {
            $where = [
                'where' => [
                    ['name','like','%'.$endSiteName.'%']
                ]
            ];
            $siteList = $this->siteService->getListByCondition($where)->toArray();
            $sids = array_map('reset', $siteList); //以id重组array
            $data['where_in']['end_site_id'] = $sids;
        }
        //干线司机
        $driverSoringName = isset($input['driver_sorting']) && $input['driver_sorting'] ? trim($input['driver_sorting']) : '';
        if ($driverSoringName) {
            $where = [
                'where' => [
                    ['realname','like','%'.$driverSoringName.'%']
                ]
            ];
            $userList = $this->userService->getListByCondition($where)->toArray();
            $uids = array_map('reset', $userList); //以id重组array
            $data['where_in']['driver_id_sorting'] = $uids;
        }
        //配送司机
        $driverAllocateName = isset($input['driver_allocate']) && $input['driver_allocate'] ? trim($input['driver_allocate']) : '';
        if ($driverAllocateName) {
            $where = [
                'where' => [
                    ['realname','like','%'.$driverAllocateName.'%']
                ]
            ];
            $userList = $this->userService->getListByCondition($where)->toArray();
            $uids = array_map('reset', $userList); //以id重组array
            $data['where_in']['driver_id_allocate'] = $uids;
        }
        $list = $this->service->getListByCondition($data);
        return view('admin/order/index')->with([
            'data' => $list
        ]);
    }

    public function add()
    {
//        $input = $request->input();
//        $data = [];
//        $data['where']['customer_id'] = isset($input['customer_id']) && $input['customer_id'] ? 1 : 0;
//        if ($input) {
//            //创建
//            var_dump($data);die;
//        } else {
            //页面渲染
            $customerList =  $this->customerService->getListByCondition(['where' => ['type' => 1]]); //项目客户
            $newCustomerList = [];
            foreach ($customerList as $customer) {
                $customer->customerWarehouse;
                $newCustomerList[$customer->id] = $customer->toArray();
            }
            //运用网点
            $siteList = $this->siteService->getListByCondition([]);
//            var_dump($newCustomerList);die;
            return view('admin/order/store',[
                'customerList' => $newCustomerList,
                'siteList' => $siteList
            ]);
//        }
    }

    public function store(Request $request)
    {
        $input = $request->input();
        $data = [];
        isset($input['barcode']) && $input['barcode'] ? $data['barcode'] = trim($input['barcode']) : $this->_out(array('code' => '0001','message' => '缺少条码单号'));
        isset($input['batch']) && $input['batch'] ? $data['batch'] = trim($input['batch']) : $this->_out(array('code' => '0001','message' => '缺少批次号'));
        isset($input['send_date']) && $input['send_date'] ? $data['senddate'] = $input['send_date'] : $this->_out(array('code' => '0001','message' => '缺少承运日期'));
        isset($input['customer_id']) && $input['customer_id'] ? $data['customer_id'] = $input['customer_id'] : $this->_out(array('code' => '0001','message' => '缺少发货客户'));
        isset($input['city']) && $input['city'] ? $data['city'] = $input['city'] : $this->_out(array('code' => '0001','message' => '缺少发货区域'));
        isset($input['start_address']) && $input['start_address'] ? $data['start_address'] = $input['start_address'] : $this->_out(array('code' => '0001','message' => '缺少发货地址'));
        isset($input['start_contact']) && $input['start_contact'] ? $data['start_contact'] = $input['start_contact'] : $this->_out(array('code' => '0001','message' => '缺少发货联系人'));
        $data['start_phone'] = isset($input['start_phone']) && $input['start_phone'] ? $input['start_phone'] : ''; //缺少发货联系电话
        isset($input['end_site_id']) && $input['end_site_id'] ? $data['end_site_id'] = $input['end_site_id'] : $this->_out(array('code' => '0001','message' => '缺少收货网点'));
        isset($input['server_mode']) && $input['server_mode'] ? $data['server_mode'] = $input['server_mode'] : $this->_out(array('code' => '0001','message' => '缺少服务方式'));
        $data['end_company'] = isset($input['end_company']) && $input['end_company'] ? $input['end_company'] : '';  //缺少收货单位
        isset($input['end_contact']) && $input['end_contact'] ? $data['end_contact'] = $input['end_contact'] : $this->_out(array('code' => '0001','message' => '缺少收货人'));
        isset($input['end_phone']) && $input['end_phone'] ? $data['end_phone'] = $input['end_phone'] : $this->_out(array('code' => '0001','message' => '缺少收货电话'));
        isset($input['end_city']) && $input['end_city'] ? $data['end_city'] = $input['end_city'] : $this->_out(array('code' => '0001','message' => '缺少收货区域'));
        isset($input['end_address']) && $input['end_address'] ? $data['end_address'] = $input['end_address'] : $this->_out(array('code' => '0001','message' => '缺少收货地址'));
        //goods信息
        isset($input['goods_name']) && $input['goods_name'] ? $data['goods']['goods_name'] = $input['goods_name'] : $this->_out(array('code' => '0001','message' => '缺少货物名称'));
        isset($input['goods_paging']) && $input['goods_paging'] ? $data['goods']['goods_paging'] = $input['goods_paging'] : $this->_out(array('code' => '0001','message' => '缺少包装'));
        isset($input['goods_number']) && $input['goods_number'] ? $data['goods']['goods_number'] = $input['goods_number'] : $this->_out(array('code' => '0001','message' => '缺少件数'));
        isset($input['goods_weight']) && $input['goods_weight'] ? $data['goods']['goods_weight'] = $input['goods_weight'] : $this->_out(array('code' => '0001','message' => '缺少重量'));
        isset($input['goods_volume']) && $input['goods_volume'] ? $data['goods']['goods_volume'] = $input['goods_volume'] : $this->_out(array('code' => '0001','message' => '缺少体积'));

        isset($input['price_mode']) && $input['price_mode'] ? $data['price_mode'] = $input['price_mode'] : $this->_out(array('code' => '0001','message' => '缺少计价方式'));
        isset($input['price_single']) && $input['price_single'] ? $data['price_single'] = $input['price_single'] : $this->_out(array('code' => '0001','message' => '缺少单价'));
        $data['price_waybill'] = isset($input['price_waybill']) && $input['price_waybill'] ? $input['price_waybill'] : 0; //运费
        $data['price_get'] = isset($input['price_get']) && $input['price_get'] ? $input['price_get'] : 0; //提货费
        $data['price_send'] = isset($input['price_send']) && $input['price_send'] ? $input['price_send'] : 0; //送货费
        $data['price_add'] = isset($input['price_add']) && $input['price_add'] ? $input['price_add'] : 0; //附加费
        $data['price_other'] = isset($input['price_other']) && $input['price_other'] ? $input['price_other'] : 0; //其他费
        $data['price_all'] = isset($input['price_all']) && $input['price_all'] ? $input['price_all'] : 0; //费用合计
        $data['payment'] = isset($input['payment']) && $input['payment'] ? $input['payment'] : 0; //代收货款
        isset($input['price_end']) && $input['price_end'] ? $data['price_end'] = $input['price_end'] : $this->_out(array('code' => '0001','message' => '缺少结算方式'));
        $data['remark'] = isset($input['remark']) && $input['remark'] ? $input['remark'] : ''; //备注

        $id = $this->service->create($data);
        var_dump($id);die;

     }
}
