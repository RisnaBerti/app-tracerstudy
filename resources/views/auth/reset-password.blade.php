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
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- App css -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/theme.min.css" rel="stylesheet" type="text/css" />

</head>


<body>    
    @include('sweetalert::alert')
    <div>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="d-flex align-items-center min-vh-100">
                        <div class="w-100 d-block bg-white shadow-lg rounded my-5">
                            <div class="row">
                                {{-- <div class="col-lg-5 d-none d-lg-block bg-login rounded-left"></div> --}}
                                <div class="col-lg-5 d-none d-lg-block rounded-left">
                                    <img src="{{ url('/assets/images/logo-sma.png') }}" alt="bg" class="img-fluid" width="634" height="951">
                                </div>
                                <div class="col-lg-7">
                                    <div class="p-5">
                                        <div class="text-center mb-5">
                                            {{-- <a href="index.html" class="text-dark font-size-22 font-family-secondary">
                                                <i class="mdi mdi-alpha-x-circle"></i> <b>XELORO</b>
                                            </a> --}}
                                        </div>
                                        <h1 class="h5 mb-1">RESET PASSWORD!</h1>
                                        <p class="text-muted mb-4">SISTEM ATRACDY SMK YPE KROYA</p>
                                        {{-- <p class="text-muted mb-4">Masukkan alamat email Anda dan kami akan mengirimkan
                                            email kepada Anda
                                            dengan instruksi untuk mengatur ulang kata sandi Anda.</p> --}}
                                        <form action="{{ route('action-reset-password', ['token' => $token]) }}" method="POST" class="user">
                                            @csrf
                                            <input type="hidden" name="token" value="{{ $token }}">
                                            <div class="form-group">
                                                <label for="email">Email Address</label>
                                                <input type="email" class="form-control form-control-user"
                                                    id="email" name="email" placeholder="Email Address">
                                            </div>

                                            <div class="form-group">
                                                <label for="password">Password Baru</label>
                                                <input type="password" class="form-control form-control-user"
                                                    id="password" name="password" placeholder="Password Baru">
                                            </div>

                                            <div class="form-group">
                                                <label for="password_confirmation">Konfirmasi Password</label>
                                                <input type="password" class="form-control form-control-user"
                                                    id="password_confirmation" name="password_confirmation" placeholder="Konfirmasi Password Baru">
                                            </div>
                                            
                                            <button class="btn btn-primary waves-effect waves-light" type="submit">Submit</button>
                                            {{-- <a href="{{ }}"
                                                class="btn btn-success btn-block waves-effect waves-light">Submit</a> --}}

                                        </form>

                                        <div class="row mt-5">
                                            <div class="col-12 text-center">
                                                <p class="text-muted">Sudah memiliki akun? <a href="{{ route('login') }}"
                                                        class="text-muted font-weight-medium ml-1"><b>Login</b></a>
                                                </p>
                                                {{-- <p class="text-muted mb-0">Don't have an account? <a
                                                        href="pages-register.html"
                                                        class="text-muted font-weight-medium ml-1"><b>Sign Up</b></a>
                                                </p> --}}
                                            </div> <!-- end col -->
                                        </div>
                                        <!-- end row -->
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

    @include('sweetalert::alert', ['cdn' => 'https://cdn.jsdelivr.net/npm/sweetalert2@9'])

    <!-- jQuery  -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/metismenu.min.js"></script>
    <script src="assets/js/waves.js"></script>
    <script src="assets/js/simplebar.min.js"></script>

    <!-- App js -->
    <script src="assets/js/theme.js"></script>

</body>

</html>
