<?php

namespace App\Http\Repositories;

use Illuminate\Support\Facades\DB;

class BaseRepository
{
    public function getListByCondition($input)
    {
        $model = $this->model;
        if (isset($input['fields'])) {
            $model = $model->selectRaw($input['fields']);
        }
        if (isset($input['where_in'])) {
            $model = $model->whereIn('id',$input['where_in']);
        }
        if (isset($input['where']) && isset($input['or_where'])) {
            //构建查询构造器解决多条件问题
            $model = $model->where(function ($query) use($input) {
                $query->where($input['where'])->orWhere($input['or_where']);
            });
        } else {
            if (isset($input['where'])) {
                $model = $model->where($input['where']);
            }
            if (isset($input['or_where'])) {
                $model = $model->orWhere($input['or_where']);
            }
        }
        if (isset($input['group'])) {
            $model = $model->groupBy($input['group']);
        }
        $data = $model->get()->toArray();
        return $data;
    }

    public function countByCondition($input)
    {
        $model = $this->model;
        if (isset($input['where'])) {
            $model = $model->where($input['where']);
        }
        if (isset($input['where_in'])) {
            $model = $model->whereIn('id',$input['where_in']);
        }
        if (isset($input['group'])) {
            $model = $model->groupBy($input['group']);
        }
        $data = $model->count();
        return $data;
    }
}
