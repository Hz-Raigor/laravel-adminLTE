<?php
use Illuminate\Http\Request;
?>
@extends('../../admin')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <div class="ibox-title">
                        <h5>搜索条件</h5>
                    </div>
                    <div class="ibox-content" style="padding-bottom:0;">
                        <form method="get" class="clearfix">
                            <div class="col-sm-5 col-md-5 col-lg-12">
                                <div class="form-group col-sm-12 col-md-12 col-lg-2">
                                    <label class="font-normal">订单号</label>
                                    <input type="text" class="form-control" name="orderid" value="<?php echo Request::capture()->orderid; ?>" />
                                </div>
                                <div class="form-group col-sm-12 col-md-12 col-lg-2">
                                    <label class="font-normal">条码号</label>
                                    <input type="text" class="form-control" name="barcode" value="<?php echo Request::capture()->barcode; ?>" />
                                </div>
                                <div class="form-group col-sm-12 col-md-12 col-lg-2">
                                    <label class="font-normal">批次</label>
                                    <input type="text" class="form-control" name="batch" value="<?php echo Request::capture()->batch; ?>" />
                                </div>
                                <div class="form-group col-sm-12 col-md-12 col-lg-1">
                                    <label class="font-normal">发货单位</label>
                                    <input type="text" class="form-control" name="customer_name" value="<?php echo Request::capture()->customer_name; ?>" />
                                </div>
                                <div class="form-group col-sm-12 col-md-12 col-lg-1">
                                    <label class="font-normal">理货网点</label>
                                    <input type="text" class="form-control" name="end_site_name" value="<?php echo Request::capture()->end_site_name; ?>" />
                                </div>
                                <div class="form-group col-sm-12 col-md-12 col-lg-1">
                                    <label class="font-normal">收货信息</label>
                                    <input type="text" class="form-control" name="end_info" value="<?php echo Request::capture()->end_info; ?>" />
                                </div>
                                <div class="form-group col-sm-12 col-md-12 col-lg-1">
                                    <label class="font-normal">配送区域</label>
                                    <input type="text" class="form-control" name="end_city" value="<?php echo Request::capture()->end_city; ?>" />
                                </div>
                                <div class="form-group col-sm-12 col-md-12 col-lg-1">
                                    <label class="font-normal">干线司机</label>
                                    <input type="text" class="form-control" name="driver_sorting" value="<?php echo Request::capture()->driver_sorting; ?>" />
                                </div>
                                <div class="form-group col-sm-12 col-md-12 col-lg-1">
                                    <label class="font-normal">配送司机</label>
                                    <input type="text" class="form-control" name="driver_allocate" value="<?php echo Request::capture()->driver_allocate; ?>" />
                                </div>
                            </div>
                            <div class="col-sm-4 col-md-4 col-lg-4">
                                <div class="form-group col-sm-12 col-md-12 col-lg-3">
                                    <label class="font-normal">撤销</label>
                                    <select class="form-control" name="canceled">
                                        <option value="0" <?php echo Request::capture()->canceled == 0 ? ' selected' : ''; ?>>否</option>
                                        <option value="1" <?php echo Request::capture()->canceled == 1 ? ' selected' : ''; ?>>是</option>
                                    </select>
                                </div>
                                <div class="form-group col-sm-12 col-md-12 col-lg-3">
                                    <label class="font-normal">加急</label>
                                    <select class="form-control" name="rush">
                                        <option value="0" <?php echo Request::capture()->rush == 0 ? ' selected' : ''; ?>>否</option>
                                        <option value="1" <?php echo Request::capture()->rush == 1 ? ' selected' : ''; ?>>是</option>
                                    </select>
                                </div>
                                <div class="form-group col-sm-12 col-md-12 col-lg-3">
                                    <label class="font-normal">合单</label>
                                    <select class="form-control" name="merge">
                                        <option value="0" <?php echo Request::capture()->merge == 0 ? ' selected' : ''; ?>>否</option>
                                        <option value="1" <?php echo Request::capture()->merge == 1 ? ' selected' : ''; ?>>是</option>
                                    </select>
                                </div>
                                <div class="form-group col-sm-12 col-md-12 col-lg-3">
                                    <label class="font-normal">来源</label>
                                    <select class="form-control" name="source_type">
                                        <option value="0">全部</option>
                                        <option value="1" <?php echo Request::capture()->source_type == 1 ? ' selected' : ''; ?>>直接入单</option>
                                        <option value="2" <?php echo Request::capture()->source_type == 2 ? ' selected' : ''; ?>>运单导入</option>
                                        <option value="3" <?php echo Request::capture()->source_type == 3 ? ' selected' : ''; ?>>系统对接</option>
                                        <option value="4" <?php echo Request::capture()->source_type == 4 ? ' selected' : ''; ?>>微信下单</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4 col-md-4 col-lg-6">
                                <div class="form-group col-sm-8">
                                    <label class="font-normal">下单时间</label>
                                    <div class="clearfix">
                                        <input type="text" placeholder="开始时间" class="form-control layer-date" id="start" name="start_time" value="" style="width:48%;display:inline-block;" />
                                        -
                                        <input type="text" placeholder="结束时间" class="form-control layer-date" id="end" name="end_time" value="" style="width:48%;display:inline-block;" />
                                    </div>
                                </div>
                                <div class="form-group col-sm-3 col-md-3 col-lg-2">
                                    <label class="font-normal">&nbsp;</label>
                                    <div class="clearfix">
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> 搜索</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.box-header -->
            </div>
            <div class="box">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="ibox-title">
                            <h5 style="padding-top:7px; ">订单列表</h5>
                            <a href="./order/add" class="btn btn-primary btn-first float-right" style="margin-top: -6px;"><i class="fa fa-plus-square margin-right-5"></i>添加</a>
                        </div>
                        <div class="ibox float-e-margins">
                            <div class="ibox-content">
                                <div style="height:40px;" class="operator-button">
                                    <button class="btn btn-success btn-sm upBrand ajax-request" data-url="'order/up-status" data-param="getIds()" method-type="post" data-confirm="确定要批量发布广告吗？" success-tip="操作成功" disabled="disabled"><i class="fa fa-arrow-circle-up"></i> 批量发布</button>
                                    <button class="btn btn-info btn-sm downBrand ajax-request" data-url="banner/down-status" data-param="getIds()" method-type="post" data-confirm="确定要取消发布广告吗？" success-tip="操作成功" disabled="disabled"><i class="fa fa-arrow-circle-down"></i> 批量取消</button>
                                    <div class="btn-group">
                                        <button class="btn btn-sm btn-warning btns-del dropdown-toggle" data-toggle="dropdown" disabled="disabled">其他操作<span class="caret"></span></button>
                                        <ul class="dropdown-menu" aria-labelledby="dLabel">
                                            <!--<li class="divider"></li>-->
                                            <li><a href="javascript:void(0)" style="color: red" class="ajax-request" data-url="./banner/delete" data-param="getIds()" data-confirm="确定要批量删除广告吗？" success-tip="操作成功!" method-type="post" disabled="disabled"><i class="fa fa-close margin-right-5 red"></i>批量删除</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="box-body table-responsive no-padding">
                                    <table class="table table-hover">
                                        <tbody>
                                        <tr>
                                            <th>id</th>
                                            <th>运单号</th>
                                            <th>发货单位</th>
                                            <th>批次号</th>
                                            <th>收货地址</th>
                                            <th>创建时间</th>
                                            <th>修改时间</th>
                                        </tr>
                                        <?php foreach ($data as $value):?>
                                        <tr>
                                            <td><?php echo $value->id;?></td>
                                            <td><?php echo $value->orderid;?></td>
                                            <td><?php echo $value->customer->realname;?></td>
                                            <td><?php echo $value->batch;?></td>
                                            <td><?php echo $value->end_address;?></td>
                                            <td><?php echo $value->createtime;?></td>
                                            <td><?php echo $value->updatetime;?></td>
                                        </tr>
                                        <?php endforeach;?>
                                        </tbody>
                                    </table>
                                    {!! $data->links() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
    <script>
        $(function () {
            laydate.render({
                elem: '#start' //指定元素
                ,calendar: true
                ,type: 'datetime'
            });
            laydate.render({
                elem: '#end' //指定元素
                ,calendar: true
                ,type: 'datetime'
            });
        });
    </script>
@endsection