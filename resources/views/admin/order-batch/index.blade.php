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
                        <h5>订单列表</h5>
                    </div>
                </div>
                <!-- /.box-header -->
            </div>
            <div class="box">
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tbody>
                        <tr>
                            <th width="2%">id</th>
                            <th width="10%">客户名称</th>
                            <th width="10%">批次</th>
                            <th width="8%">订单数量</th>
                            <th width="8%">未匹配站点数</th>
                            <th width="8%">未转化经纬度数</th>
                            <th width="12%">创建时间</th>
                            <th width="5%">状态</th>
                            <th width="35%">操作</th>
                        </tr>
                        <?php foreach ($data as $value):?>
                        <tr>
                            <td><?php echo $value->id;?></td>
                            <td><?php echo $value->real_name;?></td>
                            <td><?php echo $value->batch;?></td>
                            <td><?php echo $value->total_number;?></td>
                            <td><?php echo $value->unmatched_number;?></td>
                            <td><?php echo $value->lng_lat_unchanged;?></td>
                            <td><?php echo $value->createtime;?></td>
                            <td><?php echo $value->unmatched_number > 0 || $value->lng_lat_unchanged > 0 ? '待操作' : '已完成';?></td>
                            <td>
                                <button onclick="changeToLatLng('<?php echo $value->batch;?>')" style="margin-left: 20px;float: left;">经纬度转化(每次转化300条)</button>
                                <a href="./order/list&transformFailed=1&batch=<?php echo $value->batch;?>" target="navTab" rel="main1" style="display: block;float: left;width: 90px;margin-left: 10px;">地址不标准的订单</a>
                                <?php if ($value->cid != 1):?>
                                <button onclick="matchSite('<?php echo $value->batch;?>')" style="margin-left: 10px;float: left;">匹配运营网点</button>
                                <?php endif;?>
                            </td>
                        </tr>
                        <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
@endsection