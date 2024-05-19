<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title> Xeloro - Admin & Dashboard Template</title>
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

    <div>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="d-flex align-items-center min-vh-100">
                        <div class="w-100 d-block bg-white shadow-lg rounded my-5">
                            <div class="row">
                                <div class="col-lg-5 d-none d-lg-block bg-login rounded-left"></div>
                                <div class="col-lg-7">
                                    <div class="p-5">
                                        <div class="text-center mb-5">
                                            <a href="index.html" class="text-dark font-size-22 font-family-secondary">
                                                <i class="mdi mdi-alpha-x-circle"></i> <b>XELORO</b>
                                            </a>
                                        </div>
                                        <h1 class="h5 mb-1">Selamat Datang!</h1>
                                        <p class="text-muted mb-4">Sistem Tracer Study SMK N 02 Cilacap.</p>
                                        <form action="{{ route('action-login') }}" method="POST" class="user" >
                                            @csrf
                                            <div class="form-group">
                                                <input type="text" class="form-control form-control-user"
                                                    id="username" name="username" placeholder="Username">
                                            </div>
                                            <div class="form-group">
                                                <input type="password" class="form-control form-control-user"
                                                    id="password" name="password" placeholder="Password">
                                            </div>
                                            <button class="btn btn-primary waves-effect waves-light" type="submit">Log In</button>
                                            {{-- <div class="text-center mt-4">
                                                <a href="forgot-password.html" class="text-muted
                                                    font-size-13">Lupa Password?</a>
                                            </div> --}}
                                        </form>

                                    </div> <!-- end .padding-5 -->
                                </div> <!-- end col -->
                            </div> <!-- end row -->
                        </div> <!-- end .w-100 -->
                    </div> <!-- end .d-flex -->
                </div> <!-- end col-->
            </div> <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end page -->

    <!-- jQuery  -->
    <script src="{{ url('') }}/assets/js/jquery.min.js"></script>
    <script src="{{ url('') }}/assets/js/bootstrap.bundle.min.js"></script>
    <script src="{{ url('') }}/assets/js/metismenu.min.js"></script>
    <script src="{{ url('') }}/assets/js/waves.js"></script>
    <script src="{{ url('') }}/assets/js/simplebar.min.js"></script>

    <!-- App js -->
    <script src="{{ url('') }}/assets/js/theme.js"></script>

</body>

</html>
