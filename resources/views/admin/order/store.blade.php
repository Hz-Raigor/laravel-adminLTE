<?php
use Illuminate\Http\Request;
?>
@extends('../../admin')

@section('content')
    <div class="wrapper-content animated fadeInUp">
        <div class="row">
            <div class="col-sm-12">
                <form class="form-horizontal min-width-1200 validate-form" method="post" action="/admin/order/store" success-tip="保存成功" call-back="update()">
                    {{ csrf_field() }}
                    <div class="tabs-container">
                        <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#info" aria-expanded="true">基本信息</a></li>
                            {{--<li><a data-toggle="tab" href="#content" aria-expanded="false">图文详情</a></li>--}}
                            {{--<li><a data-toggle="tab" href="#other" aria-expanded="false">其他参数</a></li>--}}
                            {{--<li><a data-toggle="tab" href="#classify" aria-expanded="false">商品分类</a></li>--}}
                            {{--<li><a data-toggle="tab" href="#recommend" aria-expanded="false">商品推荐</a></li>--}}
                            <a href="/admin/order" class="btn btn-primary float-right"><i class="fa fa-mail-reply"></i> 返回列表</a>
                        </ul>
                        <div class="tab-content">
                            <div id="info" class="tab-pane active">
                                <div class="panel-body">
                                    <div class="form-group">
                                        <label class="col-sm-1 col-md-3 control-label">条码单号</label>
                                        <div class="col-sm-8 col-md-1 col-lg-2">
                                            <input type="text" class="form-control validate-empty" name="barcode" value="" id="barcode"/>
                                            <span class="tip-validate text-danger" data-target="barcode" data-rule="empty"></span>
                                        </div>
                                        <label class="col-sm-1 col-md-1 control-label">批次号</label>
                                        <div class="col-sm-8 col-md-8 col-lg-2">
                                            <input type="text" class="form-control validate-empty" name="batch" value="" id="batch"/>
                                            <span class="tip-validate text-danger" data-target="batch" data-rule="empty"></span>
                                        </div>
                                        <label class="col-sm-2 col-md-1 control-label">承运日期</label>
                                        <div class="col-sm-8 col-md-8 col-lg-1">
                                            <input type="text" class="form-control" id="senddate" name="send_date" value=""/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 col-md-3 control-label">发货客户</label>
                                        <div class="col-sm-3 col-md-3 col-lg-1">
                                            <select class="form-control" name="customer_id">
                                                <?php foreach ($customerList as $key => $customer):?>
                                                <option value="<?php echo $customer['id'];?>" address="<?php echo $customer['address'] ? $customer['address'] : '';?>" warehouse="<?php echo isset($customer['customer_warehouse']) && $customer['customer_warehouse'] ? $customer['customer_warehouse']['name'] : '';?>" start_contact="<?php echo isset($customer['contact_name']) ? $customer['contact_name'] : '';?>" start_phone="<?php echo isset($customer['contact_phone']) ? $customer['contact_phone'] : '';?>" city="<?php echo isset($customer['city']) ? $customer['city'] : '';?>"><?php echo $customer['realname'];?></option>
                                                <?php endforeach;?>
                                            </select>
                                        </div>
                                        <label class="col-sm-1 col-md-1 control-label">发货区域</label>
                                        <div class="col-sm-3 col-md-3 col-lg-1">
                                            <input type="text" class="form-control" name="city" value="<?php echo isset($customerList[1]['city']) ? $customerList[1]['city'] : '';?>" readonly/>
                                        </div>
                                        <label class="col-sm-1 col-md-1 control-label">发货地址</label>
                                        <div class="col-sm-3 col-md-3 col-lg-2">
                                            <input type="text" class="form-control" name="start_address" value="<?php echo isset($customerList[1]['address']) ? $customerList[1]['address'] : '';?>" readonly/>
                                            <span class="tip-validate text-danger" data-target="start_address" data-rule="empty"></span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-1 col-md-3 control-label">发货仓库</label>
                                        <div class="col-sm-3 col-md-3 col-lg-1">
                                            <input type="text" class="form-control" name="warehouse" value="<?php echo isset($customerList[1]['customer_warehouse']) && $customerList[1]['customer_warehouse'] ? $customerList[1]['customer_warehouse']['name'] : '';?>" id="warehouse" readonly/>
                                            <span class="tip-validate text-danger" data-target="warehouse" data-rule="empty"></span>
                                        </div>
                                        <label class="col-sm-1 col-md-1 control-label">联系人</label>
                                        <div class="col-sm-3 col-md-3 col-lg-1">
                                            <input type="text" class="form-control" name="start_contact" value="<?php echo isset($customerList[1]['contact_name']) ? $customerList[1]['contact_name'] : '';?>" readonly/>
                                            <span class="tip-validate text-danger" data-target="start_contact" data-rule="empty"></span>
                                        </div>
                                        <label class="col-sm-1 col-md-1 control-label">联系电话</label>
                                        <div class="col-sm-3 col-md-3 col-lg-2">
                                            <input type="text" class="form-control" name="start_phone" value="<?php echo isset($customerList[1]['contact_phone']) ? $customerList[1]['contact_phone'] : '';?>" readonly/>
                                        </div>
                                    </div>
                                    <div class="hr-line-dashed"></div>
                                    <div class="form-group">
                                        <label class="col-sm-2 col-md-3 control-label">收货网点</label>
                                        <div class="col-sm-3 col-md-3 col-lg-3">
                                            <select id="first-disabled" name="end_site_id" class="form-control selectpicker" data-hide-disabled="true" data-live-search="true">
                                                <optgroup disabled="disabled" label="disabled">
                                                    <option>Hidden</option>
                                                </optgroup>
                                                <optgroup label="国药网点">
                                                    <?php foreach ($siteList as $site):?>
                                                    <option><?php echo $site->name;?></option>
                                                    <?php endforeach;?>
                                                </optgroup>
                                            </select>
                                        </div>
                                        <label class="col-sm-2 col-md-1 control-label">服务方式</label>
                                        <div class="col-sm-3 col-md-1 col-lg-1">
                                            <select class="form-control" name="server_mode">
                                                <option value="1">站到站</option>
                                                <option value="2">站到门</option>
                                                <option value="3">门到站</option>
                                                <option value="4">门到门</option>
                                            </select>
                                        </div>
                                        <label class="col-sm-1 col-md-1 control-label">收货单位</label>
                                        <div class="col-sm-3 col-md-3 col-lg-2">
                                            <input type="text" class="form-control" name="end_company" value="" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-1 col-md-3 control-label">收货人</label>
                                        <div class="col-sm-8 col-md-1 col-lg-1">
                                            <input type="text" class="form-control validate-empty" name="end_contact" value="" id="end_contact" />
                                            <span class="tip-validate text-danger" data-target="end_contact" data-rule="empty"></span>
                                        </div>
                                        <label class="col-sm-1 col-md-1 control-label">收货电话</label>
                                        <div class="col-sm-8 col-md-8 col-lg-1">
                                            <input type="text" class="form-control validate-empty" name="end_phone" value="" id="end_phone"/>
                                            <span class="tip-validate text-danger" data-target="end_phone" data-rule="empty"></span>
                                        </div>
                                        <label class="col-sm-2 col-md-1 control-label">收货区域</label>
                                        <div class="col-sm-8 col-md-8 col-lg-1">
                                            <input type="text" class="form-control" name="end_city" value="" id="end_city"/>
                                        </div>
                                        <label class="col-sm-2 col-md-1 control-label">收货地址</label>
                                        <div class="col-sm-8 col-md-8 col-lg-2">
                                            <input type="text" class="form-control" name="end_address" value="" id="end_address"/>
                                        </div>
                                    </div>

                                    <div class="hr-line-dashed"></div>
                                    <div class="form-group">
                                        <label class="col-sm-2 col-md-3 control-label">货物列表</label>
                                        <div class="col-sm-8 col-md-8 col-lg-6">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <td width="15%">货物名称</td>
                                                        <td width="12%">包装</td>
                                                        <td width="12%">件数</td>
                                                        <td width="12%">重量</td>
                                                        <td width="12%">体积</td>
                                                        <td width="10%">操作</td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <input type="text" name="goods_name[]" value="" class="form-control text-center input-name-change" size="2" /></td>
                                                        <td><input type="text" name="goods_paging[]" value="" class="form-control text-center input-name-change" size="2" /></td>
                                                        <td><input type="text" name="goods_number[]" value="" class="form-control text-center input-name-change" size="2" /></td>
                                                        <td><input type="text" name="goods_weight[]" value="" class="form-control text-center input-name-change" size="2" /></td>
                                                        <td><input type="text" name="goods_volume[]" value="" class="form-control text-center input-name-change" size="2" /></td>
                                                        <td class="text-center">
                                                            <button class="remove-property-item btn btn-sm btn-danger"><i class="fa fa-close"></i> 删除规格</button>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <p class="tip-validate text-danger" data-target="sku_name&sku_stock_number&sku_shop_price&sku_market_price&sku_cost_price" data-rule="empty"></p>
                                            <button type="button" name="copy-property-item" id="copy-property-item" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> 新增产品</button>
                                        </div>
                                    </div>
                                    <div class="hr-line-dashed"></div>
                                    <div class="form-group">
                                        <label class="col-sm-2 col-md-3 control-label">计价方式</label>
                                        <div class="col-sm-3 col-md-1 col-lg-1">
                                            <select class="form-control" name="price_mode">
                                                <option value="1">数量</option>
                                                <option value="2">重量</option>
                                                <option value="3">体积</option>
                                            </select>
                                        </div>
                                        <label class="col-sm-2 col-md-1 control-label">单价</label>
                                        <div class="col-sm-8 col-md-8 col-lg-1">
                                            <input type="text" class="form-control" name="price_single" value="" id="price_single"/>
                                        </div>
                                        <label class="col-sm-2 col-md-1 control-label">运费</label>
                                        <div class="col-sm-8 col-md-8 col-lg-1">
                                            <input type="text" class="form-control" name="price_waybill" value="" id="price_waybill"/>
                                        </div>
                                        <label class="col-sm-2 col-md-1 control-label">提货费</label>
                                        <div class="col-sm-8 col-md-8 col-lg-1">
                                            <input type="text" class="form-control" name="price_get" value="" id="price_get"/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 col-md-3 control-label">送货费</label>
                                        <div class="col-sm-8 col-md-8 col-lg-1">
                                            <input type="text" class="form-control" name="price_send" value="" id="price_send"/>
                                        </div>
                                        <label class="col-sm-2 col-md-1 control-label">附加费</label>
                                        <div class="col-sm-8 col-md-8 col-lg-1">
                                            <input type="text" class="form-control" name="price_add" value="" id="price_add"/>
                                        </div>
                                        <label class="col-sm-2 col-md-1 control-label">其他费</label>
                                        <div class="col-sm-8 col-md-8 col-lg-1">
                                            <input type="text" class="form-control" name="price_other" value="" id="price_other"/>
                                        </div>
                                        <label class="col-sm-2 col-md-1 control-label">费用合计</label>
                                        <div class="col-sm-8 col-md-8 col-lg-1">
                                            <input type="text" class="form-control" name="price_all" value="" id="price_all"/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 col-md-3 control-label">代收货款</label>
                                        <div class="col-sm-8 col-md-8 col-lg-1">
                                            <input type="text" class="form-control" name="payment" value="" id="payment"/>
                                        </div>
                                        <label class="col-sm-2 col-md-1 control-label">结算方式</label>
                                        <div class="col-sm-8 col-md-8 col-lg-1">
                                            <select class="form-control" name="price_end">
                                                <option value="1">现付</option>
                                                <option value="2">月付</option>
                                                <option value="3">到付</option>
                                            </select>
                                        </div>
                                        <label class="col-sm-2 col-md-1 control-label">	备注</label>
                                        <div class="col-sm-8 col-md-8 col-lg-1">
                                            <input type="text" class="form-control" name="remark" value="" id="remark"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <div class="col-sm-12 col-sm-offset-4">
                            <button class="btn btn-primary btn-lg" type="submit" style="width:130px;"><i class="fa fa-save"></i> 保存</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>

        $('select[name=customer_id]').change (function () {
            var address = $("select[name=customer_id] option:selected").attr("address");
            var warehouse = $("select[name=customer_id]").find("option:selected").attr("warehouse");
            var start_contact = $("select[name=customer_id]").find("option:selected").attr("start_contact");
            var start_phone = $("select[name=customer_id]").find("option:selected").attr("start_phone");
            var city = $("select[name=customer_id]").find("option:selected").attr("city");
            $('input[name=warehouse]').val(warehouse);
            $('input[name=start_address]').val(address);
            $('input[name=start_contact]').val(start_contact);
            $('input[name=start_phone]').val(start_phone);
            $('input[name=city]').val(city);
        });
        //第二种方式
        // function customer (obj) {
        //     // var address = (obj.options[obj.options.selectedIndex]).getAttribute('address');
        //     // var warehouse = (obj.options[obj.options.selectedIndex]).getAttribute('warehouse');
        //
        //     var address = $("select[name=customer_id] option:selected").attr("address");
        //     var warehouse = $("select[name=customer_id]").find("option:selected").attr("warehouse");
        //     console.log(address);
        //     console.log(warehouse);
        //     $('input[name=warehouse]').val(warehouse);
        //     $('input[name=start_address]').val(address);
        // }
        $(function () {
            laydate.render({
                elem: '#senddate' //指定元素
                ,calendar: true
                ,type: 'date'    //默认date，可不填
            });

        });

        //商品新增
        $(document).on('click','#copy-property-item',function(){
            var goods_input = $('.table-bordered').find('tbody').find('tr').last().find('.input-name-change');
            var obj_parent=$(this).siblings('table').find('tbody');
            var objText = '<tr class="goods">\
                        <td><input type="text" name="goods_name[]" value="'+goods_input[0].value+'" class="form-control text-center input-name-change" size="2"></td>\
                        <td><input type="text" name="goods_paging[]" value="'+goods_input[1].value+'" class="form-control text-center input-name-change" size="2"></td>\
                        <td><input type="text" name="goods_number[]" value="'+goods_input[2].value+'" class="form-control text-center input-name-change" size="2"></td>\
                        <td><input type="text" name="goods_weight[]" value="'+goods_input[3].value+'" class="form-control text-center input-name-change" size="2"></td>\
                        <td><input type="text" name="goods_volume[]" value="'+goods_input[4].value+'" class="form-control text-center input-name-change" size="2"></td>\
                        <td class="text-center">\
                            <button class="remove-property-item btn btn-sm btn-danger"><i class="fa fa-close"></i> 删除商品</button>\
                        </td>\
                    </tr>';
            //clone.find('.preview').html('+');
            //clone.find('.remove-img').remove();
            obj_parent.append(objText);

        });
        <!-- 阻止默认行为 -->
        function preventDefa(e){
            if(window.event){
                //IE中阻止函数器默认动作的方式
                window.event.returnValue = false;
            }
            else{
                //阻止默认浏览器动作(W3C)
                e.preventDefault();
            }
        }
        //商品删除
        $(document).on('click','.remove-property-item',function(){
            preventDefa();
            if ($(this).parent().parent().parent().find('tr').length<2){
                window.parent.$.flashToast({'message':'至少要保留一个规格！'});
                return false;
            }
            $(this).parent().parent().remove();
            return false;
        });
    </script>
    <!-- Bootstrap 下拉框搜索 -->
    <script src="{{ asset ("/js/bootstrap-select/dist/js/bootstrap-select.js") }}"></script>
    <script src="{{ asset ("/js/wuliu.js") }}"></script>
    <link rel="stylesheet" href="{{ asset ("/js/bootstrap-select/dist/css/bootstrap-select.css") }}">
@endsection