<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Task Management - @yield('title')</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('Admin/dist/img/favicon.ico') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{ asset('Admin/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('Admin/plugins/daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('Admin/plugins/select2/css/select2.css') }}">
    <link rel="stylesheet" href="{{asset('Admin/plugins/summernote/summernote-bs4.css')}}">
    <link rel="stylesheet" href="{{ asset('Admin/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('Admin/dist/css/style.css') }}">

</head>
<body class="sidebar-mini layout-fixed control-sidebar-slide-open text-sm">

<div class="wrapper">

    @include('Admin.Common.Navbar')
    @include('Admin.Common.Sidebar')
    @yield('AdminContent')
    @include('Admin.Common.Footer')

</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{ asset('Admin/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('Admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- Select2 -->
<script src="{{ asset('Admin/plugins/select2/js/select2.js') }}"></script>
<!-- date-range-picker -->
<script src="{{ asset('Admin/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('Admin/plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- summernote -->
<script src="{{asset('Admin/plugins/summernote/summernote-bs4.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('Admin/dist/js/adminlte.min.js') }}"></script>
<!-- tag_script App -->
<script src="{{asset('Admin/dist/js/tag_script.js')}}"></script>
<script src="{{asset('Admin/dist/js/tag_script2.js')}}"></script>

<script>
    $('form').bind("keypress", function(e) {
        if (e.keyCode == 13) {
            e.preventDefault();
            return false;
        }
    });
</script>

<script>
    $(document).ready(function() {
        $('.js-example-basic-single').select2();
    });
    scrollWin();
    function scrollWin() {
        window.scrollTo(0, 0);
    }


</script>

@yield('AdminScript')
</body>
</html>
