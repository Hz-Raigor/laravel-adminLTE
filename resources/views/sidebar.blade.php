 <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">

        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">

            <!-- Sidebar user panel (optional) -->
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="{{ asset ("/bower_components/admin-lte/dist/img/user2-160x160.jpg") }}" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p>Alexander Pierce</p>
                    <!-- Status -->
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>

            <!-- search form (Optional) -->
            <form action="#" method="get" class="sidebar-form">
                <div class="input-group">
                    <input type="text" name="q" class="form-control" placeholder="Search...">
                    <span class="input-group-btn">
              <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
              </button>
            </span>
                </div>
            </form>
            <!-- /.search form -->

            <!-- Sidebar Menu -->
            <ul class="sidebar-menu" data-widget="tree">
                <li class="header">HEADER</li>
                <!-- Optionally, you can add icons to the links -->
                {{--<li class="active"><a href="/admin/order"><i class="fa fa-link"></i> <span>Link</span></a></li>--}}
                {{--<li><a href="#"><i class="fa fa-link"></i> <span>Another Link</span></a></li>--}}
                <li class="treeview">
                    <a href="#"><i class="fa fa-link"></i> <span>运单管理</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="/admin/order">运单管理</a></li>
                        <li><a href="/admin/orderBatch">批次管理</a></li>
                    </ul>
                </li>
                <li><a href="/admin/guoyao"><i class="fa fa-book"></i> <span>国药统计</span></a></li>
                {{--<li class="treeview">--}}
                    {{--<a href="#"><i class="fa fa-link"></i> <span>Multilevel</span>--}}
                        {{--<span class="pull-right-container">--}}
                            {{--<i class="fa fa-angle-left pull-right"></i>--}}
                        {{--</span>--}}
                    {{--</a>--}}
                    {{--<ul class="treeview-menu">--}}
                        {{--<li><a href="/admin/order">Link in level 2</a></li>--}}
                        {{--<li><a href="#">Link in level 2</a></li>--}}
                    {{--</ul>--}}
                {{--</li>--}}
            </ul>
            <!-- /.sidebar-menu -->
        </section>
        <!-- /.sidebar -->
    </aside>