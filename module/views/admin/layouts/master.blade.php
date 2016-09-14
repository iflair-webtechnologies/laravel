<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>@yield('title', $title)</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon">
    <!-- Bootstrap 3.3.4 -->
    <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Datatables -->
    <link href="{{ asset('plugins/datatables/dataTables.bootstrap.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/chosen.min.css') }}">
    <link href="{{ asset('plugins/datatables/extensions/ColVis/css/dataTables.colVis.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('plugins/datatables/extensions/Responsive/css/dataTables.responsive.css') }}" rel="stylesheet" type="text/css">
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="{{ asset('dist/css/AdminLTE.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
          page. However, you can choose any other skin. Make sure you
          apply the skin class to the body tag so the changes take effect.
    -->
    <link href="{{ asset('dist/css/skins/skin-red-light.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Select2 -->
    <link href="{{ asset('plugins/select2/css/select2.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('plugins/select2/css/select2-bootstrap.css') }}" rel="stylesheet" type="text/css">
    <!-- jQuery 2.1.4 -->
    <script src="{{ asset('plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
     <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
     <script type="text/javascript" src="{{ asset('scripts/chosen.jquery.min.js') }}"></script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="//oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="//oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="skin-red-light sidebar-mini">
<div class="wrapper">
    <!-- Main Header -->
    <header class="main-header">
        <a href="{{ route('admin.index') }}" class="logo">
            <!-- LOGO -->
            Villato Backoffice
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>
        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">

        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar Menu -->
            <ul class="sidebar-menu">
                <li class="header">Menu</li>
                <!-- Optionally, you can add icons to the links -->
                <li><a href="{{ route('admin.index') }}"><i class='fa fa-dashboard'></i><span>Dashboard</span></a></li>
                <li><a href="{{ route('admin.region.index') }}"><i class='fa fa-globe'></i><span>Regions</span></a></li>
                <li><a href="{{ route('admin.category.index') }}"><i class='fa fa-folder'></i><span>Categories</span></a></li>
                <li><a href="{{ route('admin.product.index') }}"><i class='fa fa-shopping-cart'></i><span>Products</span></a></li>
                <li><a href="{{ route('admin.company.index') }}"><i class='fa fa-user'></i><span>Users Management</span></a></li>
                <li><a href="{{ route('admin.cms.index') }}"><i class='fa fa-file-text'></i><span>CMS Pages Management</span></a></li>
                <li><a href="{{ route('admin.index.transactions') }}"><i class='fa fa-money'></i><span>Payment Transactions</span></a></li>
                <li><a href="{{ route('admin.categoryadvt.index') }}"><i class='fa fa-folder'></i><span>Advertisement Categories</span></a></li>
                <li><a href="{{ route('admin.advertisement.index') }}"><i class='fa fa-briefcase'></i><span>Advertisement Management</span></a></li>
                <li><a href="{{ route('admin.index.resetpassword') }}"><i class='fa fa-key'></i><span>Change Password</span></a></li>
                <!-- <li><a href="{{ route('admin.vacancy.index') }}"><i class='fa fa-suitcase'></i><span>Vacancies</span></a></li>
                <li><a href="{{ route('admin.offer.index') }}"><i class='fa fa-tags'></i><span>Offers</span></a></li>
                <li><a href="{{ route('admin.news.index') }}"><i class='fa fa-file-text'></i><span>News</span></a></li> -->
                
                <li><a href="{{ route('logout') }}"><i class='fa fa-power-off'></i><span>Logout</span></a></li>
            </ul><!-- /.sidebar-menu -->
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                @yield('page-header')
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">

            @include('admin.includes.message')
            @include('admin.includes.errors')
            @yield('content')

        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->

    <!-- Main Footer -->
    <footer class="main-footer">
        <!-- To the right -->
        <div class="pull-right hidden-xs">
            Villato Backoffice
        </div>
        <!-- Default to the left -->
        <strong>Copyright &copy; {{ date('Y') }} <a href="http://mediaversa.nl">Mediaversa</a>.</strong> All rights reserved.
    </footer>
</div><!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->
<!-- Bootstrap 3.3.2 JS -->
<script src="{{ asset('bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
<!-- Datatables -->
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('plugins/datatables/dataTables.bootstrap.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('plugins/datatables/extensions/ColVis/js/dataTables.colVis.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('plugins/datatables/extensions/Responsive/js/dataTables.responsive.min.js') }}" type="text/javascript"></script>
<!-- Select2 -->
<script src="{{ asset('plugins/select2/js/select2.min.js') }}" type="text/javascript"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/app.min.js') }}" type="text/javascript"></script>

@yield('script')
<!-- Optionally, you can add Slimscroll and FastClick plugins.
      Both of these plugins are recommended to enhance the
      user experience. Slimscroll is required when using the
      fixed layout. -->
</body>
</html>