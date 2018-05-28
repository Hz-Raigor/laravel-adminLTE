<?php

namespace App\Http\Repositories;

use Illuminate\Support\Facades\DB;

class BaseRepository
{
    public $model;

    public function getListByCondition($input)
    {
//        DB::connection()->enableQueryLog(); // 开启查询日志
        $model = $this->model;
        if (isset($input['fields'])) {
            $model = $model->selectRaw($input['fields']);
        }
        if (isset($input['where']) && isset($input['or_where'])) {
            //构建查询构造器解决多条件问题
            $model = $model->where(function ($query) use($input) {
                //$query->where($input['where'])->orWhere($input['or_where']);
                foreach ($input['or_where'] as $orKey => $orValue) {
                        $query->orWhere([$orValue]);
                }
                $query->where($input['where']);
            });
        } else {
            if (isset($input['where'])) {
                $model = $model->where($input['where']);
            }
            if (isset($input['or_where'])) {
                $model = $model->orWhere($input['or_where']);
            }
        }
        if (isset($input['where_in'])) {
//            $keys = array_keys($input['where_in']);
//            foreach ($keys as $key) {
//                $model = $model->whereIn($key,$input['where_in'][$key]);
//            }
            foreach ($input['where_in'] as $inKey => $inValue) {
                $model = $model->whereIn($inKey,$inValue);
            }
        }
        if (isset($input['group'])) {
            $model = $model->groupBy($input['group']);
        }
        if (isset($input['DESC'])) {
            $model = $model->orderByDesc($input['DESC']);
        }
        if (isset($input['per_page'])) {
            $data = $model->paginate($input['per_page']);
        } else {
            $data = $model->get();
        }
//        if (isset($input['where_in'])) {
//            $queries = DB::getQueryLog();
//            var_dump($queries);
//            die;
//
//        }
        return $data;
    }

    public function countByCondition($input)
    {
        $model = $this->model;
        if (isset($input['where'])) {
            $model = $model->where($input['where']);
        }
        if (isset($input['where_in'])) {
            $model = $model->whereIn($input['where_in']['key'],$input['where_in']['value']);
        }
        if (isset($input['group'])) {
            $model = $model->groupBy($input['group']);
        }
        $data = $model->count();
        return $data;
    }

    public function create($data)
    {

    }
}
