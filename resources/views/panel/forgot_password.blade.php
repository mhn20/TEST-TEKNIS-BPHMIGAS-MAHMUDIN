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
    <div class="register-box">
            <div class="card card-outline card-primary">
                <div class="card-header text-center">
                    <div class="h1">
                    <b>{{ $datawebsite->title }}</b></div>
                </div>
                <div class="card-body">
                    <p class="login-box-msg">Change New Password</p>

                    <form action="{{ route('panel.changePassword') }}" method="post" id="form_data">
                        {{ csrf_field() }}
                        <div class="input-group mb-3">
                            <input type="password" name="password" class="form-control" minlength="5" placeholder="Password New" required>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" name="confirm_password" class="form-control" minlength="5" placeholder="Retype password New" required>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <!-- /.col -->
                            <div class="col-4">
                                <button type="submit" class="btn btn-primary btn-block"><i class="ion-android-send"></i> Save</button>
                            </div>
                            <!-- /.col -->
                        </div>
                    </form>

                    <a href="/panel/login/" class="text-center">I already have a membership</a>
                </div>
                <!-- /.form-box -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.register-box -->

        <!-- jQuery -->
        <script src="/assets/panel/plugins/jquery/jquery.min.js"></script>
        <!-- Bootstrap 4 -->
        <script src="/assets/panel/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- AdminLTE App -->
        <script src="/assets/panel/dist/js/adminlte.min.js"></script>

        <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

        <script>

            $('document').ready(function(){
                if (localStorage.getItem("rememberMe") === "true") {
                    $('#username').val(localStorage.getItem("username"));
                    $('#rememberMe').prop("checked", true);
                }
            });

            $('#form_data').on('submit',function(e){
                e.preventDefault();
                var btn_submit = $(this).find('button[type="submit"]');
                btn_submit.attr('disabled','disabled');
                btn_submit.html(`<i class="fas fa-spin fa-spinner"></i>`);
                var form_action = new FormData(this);
                form_action.append('keyforgotpassword',`{{ request()->get('keyforgotpassword') }}`);
                $.ajax({
                    method:'POST',
                    processData: false,
                    contentType: false,
                    cache: false,
                    url: $(this).attr('action'),
                    data: form_action,
                    success:function(result){
                        btn_submit.removeAttr('disabled');
                        btn_submit.html(`<i class="ion-android-send"></i> Save`);
                        if(result.status == 200){
                            setTimeout(() => {
                                location='/panel/login';
                            }, 1000);
                        }
                        alertToatstr(result.status,result.messages);
                    },
                    error:function(err){
                        btn_submit.removeAttr('disabled');
                        btn_submit.html(`<i class="ion-android-send"></i> Save`);
                        alertToatstr(500,'Error Sistem');
                    }
                });
            });

            function alertToatstr(status,messages){
                toastr.options = {
                    "closeButton": false,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": true,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                }
                if(status == 200){
                    toastr.success(messages);
                }else{
                    toastr.error(messages);
                }
            }
        </script>
    </body>
</html>