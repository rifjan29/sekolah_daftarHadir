<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="id"> <!--<![endif]-->
<head>
   @include('layouts.components.head')
</head>

<body>
    <!-- Left Panel -->
    @include('layouts.components.sidebar')
    <!-- /#left-panel -->
    <!-- Right Panel -->
    <div id="right-panel" class="right-panel">
        <!-- Header-->
       @include('layouts.components.topbar')
        <!-- /#header -->
        <!-- Content -->
        @yield('content')
        <!-- /.content -->
        <div class="clearfix"></div>
        <!-- Footer -->
        @include('layouts.components.footer')
        <!-- /.site-footer -->
    </div>
    <!-- /#right-panel -->

    @include('layouts.components.logout-modal')

    <!-- Scripts -->
   @include('layouts.components.script')
</body>
</html>
