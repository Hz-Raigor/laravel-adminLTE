@extends('../../admin')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">国药月统计</h3>

                    <div class="box-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <form action="/admin/guoyao/statistics">
                                <input type="text" name="search_createtime" class="form-control pull-right" placeholder="Search">

                                <div class="input-group-btn">
                                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                <th>近一月日期</th>
                                <th>单量</th>
                            </tr>
                            <?php foreach ($data as $value):?>
                            <tr>
                                <td><a href="/admin/guoyao/statistics?search_createtime=<?php echo $value->daily;?>"><?php echo $value->daily;?></a></td>
                                <td><?php echo $value->dailyOrderNumber;?></td>
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