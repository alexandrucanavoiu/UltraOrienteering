<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title')</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="/layout/bootstrap/dist/css/bootstrap.css">
    <link rel="stylesheet" href="/layout/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="/layout/Ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="/layout/jvectormap/jquery-jvectormap.css">
    <link rel="stylesheet" href="/layout/datatables.net-bs/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="/layout//plugins/toastr/toastr.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="/css/AdminLTE.css">
    <link rel="stylesheet" href="/css/skin-black.css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    @yield('scripts-header')
    <![endif]-->
</head>
<body class="hold-transition skin-black sidebar-mini">
<div class="wrapper">

    <header class="main-header">
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar-static-top">
            <p>&nbsp;</p>
        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    @include('layouts.menu')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        @yield('body')
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <div class="pull-right hidden-xs"><b>Version</b> 2.0 <a target="_blank" href="http://www.ultraorienteering.drumetiimontane.ro"> Visit Official Website</a></div>
        <div>Ultra Orienteering is a open-source software by <a target="_blank" href="http://asociatia.drumetiimontane.ro">Mountain Hiking Association</a></div>
    </footer>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="/layout/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="/layout/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="/layout/fastclick/lib/fastclick.js"></script>
<script src="/layout/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="/layout/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="/js/adminlte.min.js"></script>
<!-- Sparkline -->
<script src="/layout/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap  -->
<script src="/layout/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="/layout/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<!-- SlimScroll -->
<script src="/layout/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="/layout/plugins/toastr/toastr.min.js"></script>
<script src="/js/jquery.inputmask.bundle.min.js"></script>
<script src="/js/custom.js"></script>
@yield('scripts-footer')
@include('layouts.messages')
</body>
</html>
