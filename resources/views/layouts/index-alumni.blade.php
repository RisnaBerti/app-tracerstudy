<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title> STUDY TRACER</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="MyraStudio" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ url('') }}/assets/images/favicon.ico">

    <!-- App css -->
    <link href="{{ url('') }}/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ url('') }}/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ url('') }}/assets/css/theme.min.css" rel="stylesheet" type="text/css" />

</head>

<body>
    @include('layouts.layout-alumni')
    @include('sweetalert::alert')


    <!-- Overlay-->
    <div class="menu-overlay"></div>
    <!-- jQuery  -->
    <script src="{{ url('') }}/assets/js/jquery.min.js"></script>
    <script src="{{ url('') }}/assets/js/bootstrap.bundle.min.js"></script>
    <script src="{{ url('') }}/assets/js/metismenu.min.js"></script>
    <script src="{{ url('') }}/assets/js/waves.js"></script>
    <script src="{{ url('') }}/assets/js/simplebar.min.js"></script>


    <!-- Sparkline Js-->
    <script src="../plugins/jquery-sparkline/jquery.sparkline.min.js"></script>

    <!-- Chart Js-->
    <script src="../plugins/jquery-knob/jquery.knob.min.js"></script>

    <!-- Chart Custom Js-->
    <script src="{{ url('') }}/assets/pages/knob-chart-demo.js"></script>


    <!-- Morris Js-->
    <script src="../plugins/morris-js/morris.min.js"></script>

    <!-- Raphael Js-->
    <script src="../plugins/raphael/raphael.min.js"></script>

    <!-- Custom Js -->
    <script src="{{ url('') }}/assets/pages/dashboard-demo.js"></script>

    <!-- App js -->
    <script src="{{ url('') }}/assets/js/theme.js"></script>

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>


    @include('sweetalert::alert', ['cdn' => 'https://cdn.jsdelivr.net/npm/sweetalert2@9'])


    {{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}

</body>

</html>
