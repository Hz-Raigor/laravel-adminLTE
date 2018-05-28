<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class BaseController extends Controller
{
    public $service;

    /**
     * @todo 输出函数
     */
    protected function _out($out)
    {
        if(!is_array($out)){
            $out = array('code' => $out);
        }
        if(!isset($out['message']) || trim($out['message']) === ''){
            $out['message'] = '';
        }
        echo json_encode($out);die;
    }
}
