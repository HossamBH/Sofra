<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Sofra</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{asset('adminlte/plugins/bootstrap/dist/css/bootstrap.min.css')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('adminlte/plugins/font-awesome/css/font-awesome.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{asset('adminlte/plugins/Ionicons/css/ionicons.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('adminlte/css/AdminLTE.min.css')}}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{asset('adminlte/css/skins/_all-skins.min.css')}}">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

    <header class="main-header">
        <!-- Logo -->
        <a href="../../home" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>S</b></span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg">Sofra</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>

            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav" data-widget="tree">
                <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                          <img src="{{asset('adminlte/img/user2-160x160.jpg')}}" class="user-image" alt="User Image">
                          <span class="hidden-xs">{{auth()->user()->name}}</span>
                        </a>
                        <ul class="dropdown-menu">
                          <!-- User image -->
                          <li class="user-header">
                            <img src="{{asset('adminlte/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image">

                            <p>
                              {{auth()->user()->name}}
                            </p>
                          </li>
                          <!-- Menu Footer-->
                          <li class="user-footer">
                            <div class="pull-right">
                              <a href="{{ url('/logout') }}" class="btn btn-default btn-flat">Sign out</a>
                            </div>
                          </li>
                        </ul>
                </li>
                </ul>
            </div>
        </nav>
    </header>

  <!-- =============================================== -->

  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{asset('adminlte/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{auth()->user()->name}}</p>
        </div>
      </div>

      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li><a href="{{url('cities')}}"><i class="fa fa-book"></i> <span>Cities</span></a></li>
        <li><a href="{{url('neighborhoods')}}"><i class="fa fa-flag"></i> <span>Neighborhoods</span></a></li>
        <li><a href="{{url('categories')}}"><i class="fa fa-list"></i> <span>Categories</span></a></li>
        <li><a href="{{url('clients')}}"><i class="fa fa-users"></i> <span>Clients</span></a></li>
        <li><a href="{{url('restaurants')}}"><i class="fa fa-cutlery"></i> <span>Restaurants</span></a></li>
        <li><a href="{{url('orders')}}"><i class="fa fa-cutlery"></i> <span>Orders</span></a></li>
        <li><a href="{{url('restaurant-payments')}}"><i class="fa fa-dollar"></i> <span>Payments</span></a></li>
        <li><a href="{{url('offers')}}"><i class="fa fa-tags"></i> <span>Offers</span></a></li>
        <li><a href="{{url('settings')}}"><i class="fa fa-cogs"></i> <span>Setting</span></a></li>
        <li><a href="{{url('contacts')}}"><i class="fa fa-phone"></i> <span>Contacts</span></a></li>
        <li><a href="{{url('payment-methods')}}"><i class="fa fa-cc-visa"></i> <span>Payment Methods</span></a></li>
        <li><a href="{{url('users')}}"><i class="fa fa-users"></i> <span>Users</span></a></li>
        <li><a href="{{url('user-password/change-password')}}"><i class="fa fa-edit"></i> <span>Change Password</span></a></li>
        <li><a href="{{url('roles')}}"><i class="fa fa-list"></i> <span>Roles</span></a></li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    @yield('content')
  </div>
  <!-- /.content-wrapper -->
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="{{asset('adminlte/plugins/jquery/dist/jquery.min.js')}}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{asset('adminlte/plugins/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- SlimScroll -->
<script src="{{asset('adminlte/plugins/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
<!-- FastClick -->
<script src="{{asset('adminlte/plugins/fastclick/lib/fastclick.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('adminlte/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<!-- <script src="{{asset('adminlte/js/demo.js')}}"></script> -->
<script>
  $(document).ready(function () {
    $('.sidebar-menu').tree()
  })
</script>
@stack('scripts')
</body>
</html>