<?php

namespace App\Http\Models;

use Illuminate\Support\Facades\DB;
//use App\Models\BaseModel;

class GuoyaoInterface extends BaseModel
{
    protected $table = 'guoyao_interface';
//    protected $fillable = ['id','province_id','name'];  //可被批量赋值的字段
//    protected $connection = 'system_hub';
//
//    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

    public function index($where)
    {
        $query = "SELECT date_format(`createtime`,'%Y-%m-%d') AS daily,count(distinct order_id) AS dailyOrderNumber FROM `tb_guoyao_interface` WHERE {$where} GROUP BY date_format(`createtime`,'%Y-%m-%d') ORDER BY date_format(`createtime`,'%Y%m%d') DESC";
        $res = DB::select($query);
        return $res;
    }

    public function statistics($where)
    {
        DB::connection()->enableQueryLog(); // 开启查询日志
        $res = DB::table($this->table)->select('order_id')->where($where)->groupBy('order_id');
        print_r(DB::getQueryLog());die;
        return $res;
        $query = "SELECT date_format(`createtime`,'%Y-%m-%d') AS daily,count(distinct order_id) AS dailyOrderNumber FROM `tb_guoyao_interface` WHERE {$where} GROUP BY date_format(`createtime`,'%Y-%m-%d') ORDER BY date_format(`createtime`,'%Y%m%d') DESC";
        $res = DB::select($query);
        return $res;
    }
}
