<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Seat Booking</title>
    <!-- base:css -->
    <link rel="stylesheet" href="{{asset('vendors/mdi/css/materialdesignicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('vendors/base/vendor.bundle.base.css')}}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/css/tempusdominus-bootstrap-4.min.css" />

    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <!-- endinject -->
    <link rel="shortcut icon" href="{{asset('images/favicon.png')}}"/>
</head>

<body>
<div class="container-scroller">

    @include('layouts.includes.header')
    @yield('content')
</div>

<!-- container-scroller -->
<!-- base:js -->
<script src="{{asset('vendors/base/vendor.bundle.base.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.27.0/moment.min.js" integrity="sha512-rmZcZsyhe0/MAjquhTgiUcb4d9knaFc7b5xAfju483gbEXTkeJRUMIPk6s3ySZMYUHEcjKbjLjyddGWMrNEvZg==" crossorigin="anonymous"></script>
<script src="{{asset('build/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<!-- endinject -->
<!-- Plugin js for this page-->
<!-- End plugin js for this page-->
<!-- inject:js -->
<script src="{{asset('js/template.js')}}"></script>
<!-- endinject -->
<!-- plugin js for this page -->
<!-- End plugin js for this page -->
<script src="{{asset('vendors/chart.js/Chart.min.js')}}"></script>
<script src="{{asset('vendors/progressbar.js/progressbar.min.js')}}"></script>
<script src="{{asset('vendors/chartjs-plugin-datalabels/chartjs-plugin-datalabels.js')}}"></script>
<script src="{{asset('vendors/justgage/raphael-2.1.4.min.js')}}"></script>
<script src="{{asset('vendors/justgage/justgage.js')}}"></script>
<!-- Custom js for this page-->
{{--<script src="{{asset('js/dashboard.js')}}"></script>--}}
<!-- End custom js for this page-->
<script type="text/javascript">
    $(function () {
        $('#dated').datetimepicker({
            format: 'YYYY-MM-DD HH:mm',
            sideBySide: true,
            stepping: 15
            });
    });
</script>

</body>
</html>
