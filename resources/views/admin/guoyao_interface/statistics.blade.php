@extends('../../admin')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">国药日期统计</h3>

                    {{--<div class="box-tools">--}}
                        {{--<div class="input-group input-group-sm" style="width: 150px;">--}}
                            {{--<input type="text" name="search_createtime" class="form-control pull-right" placeholder="Search">--}}

                            {{--<div class="input-group-btn">--}}
                                {{--<button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                <th>日期</th>
                                <th>总单量</th>
                                <th>新增订单</th>
                                <th>待出库</th>
                                <th>已出库</th>
                                <th>配送中</th>
                                <th>已签收</th>
                                <th>退货</th>
                                <th>取消</th>
                                <th>异常</th>
                            </tr>
                            <tr>
                                <td><?php echo $data['daily'];?></td>
                                <td><?php echo $data['dailyOrderNumber'];?></td>
                                <td><?php echo isset($data['status_info'][1]) ? $data['status_info'][1] : 0;?></td>
                                <td><?php echo isset($data['status_info'][2]) ? $data['status_info'][2] : 0;?></td>
                                <td><?php echo isset($data['status_info'][3]) ? $data['status_info'][3] : 0;?></td>
                                <td><?php echo isset($data['status_info'][5]) ? $data['status_info'][5] : 0;?></td>
                                <td><?php echo isset($data['status_info'][6]) ? $data['status_info'][6] : 0;?></td>
                                <td><?php echo isset($data['status_info'][10]) ? $data['status_info'][10] : 0;?></td>
                                <td><?php echo $data['canceled'];?></td>
                                <td><?php echo $data['abnormal'];?></td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="table table-hover" style="border-top: 3px solid #d2d6de;">
                        <tbody>
                        <tr>
                            <th>订单id</th>
                            <th>订单状态</th>
                            <th>是否取消</th>
                            <th>是否异常</th>
                            <th>创建时间</th>
                        </tr>
                        <?php foreach ($orderList as $v):
                            if ($v['status'] == 1) {
                                $v['status_name'] = '新增订单';
                            } elseif ($v['status'] == 2) {
                                $v['status_name'] = '待出库';
                            } elseif ($v['status'] == 3) {
                                $v['status_name'] = '已出库';
                            } elseif ($v['status'] == 5) {
                                $v['status_name'] = '配送中';
                            } elseif ($v['status'] == 6) {
                                $v['status_name'] = '已签收';
                            } elseif ($v['status'] == 10) {
                                $v['status_name'] = '退货';
                            }
                        ?>
                        <tr>
                            <td><?php echo $v['id'];?></td>
                            <td><?php echo $v['status_name'];?></td>
                            <td><?php echo $v['canceled'] == 1 ? '是' : '否';?></td>
                            <td><?php echo $v['abnormal_status'] == 1 ? '是' : '否';?></td>
                            <td><?php echo $v['createtime'];?></td>
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