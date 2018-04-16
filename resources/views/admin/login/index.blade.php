<!DOCTYPE html>
<html>
<head>
    <title>系统登录</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="{{ asset ("/bower_components/bootstrap/dist/css/bootstrap.css") }}">
    <link rel="stylesheet" href="{{ asset ("/bower_components/font-awesome/css/font-awesome.css") }}">
    <link rel="stylesheet" href="{{ asset ("/bower_components/admin-lte/dist/css/AdminLTE.css") }}">
    <link rel="stylesheet" href="{{ asset ("/bower_components/admin-lte/plugins/iCheck/square/blue.css") }}">
    {{--<link rel="stylesheet" href="~/lib/iCheck/skins/square/blue.css">--}}
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <a href="" target="_blank"><b>Laravel By HZ</b></a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">权限管理系统</p>
        <form action="/Home/Index" method="post">
            <div class="form-group has-feedback">
                <input type="text" class="form-control" placeholder="用户名">
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" class="form-control" placeholder="密码">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-xs-8">
                    <div class="checkbox icheck">
                        <label>
                            <input type="checkbox"> 记住我
                        </label>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">登录</button>
                </div>
                <!-- /.col -->
            </div>
        </form>
    </div>
    <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
<script src="~/lib/jquery/dist/jquery.js"></script>
<script src="~/lib/bootstrap/dist/js/bootstrap.js"></script>
<script src="~/lib/iCheck/icheck.js"></script>
<script>
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });
    });
</script>
</body>
</html>