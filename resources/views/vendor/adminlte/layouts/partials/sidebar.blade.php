<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">


        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
        {{--<li class="header">{{ trans('adminlte_lang::message.header') }}</li>--}}
        <!-- Optionally, you can add icons to the links -->
            <li class=""><a href="{{ url('admin') }}"><i class='fa fa-bar-chart-o '></i>
                    <span>{{ trans('adminlte_lang::message.dashboard') }}</span></a></li>

            <li class="treeview">
                <a href="#"><i class='fa fa-database'></i> <span>{{ trans('adminlte_lang::message.items') }}</span> <i
                            class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{route('items.index')}}">{{ trans('adminlte_lang::message.items') }}</a></li>
                    <li><a href="{{route('items.create')}}">{{ trans('adminlte_lang::message.create_item') }}</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#"><i class='fa fa-shopping-basket '></i>
                    <span>{{ trans('adminlte_lang::message.inventories') }}</span> <i
                            class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{route('inventories.index')}}">{{ trans('adminlte_lang::message.inventories') }}</a>
                    </li>
                    <li>
                        <a href="{{route('inventories.create')}}">{{ trans('adminlte_lang::message.create_inventory') }}</a>
                    </li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#"><i class='fa fa-archive'></i> <span>{{ trans('adminlte_lang::message.stocks') }}</span> <i
                            class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{ url('admin/stocks') }}">{{ trans('adminlte_lang::message.stocks') }}</a></li>
                </ul>
                <ul class="treeview-menu">
                    <li><a href="{{ url('admin/mws/fba-inv') }}">{{ trans('adminlte_lang::message.fba_stocks') }}</a>
                    </li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#"><i class='fa fa-yen'></i> <span>{{ trans('adminlte_lang::message.sales') }}</span> <i
                            class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{ url('admin/mws/sell') }}">Sales Report</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="{{route('shops.index')}}"><i class='fa fa-home'></i>
                    <span>{{ trans('adminlte_lang::message.shops') }}</span></a>
            </li>

            <li class="treeview">
                <a href="{{route('users.index')}}"><i class='fa fa-group'></i>
                    <span>{{ trans('adminlte_lang::message.users') }}</span></a>
            </li>
            <li class="treeview">
                <a href="{{ url('admin/rss-read') }}"><i class='fa fa-newspaper-o'></i>
                    <span>{{ trans('adminlte_lang::message.rss_news') }}</span> </a>
            </li>
            <li class="treeview">
                <a href="{{ url('admin/research-shops') }}"><i class='fa fa-map-marker'></i>
                    <span>{{ trans('adminlte_lang::message.maps') }}</span> </a>
            </li>
            <li class="treeview">
                <a href="{{ route('merchant.edit',App\Merchant::merchantUserCheck()) }}"><i class='fa fa-cog'></i>
                    <span>{{ trans('adminlte_lang::message.setting') }}</span> </a>
            </li>
            <li class="treeview">
                <a href="{{  url('admin/tepdon') }}"><i class='fa fa-cog'></i>
                    <span>{{ trans('adminlte_lang::message.tepdon') }}</span> </a>
            </li>
            <li class="treeview">
                <a href="{{ url('admin/contact') }}"><i class='fa fa-envelope-o'></i>
                    <span>{{ trans('adminlte_lang::message.contact_master') }}</span> </a>
            </li>
        </ul><!-- /.sidebar-menu -->
        {{--
        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">{{ trans('adminlte_lang::message.header') }}</li>
            <!-- Optionally, you can add icons to the links -->
            <li class="active"><a href="{{ url('home') }}"><i class='fa fa-link'></i> <span>{{ trans('adminlte_lang::message.home') }}</span></a></li>
            <li><a href="#"><i class='fa fa-link'></i> <span>{{ trans('adminlte_lang::message.anotherlink') }}</span></a></li>
            <li class="treeview">
                <a href="#"><i class='fa fa-link'></i> <span>{{ trans('adminlte_lang::message.multilevel') }}</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="#">{{ trans('adminlte_lang::message.linklevel2') }}</a></li>
                    <li><a href="#">{{ trans('adminlte_lang::message.linklevel2') }}</a></li>
                </ul>
            </li>
        </ul><!-- /.sidebar-menu -->
        --}}
    </section>
    <!-- /.sidebar -->
</aside>
