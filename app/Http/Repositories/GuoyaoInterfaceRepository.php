<?php

namespace App\Http\Repositories;

use App\Http\Models\GuoyaoInterface;
use Illuminate\Support\Facades\DB;

class GuoyaoInterfaceRepository extends BaseRepository
{

    public $guoyaoInterfaceModel;
    public function __construct(GuoyaoInterface $guoyaoInterfaceModel)
    {
        //parent::__construct();
        $this->guoyaoInterfaceModel = $guoyaoInterfaceModel;
        $this->model = $this->guoyaoInterfaceModel;
    }

    public function index($month)
    {
        $query = "SELECT date_format(`createtime`,'%Y-%m-%d') AS daily,count(distinct order_id) AS dailyOrderNumber FROM `tb_guoyao_interface` WHERE track_info = '运单已创建' AND type = '1.6' AND date_format(`createtime`,'%Y-%m-%d') >= ? GROUP BY date_format(`createtime`,'%Y-%m-%d') ORDER BY date_format(`createtime`,'%Y%m%d') DESC";
        $res = DB::select($query,[$month]);
        return $res;
    }

    public function statistics($time)
    {
        //DB::connection()->enableQueryLog(); // 开启查询日志
//        $res = DB::table($this->table)->select('order_id')->where($where)->groupBy('order_id');
//        print_r(DB::getQueryLog());die;
//        return $res;
        $query = "SELECT order_id FROM `tb_guoyao_interface` WHERE date_format(`createtime`,'%Y-%m-%d') = ? AND track_info = '运单已创建' AND type = '1.6' GROUP BY order_id";
        $res = DB::select($query,[$time]);
        $result = array_map(function ($value) {
            return (array)$value;
        }, $res);
        return $result;
    }
}
