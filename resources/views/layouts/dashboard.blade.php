<!doctype html>
<html class="no-js " lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<meta name="description" content="Responsive Bootstrap 4 and web Application ui kit.">
<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>Bite Laundry</title>
<link rel="icon" href="favicon.ico" type="image/x-icon"> <!-- Favicon-->
<link rel="stylesheet" href="/assets/plugins/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="/assets/plugins/jvectormap/jquery-jvectormap-2.0.3.min.css"/>
<link rel="stylesheet" href="/assets/plugins/charts-c3/plugin.css"/>
<link rel="stylesheet" href="/assets/plugins/jquery-datatable/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="/assets/plugins/morrisjs/morris.min.css" />
<link href="/assets/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet" />
<!-- Bootstrap Select Css -->
<link href="/assets/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
<!-- Custom Css -->
<link rel="stylesheet" href="/assets/css/style.min.css">
</head>

<body class="theme-blush">

<!-- Page Loader -->
<div class="page-loader-wrapper">
    <div class="loader">
        <div class="m-t-30"><img class="zmdi-hc-spin" src="/assets/images/logo.jpg" width="48" height="48" alt="Aero"></div>
        <p>Tunggu Bentar...</p>
    </div>
</div>

<!-- Overlay For Sidebars -->
<div class="overlay"></div>

<!-- Main Search -->
<div id="search">
    <button id="close" type="button" class="close btn btn-primary btn-icon btn-icon-mini btn-round">x</button>
    <form>
      <input type="search" value="" placeholder="Search..." />
      <button type="submit" class="btn btn-primary">Search</button>
    </form>
</div>

<!-- Right Icon menu Sidebar -->
@include('partials.navbar-right')

<!-- Left Sidebar -->
@include('partials.sidebar-left')

<!-- Right Sidebar -->
@include('partials.sidebar-right')

<!-- Main Content -->
@yield('content')


<!-- Jquery Core Js --> 
<script src="/assets/bundles/libscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js ( jquery.v3.2.1, Bootstrap4 js) --> 
<script src="/assets/bundles/vendorscripts.bundle.js"></script> <!-- slimscroll, waves Scripts Plugin Js -->

<script src="/assets/bundles/jvectormap.bundle.js"></script> <!-- JVectorMap Plugin Js -->
<script src="/assets/bundles/sparkline.bundle.js"></script> <!-- Sparkline Plugin Js -->
<script src="/assets/bundles/c3.bundle.js"></script>

<script src="/assets/bundles/mainscripts.bundle.js"></script>
<script src="/assets/js/pages/index.js"></script>
<script src="/assets/bundles/datatablescripts.bundle.js"></script>
<script src="/assets/plugins/jquery-datatable/buttons/dataTables.buttons.min.js"></script>
<script src="/assets/plugins/jquery-datatable/buttons/buttons.bootstrap4.min.js"></script>
<script src="/assets/plugins/jquery-datatable/buttons/buttons.colVis.min.js"></script>
<script src="/assets/plugins/jquery-datatable/buttons/buttons.flash.min.js"></script>
<script src="/assets/plugins/jquery-datatable/buttons/buttons.html5.min.js"></script>
<script src="/assets/plugins/jquery-datatable/buttons/buttons.print.min.js"></script>
<script src="/assets/js/pages/tables/jquery-datatable.js"></script>
<script src="/assets/js/pages/forms/basic-form-elements.js"></script>
<script src="/assets/plugins/momentjs/moment.js"></script> <!-- Moment Plugin Js --> 
<!-- Bootstrap Material Datetime Picker Plugin Js -->
<script src="/assets/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script> 
{{-- <script src="//assets/js/jquery-3.6.1.js"></script> --}}
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="/assets/js/pages/ui/notifications.js"></script> <!-- Custom Js -->
<script src="/assets/plugins/bootstrap-notify/bootstrap-notify.js"></script> 

<script>
    $( document ).ready(function() {
      $('#btn-logout').on('click',function(e){
        swal({
              title: "Yakin mau logout??",
              icon: "warning",
              buttons: true,
              dangerMode: true,
          })
          .then((willDelete) => {
              if (willDelete) {
                $.ajax({
                  type: 'post',
                  url: '/logout',
                  headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                  success: function (data) {
                    window.location = '/';
                  }
              });
              }
          });
      });
    });
</script>

@yield('js')

</body>
</html>