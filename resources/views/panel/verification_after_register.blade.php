<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="description" content="{{ $datawebsite->meta }}">
        <meta name="keywords" content="{{ $datawebsite->meta }}">
        <meta name="author" content="{{ $datawebsite->meta }}">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="icon" type="image/x-icon" href="{{ $datawebsite->icon }}">
        <title>{{ $datawebsite->title }}</title>

        <!-- Google Font: Source Sans Pro -->
        <link
            rel="stylesheet"
            href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="/assets/panel/plugins/fontawesome-free/css/all.min.css">
        <!-- Ionicons -->
        <link
            rel="stylesheet"
            href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <!-- icheck bootstrap -->
        <link
            rel="stylesheet"
            href="/assets/panel/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="/assets/panel/dist/css/adminlte.min.css">
        
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
        
        <style>
            .nav-link.active, .card-header, .btn-primary, .btn-primary:hover, .btn-info, .btn-info:hover{
                background-color:#8D0880 !important;
                border: 1px solid #8D0880;
                color:#fff;
            }
            a, a:focus {
                color:#8D0880;
            }
        </style>
    </head>
    <body class="hold-transition login-page">
        <div class="login-box">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title m-0"><i class="ion-checkmark-round"></i> Registrasi Telah Berhasil</h5>
              </div>
              <div class="card-body">
                <p class="card-text">Silahkan Buka Inbox / Spam Email Anda, untuk verifikasi akun.</p>
                <a href="//{{ substr(strrchr($datauser->email, '@'), 1) }}" target="_blank" class="btn btn-primary"><i class="ion-ios-email-outline"></i> Buka Email</a>
                <a href="{{ route('panel.login') }}" class="btn btn-primary float-right"><i class="ion-log-in"></i> Login</a>
              </div>
            </div>
            <!-- /.card -->
        </div>
        <!-- jQuery -->
        <script src="/assets/panel/plugins/jquery/jquery.min.js"></script>
        <!-- Bootstrap 4 -->
        <script src="/assets/panel/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- AdminLTE App -->
        <script src="/assets/panel/dist/js/adminlte.min.js"></script>

        <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    </body>
</html>