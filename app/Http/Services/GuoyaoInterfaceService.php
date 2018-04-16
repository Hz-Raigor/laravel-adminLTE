<?php

namespace App\Http\Services;

use App\Http\Repositories\GuoyaoInterfaceRepository;

class GuoyaoInterfaceService extends BaseService
{

    public $guoyaoInterfaceRepository;
    public function __construct(GuoyaoInterfaceRepository $guoyaoInterfaceRepository)
    {
        //parent::__construct();
        $this->guoyaoInterfaceRepository = $guoyaoInterfaceRepository;
    }

    public function index()
    {
        $time = time();
        $today = date('Y-m-d',$time);
        $yesterday = date('Y-m-d',$time - 3600 * 24);
        $beforeYesterday = date('Y-m-d',$time - 3600 * 24 * 2);
        $recentDay = [
            'today' => $today,
            'yesterday' => $yesterday,
            'before_yesterday' => $beforeYesterday
        ];
        $month = date('Y-m-d',$time - 3600 * 24 * 30);
        $data = $this->guoyaoInterfaceRepository->index($month);
        return $data;
    }

    public function statistics($time)
    {
        $where = "date_format(`createtime`,'%Y-%m-%d') = "."'".$time."'";
        $where .= " AND track_info = '运单已创建' AND type = '1.6'";
        $data = $this->guoyaoInterfaceRepository->statistics($time);
        return $data;
    }
}
