<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'MIT Alumni') }}</title>

    <!-- Styles -->
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}

    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="/bower_components/Ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
        folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="/dist/css/skins/_all-skins.min.css">
    <!-- Date Picker -->
    <link rel="stylesheet" href="/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="/bower_components/jquery-ui/themes/base/jquery-ui.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="/bower_components/bootstrap-daterangepicker/daterangepicker.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="/DataTables/media/css/dataTables.bootstrap.css">
    <!-- Daynamic Tab -->
    <link rel="stylesheet" href="/dynamicTab/css/font-awesome.min.css">
    <link rel="stylesheet" href="/dynamicTab/css/mystyle.css">

    <link rel="stylesheet" href="/css/style.css">

    <!-- jQuery 3 -->
    <script language="JavaScript" type="text/javascript" src="/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script language="JavaScript" type="text/javascript" src="/bower_components/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
    $.widget.bridge('uibutton', $.ui.button);
    </script>

    <!-- DataTables -->
    <script src="/DataTables/media/js/jquery.dataTables.min.js"></script>
    <script src="/DataTables/media/js/dataTables.bootstrap.min.js"></script>

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <style>
        .example-modal .modal {
            position: relative;
            top: auto;
            bottom: auto;
            right: auto;
            left: auto;
            display: block;
            z-index: 1;
        }
        .example-modal .modal {
            background: transparent !important;
        }
    </style>
</head>
<body class="skin-blue fixed sidebar-mini sidebar-mini-expand-feature" style="height: auto; min-height: 100%;">
    <div id="wrapper">
        <header class="main-header">
            <!-- Logo -->
            <a href="#" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini"><b>MIT</b>A</span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg"><b>MIT</b>&nbsp Alumni</span>
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>
                </a>
        
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                    
                        @if(count(auth()->user()->roles) > 1)
                            <!-- Change Role: style can be found in dropdown.less -->
                            <li class="dropdown notifications-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-user-o"></i>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="header">Change Role</li>
                                    <li>
                                    <!-- inner menu: contains the actual data -->
                                    <ul class="menu">
                                        @foreach (auth()->user()->roles as $role)
                                            @if($role->role == Session::get('currentRole'))
                                                @continue
                                            @endif
                                            <li>
                                                <a href="{{ route('user.changeRole', ['id'=>$role->id]) }}">
                                                    <i class="fa fa-user"> to {{ $role->role }}</i> 
                                                </a>
                                            </li> 
                                        @endforeach
                                    </ul>
                                    </li>
                                    
                                </ul>
                            </li>
                        @endif

                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-gears"></i></a>
                            <ul class="dropdown-menu">
                                <!-- User name -->
                                <li class="user-header">
                                    <p>
                                        @if(auth()->user()->alumni != NULL)
                                        {{ auth()->user()->alumni->first_name}}&nbsp;{{ auth()->user()->alumni->middle_name}}&nbsp;{{ auth()->user()->alumni->last_name}} 
                                        @else
                                        {{ auth()->user()->first_name}} &nbsp; {{ auth()->user()->middle_name}} &nbsp; {{ auth()->user()->last_name}}
                                        @endif
                                        <small> Signed as- <strong>{{ Session::get('currentRole')}}</strong></small>
                                    </p>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="{{ route('user.changePassword') }}" class="btn btn-default btn-flat">Account Setting</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="{{ route('logout') }}" class="btn btn-default btn-flat" onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();"> Sign out</a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                    {{ csrf_field() }}
                                            </form>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>

        <!-- Left side column. contains the logo and sidebar -->
        <aside class="main-sidebar">
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar" style="height:auto;">
                <!-- sidebar menu: : style can be found in sidebar.less -->
                @if(Session::get('currentRole') == "Admin")
                    @include('nav.adminNav')
                @elseif(Session::get('currentRole') == "Alumni")
                    @include('nav.alumniNav')
                @elseif(Session::get('currentRole') == "Registrar")
                    @include('nav.registrarNav')
                @elseif(Session::get('currentRole') == "Department Head")
                    @include('nav.departmentHeadNav')
                @endif
            </section>
            <!-- /.sidebar -->
        </aside>

        @yield('content')

        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <div class="pull-right hidden-xs">
                <b>Version</b> 1.0
            </div>
            <strong>Copyright &copy; 2018-<?php echo date("Y"); ?> Mekelle Institute of Technology.</strong> All rights
                reserved.
        </footer>

    </div>

    <!-- Scripts -->
    {{-- <script src="{{ asset('js/app.js') }}"></script> --}}
 
    <!-- Bootstrap 3.3.7 --> 
    <script src="/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- daterangepicker -->
    <script src="/bower_components/moment/min/moment.min.js"></script>
    <script src="/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
    <!-- datepicker -->
    <script src="/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
    <!-- Slimscroll -->
    <script src="/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="/bower_components/fastclick/lib/fastclick.js"></script>
    
    <!-- AdminLTE App -->
    <script src="/dist/js/adminlte.min.js"></script>
    <!-- Daynamic Tab -->
    <script src="/dynamicTab/js/jquery.min.js"></script>
    <script src="/dynamicTab/js/popper.min.js"></script>
    <script src="/dynamicTab/js/bootstrap.min.js"></script>
    <script src="/dynamicTab/js/myscript.js"></script>
    
</body>
</html>
