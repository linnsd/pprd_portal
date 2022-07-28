@extends('adminlte::master')

@section('adminlte_css')
    <link rel="stylesheet"
          href="{{ asset('vendor/adminlte/dist/css/skins/skin-' . config('adminlte.skin', 'blue') . '.min.css')}} ">
    @stack('css')
    @yield('css')

    <style>
        .footer {
           position: absolute;
           left: 0;
           bottom: 0;
           width: 100%;
           padding-bottom: 10px;
           padding-top: 10px;
           background-color: #f4f4f5;
           color: black;
           text-align: center;
           border-top-width: 1px solid black;
        }
    </style>
@stop

@section('header_js')
    @yield('hjs')
@stop


@section('body_class', 'skin-' . config('adminlte.skin', 'blue') . ' sidebar-mini ' . (config('adminlte.layout') ? [
    'boxed' => 'layout-boxed',
    'fixed' => 'fixed',
    'top-nav' => 'layout-top-nav'
][config('adminlte.layout')] : '') . (config('adminlte.collapse_sidebar') ? ' sidebar-collapse ' : ''))

@section('body')
    <div class="wrapper">

        <!-- Main Header -->
        <header class="main-header">
            @if(config('adminlte.layout') == 'top-nav')
            <nav class="navbar navbar-static-top">
                <div class="container">
                    <div class="navbar-header">
                        <a href="{{ url('admin/home') }}" class="navbar-brand">
                            {{-- <img src="{{ asset('img/mmia.png')}}" alt="mmia" width="30%"> --}}
                            PPRD
                        </a>
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                            <i class="fa fa-bars"></i>
                        </button>
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
                        <ul class="nav navbar-nav">
                            @each('adminlte::partials.menu-item-top-nav', $adminlte->menu(), 'item')
                        </ul>
                    </div>
                    <!-- /.navbar-collapse -->
            @else
            <!-- Logo -->
            <a href="{{ url('admin/home') }}" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <img src="{{ asset('img/logo.png')}}" alt="mmia" width="25%">
                PPRD
                <!-- logo for regular state and mobile devices -->
                {{-- <img src="{{ asset('img/nmia.png')}}" alt="nmia" width="30%"> --}}
            </a>

            <!-- Header Navbar -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                    <span class="sr-only">{{ trans('adminlte::adminlte.toggle_navigation') }}</span>
                </a>
            @endif
                <!-- Navbar Right Menu -->
                <div class="navbar-custom-menu">

                    <ul class="nav navbar-nav">
                       {{--  @foreach($townships as $township)
                            <li class="dropdown notifications-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                  <i class="fa fa-bell-o"></i>
                                  <span class="label" style="background-color: {{ $township->color_code }} !important;">0</span>
                                </a>
                                <ul class="dropdown-menu">
                                  <li>
                                   
                                    <ul class="menu">
                                      <li>
                                        <a href="#">
                                          <i class="fa fa-user text-red"></i> Mg Mg
                                        </a>
                                      </li>
                                    </ul>
                                  </li>
                                  <li class="footer"><a href="#">View all</a></li>
                                </ul>
                            </li>
                        @endforeach --}}
                        {{-- <li>
                            <a>
                                <i class="fa fa-fw fa-user"></i> {{ Auth::user()->name_en }}
                            </a>
                        </li> --}}
                        <!-- User Account Menu -->
                        {{-- <li class="dropdown user user-menu">
                            <!-- Menu Toggle Button -->
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <!-- The user image in the navbar-->
                                @if(Auth::user()->photo!='')
                                    <img src="{{ asset("uploads/member/".Auth::user()->photo) }}" class="user-image" alt="User Image"/>
                                
                                @else
                                    <img src="{{ asset("img/admin.png") }}" class="user-image" alt="User Image"/>
                                @endif
                                
                                <!-- hidden-xs hides the username on small devices so only the image appears. -->
                                <span class="hidden-xs">{{ Auth::user()->name_en }}</span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- The user image in the menu -->
                                <li class="user-header">
                                    @if(Auth::user()->photo!='')
                                        <img src="{{ asset("uploads/member/".Auth::user()->photo) }}" class="img-circle" alt="User Image"/>
                                    
                                    @else
                                        <img src="{{ asset("img/admin.png") }}" class="img-circle" alt="User Image"/>                                        
                                    @endif
                                   
                                    <p>
                                        {{ Auth::user()->name_en }}
                                        <small>Member since {{ date('d M Y', strtotime(Auth::user()->created_at)) }}</small>
                                    </p>
                                </li>
                                <!-- Menu Body -->
                                <li class="user-body">
                                    <div class="col-xs-4 text-center">
                                        <a href="#">Followers</a>
                                    </div>
                                    <div class="col-xs-4 text-center">
                                        <a href="#">Sales</a>
                                    </div>
                                    <div class="col-xs-4 text-center">
                                        <a href="#">Friends</a>
                                    </div>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="#" class="btn btn-default btn-flat"><i class="fa fa-fw fa-user"></i>Profile</a>
                                    </div>
                                   <div class="pull-right">
                                        <a  href="{{ route('admin.logout') }}" onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();" class="btn btn-default btn-flat">
                                                  <i class="fa fa-fw fa-power-off"></i>
                                                 {{ trans('adminlte::adminlte.log_out') }}
                                        </a>
                                        <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                                            @if(config('adminlte.logout_method'))
                                                {{ method_field(config('adminlte.logout_method')) }}
                                            @endif
                                            {{ csrf_field() }}
                                        </form>
                                    </div>
                                </li>
                            </ul>
                        </li> --}}
                        <li>
                            <a href="{{url('/admin/profile')}}">
                                    <i class="fa fa-fw fa-user"></i> {{ auth()->user()->name }}
                                </a>
                        </li>

                        <li>
                            @if(config('adminlte.logout_method') == 'GET' || !config('adminlte.logout_method') && version_compare(\Illuminate\Foundation\Application::VERSION, '5.3.0', '<'))
                                <a href="{{ url(config('adminlte.logout_url', 'auth/logout')) }}">
                                    <i class="fa fa-fw fa-power-off"></i> {{ trans('adminlte::adminlte.log_out') }}
                                </a>
                            @else
                                 <a  href="{{ route('admin.logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">

                                    <i class="fa fa-fw fa-power-off"></i> {{ trans('adminlte::adminlte.log_out') }}
                                </a>
                                <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                                    @if(config('adminlte.logout_method'))
                                        {{ method_field(config('adminlte.logout_method')) }}
                                    @endif
                                    {{ csrf_field() }}
                                </form>
                            @endif
                        </li>
                    </ul>
                </div>
                @if(config('adminlte.layout') == 'top-nav')
                </div>
                @endif
            </nav>
        </header>

        @if(config('adminlte.layout') != 'top-nav')
        <!-- Left side column. contains the logo and sidebar -->
        <aside class="main-sidebar">

            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">

                <!-- Sidebar Menu -->
                <ul class="sidebar-menu" data-widget="tree">
                    @each('adminlte::partials.menu-item', $adminlte->menu(), 'item')
                </ul>
                <!-- /.sidebar-menu -->
            </section>
            <!-- /.sidebar -->
        </aside>
        @endif

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            @if(config('adminlte.layout') == 'top-nav')
            <div class="container">
            @endif

            <!-- Content Header (Page header) -->
            <section class="content-header">
                @yield('content_header')
            </section>

            <!-- Main content -->
            <section class="content">

                @yield('content')
                <br><br>
                <footer class="footer" style="text-align: right;">
                    
                    <strong style="text-align:right;">Copyright © {{date('Y')}} by <a href="https://apps.pprd.gov.mm">PPRD</a>.</strong>
                    <!--  <div class="col-md-4">
                        <div class="text-right">
                          <b>Power by <a href="http://linncomputer.com">Linn IT Solution Co.,Ltd</a>
                        </div>
                     </div> -->
                    
                </footer>
            </section>
            <!-- /.content -->
            @if(config('adminlte.layout') == 'top-nav')
            </div>
            <!-- /.container -->
            @endif
        </div>
        <!-- /.content-wrapper -->

    </div>
    <!-- ./wrapper -->
@stop

@section('adminlte_js')
    <script src="{{ asset('vendor/adminlte/dist/js/adminlte.min.js') }}"></script>
    @stack('js')
    @yield('js')
@stop
