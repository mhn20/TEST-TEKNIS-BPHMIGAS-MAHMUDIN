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

        <title>{{ $page_title }} | {{ $datawebsite->title }}</title>

        <!-- Google Font: Source Sans Pro -->
        <link
            rel="stylesheet"
            href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="<?= asset('assets/panel') ?>/plugins/fontawesome-free/css/all.min.css">
        <!-- Ionicons -->
        <link
            rel="stylesheet"
            href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <!-- Tempusdominus Bootstrap 4 -->
        <link
            rel="stylesheet"
            href="<?= asset('assets/panel') ?>/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
        <!-- iCheck -->
        <link rel="stylesheet" href="<?= asset('assets/panel') ?>/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
        <!-- JQVMap -->
        <link rel="stylesheet" href="<?= asset('assets/panel') ?>/plugins/jqvmap/jqvmap.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="<?= asset('assets/panel') ?>/dist/css/adminlte.min.css">
        <!-- overlayScrollbars -->
        <link rel="stylesheet" href="<?= asset('assets/panel') ?>/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
        <!-- Daterange picker -->
        <link rel="stylesheet" href="<?= asset('assets/panel') ?>/plugins/daterangepicker/daterangepicker.css">
        <!-- summernote -->
        <link rel="stylesheet" href="<?= asset('assets/panel') ?>/plugins/summernote/summernote-bs4.min.css">
        <!-- Ekko Lightbox -->
        <link rel="stylesheet" href="<?= asset('assets/panel') ?>/plugins/ekko-lightbox/ekko-lightbox.css">
        <!-- Select2 -->
        <link rel="stylesheet" href="<?= asset('assets/panel') ?>/plugins/select2/css/select2.min.css">
        <link rel="stylesheet" href="<?= asset('assets/panel') ?>/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
        <style>
            .nav-link.active, .card-header, .btn-primary, .btn-primary:hover, .btn-info, .btn-info:hover, .bg-info-1, .btn-success, .btn-success:hover, .alert-success, .alert-info, .alert-primary{
                background-color:#8D0880 !important;
                border: 1px solid #8D0880;
                color:#fff;
            }
            .bg-info-2{
                background-color:#EF9A50 !important;
                border: 1px solid #EF9A50;
                color:#fff;
                
            }
            a, a:focus {
                color:#8D0880;
            }
        </style>
        @yield('css')
        <script src="https://unpkg.com/imask"></script>
    </head>
    <body class="hold-transition sidebar-mini layout-fixed">
        <div class="wrapper">

            <!-- Preloader -->
            <div class="preloader flex-column justify-content-center align-items-center">
                <img
                    class="animation__shake"
                    src="{{ $datawebsite->icon }}"
                    alt="{{ $datawebsite->title }}"
                    height="60"
                    width="60">
            </div>

            <!-- Navbar -->
            <nav class="main-header navbar navbar-expand navbar-white navbar-light">
                <!-- Left navbar links -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                            <i class="fas fa-bars"></i>
                        </a>
                    </li>
                </ul>

                <!-- Right navbar links -->
                <ul class="navbar-nav ml-auto">
                   
                    <!-- Notifications Dropdown Menu -->
                    <!-- <li class="nav-item dropdown">
                        <a class="nav-link" data-toggle="dropdown" href="#">
                            <i class="far fa-bell"></i>
                            <span class="badge badge-warning navbar-badge">15</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                            <span class="dropdown-item dropdown-header">15 Notifications</span>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">
                                <i class="fas fa-envelope mr-2"></i>
                                4 new messages
                                <span class="float-right text-muted text-sm">3 mins</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">
                                <i class="fas fa-users mr-2"></i>
                                8 friend requests
                                <span class="float-right text-muted text-sm">12 hours</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">
                                <i class="fas fa-file mr-2"></i>
                                3 new reports
                                <span class="float-right text-muted text-sm">2 days</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                        </div>
                    </li> -->
                    <li class="nav-item">
                        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                            <i class="fas fa-expand-arrows-alt"></i>
                        </a>
                    </li>
                    <!-- <li class="nav-item">
                        <a
                            class="nav-link"
                            data-widget="control-sidebar"
                            data-controlsidebar-slide="true"
                            href="#"
                            role="button">
                            <i class="fas fa-th-large"></i>
                        </a>
                    </li> -->
                    <li class="nav-item">
                        <a class="nav-link"  href="{{ route('panel.logout') }}">
                            <i class="fas fa-sign-out-alt"></i>
                        </a>
                    </li>

                    
                </ul>
            </nav>
            <!-- /.navbar -->

            <!-- Main Sidebar Container -->
            <aside class="main-sidebar sidebar-dark-primary elevation-4">
                <!-- Brand Logo -->
                <a class="brand-link">
                    <img
                        src="{{ $datawebsite->icon }}"
                        alt="{{ $datawebsite->title }}"
                        class="brand-image img-circle elevation-3"
                        style="opacity: .8">
                    <span class="brand-text font-weight-light">{{ $datawebsite->title }}</span>
                </a>

                <!-- Sidebar -->
                <div class="sidebar">
                    <!-- Sidebar user panel (optional) -->
                    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                        <div class="image">
                            <img
                                src="{{ session()->get('login_panel')['avatar'] }}"
                                class="img-circle elevation-2"
                                style="width:33px;height:33px;"
                                alt="User Image">
                        </div>
                        <div class="info">
                            <a href="{{ route('panel.editprofile') }}" class="d-block">
                                <i class="far fa-edit"></i> <i class="ion-key"></i>
                                {{ substr(strtoupper(session()->get('login_panel')['name']),0,10) }}
                                {{ strlen(session()->get('login_panel')['name'])>10?'...':''  }}
                            </a>
                        </div>
                    </div>


                    <!-- Sidebar Menu -->
                    <nav class="mt-2">
                        <ul
                            class="nav nav-pills nav-sidebar flex-column"
                            data-widget="treeview"
                            role="menu"
                            data-accordion="false">
                            <!-- Add icons to the links using the .nav-icon class with font-awesome or any
                            other icon font library -->
                            <!-- <li class="nav-item menu-open">
                                <a href="#" class="nav-link active">
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    <p>
                                        Dashboard
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="./index.html" class="nav-link active">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Dashboard v1</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="./index2.html" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Dashboard v2</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="./index3.html" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Dashboard v3</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="pages/widgets.html" class="nav-link">
                                    <i class="nav-icon fas fa-th"></i>
                                    <p>
                                        Widgets
                                        <span class="right badge badge-danger">New</span>
                                    </p>
                                </a>
                            </li> -->
                            <li class="nav-item">
                                <a href="{{ route('panel.dashboard') }}" class="nav-link {{ request()->segment(2)=='dashboard'?'active':'' }}">
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    <p>
                                        Dashboard
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('panel.barang') }}" class="nav-link {{ request()->segment(2)=='barang'?'active':'' }}">
                                    <i class="nav-icon fas fa-box"></i>
                                    <p>
                                        Barang
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('panel.invoice') }}" class="nav-link {{ request()->segment(2)=='invoice'?'active':'' }}">
                                    <i class="nav-icon fas fa-file-invoice"></i>
                                    <p>
                                        Invoice
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('panel.datawebsite') }}" class="nav-link {{ request()->segment(2)=='data-website'?'active':'' }}">
                                    <i class="nav-icon fas fa-solid fa-list"></i>
                                    <p>
                                        Data Website
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('panel.sliders') }}" class="nav-link {{ request()->segment(2)=='sliders'?'active':'' }}">
                                    <i class="nav-icon fas fa-sliders-h"></i>
                                    <p>
                                        Slider
                                    </p>
                                </a>
                            </li>
                            
                        </ul>
                    </nav>
                    <!-- /.sidebar-menu -->
                </div>
                <!-- /.sidebar -->
            </aside>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <div class="container-fluid mt-2" id="alert_confirm_email"></div>

                <!-- Main content -->
                @yield('contents')
                <form action="{{ route('panel.myprofile.prosesBantuan') }}" method="post" enctype="multipart/form-data" id="form_bantuan">
                    {{ csrf_field() }}
                    <!-- Modal -->
                    <div class="modal fade" id="modal_bantuan" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel"><i class="ion-help-circled"></i> Bantuan</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="">
                                            <b>Judul</b>
                                        </label>
                                        <input type="text" name="judul" class="form-control" required>
                                    </div>
                                    <div class="col-md-12 mt-2">
                                        <label for="">
                                            <b>Pesan</b>
                                        </label>
                                        <textarea name="pesan" class="form-control" required></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger mr-auto" data-dismiss="modal"><i class="ion-close-circled"></i> Close</button>
                                <button type="submit" class="btn btn-success"><i class="ion-android-send"></i> Kirim</button>
                            </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /.content-wrapper -->
            <footer class="main-footer">
                <strong>{{ $datawebsite->footer }}</strong>
            </footer>

            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
                <!-- Control sidebar content goes here -->
            </aside>
            <!-- /.control-sidebar -->
        </div>
        <!-- ./wrapper -->

        <!-- jQuery -->
        <script src="<?= asset('assets/panel') ?>/plugins/jquery/jquery.min.js"></script>
        <!-- jQuery UI 1.11.4 -->
        <script src="<?= asset('assets/panel') ?>/plugins/jquery-ui/jquery-ui.min.js"></script>
        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        <script>
            $.widget.bridge('uibutton', $.ui.button)
        </script>
        <!-- Bootstrap 4 -->
        <script src="<?= asset('assets/panel') ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- ChartJS -->
        <script src="<?= asset('assets/panel') ?>/plugins/chart.js/Chart.min.js"></script>
        <!-- Sparkline -->
        <script src="<?= asset('assets/panel') ?>/plugins/sparklines/sparkline.js"></script>
        <!-- JQVMap -->
        <script src="<?= asset('assets/panel') ?>/plugins/jqvmap/jquery.vmap.min.js"></script>
        <script src="<?= asset('assets/panel') ?>/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
        <!-- jQuery Knob Chart -->
        <script src="<?= asset('assets/panel') ?>/plugins/jquery-knob/jquery.knob.min.js"></script>
        <!-- daterangepicker -->
        <script src="<?= asset('assets/panel') ?>/plugins/moment/moment.min.js"></script>
        <script src="<?= asset('assets/panel') ?>/plugins/daterangepicker/daterangepicker.js"></script>
        <!-- Tempusdominus Bootstrap 4 -->
        <script
            src="<?= asset('assets/panel') ?>/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
        <!-- Summernote -->
        <script src="<?= asset('assets/panel') ?>/plugins/summernote/summernote-bs4.min.js"></script>
        <!-- overlayScrollbars -->
        <script src="<?= asset('assets/panel') ?>/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
        <!-- AdminLTE App -->
        <script src="<?= asset('assets/panel') ?>/dist/js/adminlte.js"></script>
        <!-- Ekko Lightbox -->
        <script src="<?= asset('assets/panel') ?>/plugins/ekko-lightbox/ekko-lightbox.min.js"></script>
        <!-- Filterizr-->
        <script src="<?= asset('assets/panel') ?>/plugins/filterizr/jquery.filterizr.min.js"></script>
        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <script src="<?= asset('assets/panel') ?>/dist/js/pages/dashboard.js"></script>
        <!-- Select2 -->
        <script src="<?= asset('assets/panel') ?>/plugins/select2/js/select2.full.min.js"></script>

        <script>

            let sess_is_admin = `{{ session()->get('login_panel')['is_admin'] }}`;
            let get_action = `{{ request()->get('action') }}`;
            if(get_action == 'reload'){
                setTimeout(() => {
                    location='/panel/myprofile';
                }, 3000);
            }

            $(document).on('click', '[data-toggle="lightbox"]', function(event) {
                event.preventDefault();
                $(this).ekkoLightbox({
                    alwaysShowClose: true
                });
            });

            function resendAktivasi(self){
                self.attr('disabled','disabled');
                self.html(`<i class="fas fa-spin fa-spinner"></i> Loading..`);
                $.ajax({
                    'url' : `{{ route('panel.resendAktivasi') }}`,
                    'type' : 'POST',
                    'data' : {
                        '_token' : '{{ csrf_token() }}'
                    },
                    'success' : function(result){
                        self.removeAttr('disabled');
                        self.html(`Aktivasi`);
                        alertToatstr(result.status,result.messages);
                    },
                    'error':function(err){
                        self.removeAttr('disabled');
                        self.html(`Aktivasi`);
                        alertToatstr(500,'Error Sistem');
                    }
                });
            }

            if(sess_is_admin != 1){
                labelStatusVerif();
                function labelStatusVerif(){
                    var object_ajax = {'url':`{{ route('panel.myprofile.labelStatusVerif') }}`};
                    object_ajax['type'] = 'GET';
                    var  alert_confirm_email = $('#alert_confirm_email');
                    alert_confirm_email.html(`<div class="alert alert-info"><i class="fas fa-spin fa-spinner"></i> Loading...</div>`);
                    object_ajax['success'] = function(result){
                        if(result.status == 500){
                            alert_confirm_email.html(`
                                <div class="alert alert-info">
                                    <i class="ion-close-circled"></i> ${result.messages}
                                    <button class="btn btn-sm btn-danger float-right" style="margin-top: -3px;" type="button" onclick="resendAktivasi($(this))">
                                        <i class="ion-email"></i> 
                                        Aktivasi
                                    </button>
                                    <button class="btn btn-sm btn-info float-right mr-4" style="margin-top: -3px;" type="button" onclick="bantuan()">
                                        <i class="ion-help-circled"></i> Bantuan
                                    </button>
                                </div>
                            `);
                        }else if(result.status == 201){
                            alert_confirm_email.html(`
                                <div class="alert alert-warning">
                                    <i class="ion-close-circled"></i> ${result.messages} 
                                    <button class="btn btn-sm btn-info float-right" style="margin-top: -3px;" type="button" onclick="bantuan()">
                                        <i class="ion-help-circled"></i> Bantuan
                                    </button>
                                </div>
                            `);
                        }else{
                            alert_confirm_email.html(`
                                <div class="alert alert-success">
                                    <i class="fas fa-solid fa-check"></i> ${result.messages}
                                    <button class="btn btn-sm btn-info float-right" style="margin-top: -3px;" type="button" onclick="bantuan()">
                                        <i class="ion-help-circled"></i> Bantuan
                                    </button>
                                </div>
                            `);
                        }

                        if(result.messages_admin){
                            alert_confirm_email.append(`
                                <div class="alert alert-info">
                                    <i class="ion-ios-email-outline"></i> Pesan Dari Admin : ${result.messages_admin}
                                </div>
                            `);
                        }
                    };
                    object_ajax['error'] = function(err){
                        alert_confirm_email.html(`
                            <div class="alert alert-danger">Terjadi Kesalahan Koneksi Internet / Kesalahan Sistem</div>
                        `);
                    }
                    $.ajax(object_ajax);
                }
            }

            function bantuan(){
                $('#form_bantuan').trigger('reset');
                $('#modal_bantuan').modal('show');
            }
            

            $('#form_bantuan').on('submit',function(e){
                e.preventDefault();
                var btn_submit = $(this).find('button[type="submit"]');
                btn_submit.attr('disabled','disabled');
                btn_submit.html(`<i class="fas fa-spin fa-spinner"></i>`);
                var send_form = new FormData(this);
                send_form.append('_method', $(this).attr('method'));
                $.ajax({
                    method:'POST',
                    processData: false,
                    contentType: false,
                    cache: false,
                    url: $(this).attr('action'),
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: send_form,
                    success:function(result){
                        btn_submit.removeAttr('disabled');
                        btn_submit.html(`<i class="ion-android-send"></i> Kirim`);
                        alertToatstr(result.status,result.messages);
                        if(result.status == 200){
                            $('#modal_bantuan').modal('hide');
                        }
                    },
                    error:function(err){
                        btn_submit.removeAttr('disabled');
                        btn_submit.html(`<i class="ion-android-send"></i> Kirim`);
                        alertToatstr(500,'Error Sistem');
                    }
                });
            });

        </script>

        <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
        <script>
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

            mask('nik');
            mask('npwp');
            mask('telp');

            function mask(id,limit=9){
                const element = document.getElementById(id);
                var append_limit = '';
                for($i=1;$i<=limit;$i++){
                    append_limit += '0';
                }
                const maskOptions = {
                    mask: append_limit
                };
                const mask = IMask(element, maskOptions);
            }

            function formatNumber(input) {
                // Menghapus karakter selain angka
                let value = input.value.replace(/[^0-9]/g, '');

                // Menambahkan titik sebagai pemisah ribuan
                input.value = value.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
            }

            function formatRupiah(angka) {
                var angka = angka.toString().replaceAll('.',',');
                let number_string = angka.replace(/[^,\d]/g, '').toString(),
                    split = number_string.split(','),
                    sisa = split[0].length % 3,
                    rupiah = split[0].substr(0, sisa),
                    ribuan = split[0].substr(sisa).match(/\d{3}/gi);
                
                if (ribuan) {
                    let separator = sisa ? '.' : '';
                    rupiah += separator + ribuan.join('.');
                }
                
                return split[1] !== undefined ? '' + rupiah + ',' + split[1].substr(0, 2) : '' + rupiah;
            }
        </script>

        @yield('js')
    </body>
</html>