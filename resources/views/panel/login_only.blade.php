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
            <!-- /.login-logo -->
            <div class="card card-outline card-primary">
                <div class="card-header text-center">
                    <div class="h1">
                        <b>{{ $datawebsite->title }}</b></div>
                </div>
                <div class="card-body">
                    <p class="login-box-msg">{{ $datawebsite->footer }}</p>
                    

                    <form action="{{ route('panel.proses') }}" method="post" id="form_data">
                        {{ csrf_field() }}
                        <div class="input-group mb-3">
                            <input type="email" name="email" id="username" class="form-control" placeholder="Email">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-8">
                                <div class="icheck-primary">
                                    <input type="checkbox" id="rememberMe">
                                    <label for="rememberMe">
                                        Remember Me
                                    </label>
                                </div>
                            </div>
                            <!-- /.col -->
                            <div class="col-4">
                                <button type="submit" class="btn btn-primary btn-block"><i class="ion-log-in"></i> Sign In</button>
                            </div>
                            <div class="col-12 mt-2">
                                <a class="cursor-pointer btn btn-danger btn-block" onclick="$('#modal_forgot_password').modal('show')"><i class="fas fa-key"></i> Forgot Password ?</a>
                            </div>
                            <!-- /.col -->
                        </div>
                    </form>

                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.login-box -->
        <form action="{{ route('panel.sendForgotPassword') }}" method="post" id="form_send_forgot_password">
        {{ csrf_field() }}
        <!-- Modal -->
        <div
            class="modal fade"
            id="modal_forgot_password"
            tabindex="-1"
            aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-key"></i> Forgot Password</h5>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">
                                <b>
                                    Email
                                </b>
                            </label>
                            <input type="email" name="email" placeholder="Input Email" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger mr-auto" data-bs-dismiss="modal"><i class="ion-close-circled"></i> Close</button>
                        <button type="submit" class="btn btn-success"><i class="ion-android-send"></i> Send</button>
                    </div>
                </div>
            </div>
        </div>
        </form>
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

            

            $('#form_send_forgot_password').on('submit',function(e){
                e.preventDefault();
                var btn_submit = $(this).find('button[type="submit"]');
                btn_submit.attr('disabled','disabled');
                btn_submit.html(`<i class="fas fa-spin fa-spinner"></i>`);
                $.ajax({
                    method:'POST',
                    processData: false,
                    contentType: false,
                    cache: false,
                    url: $(this).attr('action'),
                    data: new FormData(this),
                    success:function(result){
                        btn_submit.removeAttr('disabled');
                        btn_submit.html(`<i class="ion-android-send"></i> Send`);
                        alertToatstr(result.status,result.messages);
                    },
                    error:function(err){
                        btn_submit.removeAttr('disabled');
                        btn_submit.html(`<i class="ion-android-send"></i> Send`);
                        alertToatstr(500,'Error Sistem');
                    }
                });
            });


            $('#form_data').on('submit',function(e){
                e.preventDefault();
                var btn_submit = $(this).find('button[type="submit"]');
                btn_submit.attr('disabled','disabled');
                btn_submit.html(`<i class="fas fa-spin fa-spinner"></i>`);
                $.ajax({
                    method:'POST',
                    processData: false,
                    contentType: false,
                    cache: false,
                    url: $(this).attr('action'),
                    data: new FormData(this),
                    success:function(result){
                        btn_submit.removeAttr('disabled');
                        btn_submit.html(`<i class="ion-log-in"></i> Sign In`);
                        if(result.status == 200){
                            const username = $('#username').val();
                            const password = $('#password').val();
                            const rememberMe = $('#rememberMe').is(':checked');
                            if (rememberMe) {
                                // Save username and rememberMe status
                                localStorage.setItem("username", username);
                                localStorage.setItem("password", password);
                                localStorage.setItem("rememberMe", true);
                            } else {
                                // Clear saved data if unchecked
                                localStorage.removeItem("username");
                                localStorage.removeItem("password");
                                localStorage.removeItem("rememberMe");
                            }
                            setTimeout(() => {
                                location='/panel/dashboard';
                            }, 1000);
                        }
                        alertToatstr(result.status,result.messages);
                    },
                    error:function(err){
                        btn_submit.removeAttr('disabled');
                        btn_submit.html(`<i class="ion-log-in"></i> Sign In`);
                        alertToatstr(500,'Error Sistem');
                    }
                });
            });

            var keyverif = `{{ request()->get('keyverif') }}`;

            if(keyverif){
                $.ajax({
                    'url' : `{{ route('panel.updateIsverif') }}`,
                    'type' : 'POST',
                    'data' : {
                        '_token' : '{{ csrf_token() }}', 'keyverif' : keyverif
                    },
                    'success' : function(result){
                        alertToatstr(result.status,result.messages);
                    },
                    'error':function(err){
                        alertToatstr(500,'Error Sistem');
                    }
                });
            }

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