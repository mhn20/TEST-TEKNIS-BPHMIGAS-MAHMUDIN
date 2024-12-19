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

        <title>{{ $page_title }}
            |
            {{ $datawebsite->title }}</title>

        <!-- Google Font: Source Sans Pro -->
        <link
            rel="stylesheet"
            href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <!-- Font Awesome -->
        <link
            rel="stylesheet"
            href="<?= asset('assets/panel') ?>/plugins/fontawesome-free/css/all.min.css">
        <!-- Ionicons -->
        <link
            rel="stylesheet"
            href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <!-- Tempusdominus Bootstrap 4 -->
        <link
            rel="stylesheet"
            href="<?= asset('assets/panel') ?>/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
        <!-- iCheck -->
        <link
            rel="stylesheet"
            href="<?= asset('assets/panel') ?>/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
        <!-- JQVMap -->
        <link
            rel="stylesheet"
            href="<?= asset('assets/panel') ?>/plugins/jqvmap/jqvmap.min.css">
        <!-- Theme style -->
        <link
            rel="stylesheet"
            href="<?= asset('assets/panel') ?>/dist/css/adminlte.min.css">
        <!-- overlayScrollbars -->
        <link
            rel="stylesheet"
            href="<?= asset('assets/panel') ?>/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
        <!-- Daterange picker -->
        <link
            rel="stylesheet"
            href="<?= asset('assets/panel') ?>/plugins/daterangepicker/daterangepicker.css">
        <!-- summernote -->
        <link
            rel="stylesheet"
            href="<?= asset('assets/panel') ?>/plugins/summernote/summernote-bs4.min.css">
        <!-- Ekko Lightbox -->
        <link
            rel="stylesheet"
            href="<?= asset('assets/panel') ?>/plugins/ekko-lightbox/ekko-lightbox.css">
        <!-- Select2 -->
        <link
            rel="stylesheet"
            href="<?= asset('assets/panel') ?>/plugins/select2/css/select2.min.css">
        <link
            rel="stylesheet"
            href="<?= asset('assets/panel') ?>/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

        <link
            rel="stylesheet"
            href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
        <style>
            .alert-info,
            .alert-primary,
            .alert-success,
            .bg-info-1,
            .btn-info,
            .btn-info:hover,
            .btn-primary,
            .btn-primary:hover,
            .btn-success,
            .btn-success:hover,
            .card-header,
            .nav-link.active {
                background-color: #8D0880 !important;
                border: 1px solid #8D0880;
                color: #fff;
            }
            .bg-info-2 {
                background-color: #EF9A50 !important;
                border: 1px solid #EF9A50;
                color: #fff;

            }
            a,
            a:focus {
                color: #8D0880;
            }
        </style>
        @yield('css')
        <script src="https://unpkg.com/imask"></script>
    </head>
    <body class="">
        <!-- Content Wrapper. Contains page content -->
        <div class="">

            <section class="">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">

                            <!-- Main content -->
                            <div class="invoice p-3 mb-3">
                                <!-- title row -->
                                <div class="row">
                                    <div class="col-12">
                                        <h4>
                                            <i class="fas fa-globe"></i>
                                            {{ $datawebsite->title }}
                                            - No Invoice
                                        <?php
                                                if(strlen($datainvoice->id) == 1){
                                                    $noinvoice = "000".$datainvoice->id;
                                                }else if(strlen($datainvoice->id) == 2){
                                                    $noinvoice = "00".$datainvoice->id;
                                                }else if(strlen($datainvoice->id) == 3){
                                                    $noinvoice = "0".$datainvoice->id;
                                                }else{
                                                    $noinvoice = $datainvoice->id;
                                                }
                                                echo 'INV-'.$noinvoice;
                                            ?>
                                            <small class="float-right">Date:
                                                {{ date('d F Y') }}</small>
                                        </h4>
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- info row -->
                                <div class="row invoice-info">
                                    <div class="col-md-12">
                                        <span class="pl-2 pr-2 btn-primary rounded-lg">
                                            {{ $datainvoice->labelstatus }}
                                        </span>
                                    </div>
                                    <div class="col-sm-6 invoice-col">
                                        From
                                        <address>
                                            <strong>{{ $datawebsite->title }}</strong>
                                            <br>
                                            {{ $datawebsite->alamat }}
                                        </address>
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-sm-6 invoice-col">
                                        To
                                        <address>
                                            <strong>{{ $datainvoice['user']['name'] }}</strong>
                                            <br>
                                            {{ $datainvoice->negara }},
                                            {{ $datainvoice->kota }},
                                            {{ $datainvoice->kecamatan }},
                                            {{ $datainvoice->kelurahan }},
                                            {{ $datainvoice->alamat }}<br>
                                            Phone:
                                            {{ $datainvoice['user']['telp'] }}<br>
                                            Email:
                                            {{ $datainvoice['user']['email'] }}
                                        </address>
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- /.row -->

                                <!-- Table row -->
                                <div class="row">
                                    <div class="col-12 table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Qty</th>
                                                    <th>SKU</th>
                                                    <th>Nama Produk</th>
                                                    <th>Deskripsi</th>
                                                    <th>Berat (Gram)</th>
                                                    <th>Harga</th>
                                                    <th>Diskon %</th>
                                                    <th>Subtotal</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($datainvoicedetail as $rowindex)
                                                <tr>
                                                    <td>{{ $rowindex->jumlah }}</td>
                                                    <td>
                                                        {{ $rowindex->sku }}
                                                    </td>
                                                    <td>
                                                        {{ $rowindex->nmbarang }}
                                                    </td>
                                                    <td>
                                                        {{ $rowindex->deskripsi }}
                                                    </td>
                                                    <td>
                                                        {{ $rowindex->berat }}
                                                    </td>
                                                    <td>{{ number_format($rowindex->harga,0,'.',',') }}</td>
                                                    <td>
                                                        {{ $rowindex->diskon_percent }}%
                                                    </td>
                                                    <td>
                                                        {{ number_format($rowindex->subtotal,0,'.',',') }}
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- /.row -->

                                <div class="row">
                                    <!-- accepted payments column -->
                                    <div class="col-6">
                                        <p class="lead">Payment Methods:</p>
                                        <img src="<?= asset('assets/panel') ?>/dist/img/credit/visa.png" alt="Visa">
                                        <img
                                            src="<?= asset('assets/panel') ?>/dist/img/credit/mastercard.png"
                                            alt="Mastercard">
                                        <img
                                            src="<?= asset('assets/panel') ?>/dist/img/credit/american-express.png"
                                            alt="American Express">
                                        <img
                                            src="<?= asset('assets/panel') ?>/dist/img/credit/paypal2.png"
                                            alt="Paypal">
                                        <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                                            Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning
                                            heekya handango imeem plugg dopplr jibjab, movity jajah plickers sifteo edmodo
                                            ifttt zimbra.
                                        </p>
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-6">
                                        <p class="lead">Amount Due
                                            {{ $datainvoice->created_at }}</p>

                                        <div class="table-responsive">
                                            <table class="table">
                                                <tr>
                                                    <th style="width:50%">Subtotal:</th>
                                                    <td>{{ number_format($subtotal,0,'.',',') }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Ongkir</th>
                                                    <td>
                                                        {{ number_format($datainvoice->ongkir,0,'.',',') }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Total:</th>
                                                    <td>{{ number_format($total,0,'.',',') }}</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- /.row -->

                                <!-- this row will not appear when printing -->
                                <div class="row no-print">
                                    <div class="col-12">
                                        <a
                                            onclick="window.print()"
                                            rel="noopener"
                                            target="_blank"
                                            class="btn btn-default">
                                            <i class="fas fa-print"></i>
                                            Print</a>
                                        @if($datainvoice->status == 0)
                                        <button type="button" class="btn btn-success float-right" onclick="$('#form_modal').modal('show')">
                                            <i class="far fa-credit-card"></i>
                                            Bukti Transfer
                                        </button>
                                        <form entype="multipart/form-data" id="form_data" method="put" action="{{ route('panel.invoice.uploadBuktiTransfer',$id) }}">
                                            {{ csrf_field() }}
                                            <div
                                                class="modal fade"
                                                id="form_modal"
                                                tabindex="-1"
                                                aria-labelledby="exampleModalLabel"
                                                aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Bukti Transfer</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <label for="">
                                                                        <b>
                                                                            Dokumen Bukti Transfer
                                                                        </b>
                                                                    </label>
                                                                    <input
                                                                        type="file"
                                                                        name="bukti_transfer"
                                                                        class="form-control"
                                                                        required
                                                                        accept="image/*,application/pdf"
                                                                        placeholder="Dokumen Bukti Transfer">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-danger mr-auto" data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-success">
                                                                <i class="fas fa-save"></i>
                                                                Simpan</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                        @endif
                                    </div>
                                </div>

                            </div>
                            <!-- /.invoice -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>

        <!-- jQuery -->
        <script src="<?= asset('assets/panel') ?>/plugins/jquery/jquery.min.js"></script>
        <!-- jQuery UI 1.11.4 -->
        <script src="<?= asset('assets/panel') ?>/plugins/jquery-ui/jquery-ui.min.js"></script>
        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        <script>
            $
                .widget
                .bridge('uibutton', $.ui.button)
        </script>
        <!-- Bootstrap 4 -->
        <script
            src="<?= asset('assets/panel') ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- ChartJS -->
        <script src="<?= asset('assets/panel') ?>/plugins/chart.js/Chart.min.js"></script>
        <!-- Sparkline -->
        <script src="<?= asset('assets/panel') ?>/plugins/sparklines/sparkline.js"></script>
        <!-- JQVMap -->
        <script src="<?= asset('assets/panel') ?>/plugins/jqvmap/jquery.vmap.min.js"></script>
        <script
            src="<?= asset('assets/panel') ?>/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
        <!-- jQuery Knob Chart -->
        <script
            src="<?= asset('assets/panel') ?>/plugins/jquery-knob/jquery.knob.min.js"></script>
        <!-- daterangepicker -->
        <script src="<?= asset('assets/panel') ?>/plugins/moment/moment.min.js"></script>
        <script
            src="<?= asset('assets/panel') ?>/plugins/daterangepicker/daterangepicker.js"></script>
        <!-- Tempusdominus Bootstrap 4 -->
        <script
            src="<?= asset('assets/panel') ?>/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
        <!-- Summernote -->
        <script
            src="<?= asset('assets/panel') ?>/plugins/summernote/summernote-bs4.min.js"></script>
        <!-- overlayScrollbars -->

        <script
            src="<?= asset('assets/panel') ?>/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
        <!-- AdminLTE App -->
        <script src="<?= asset('assets/panel') ?>/dist/js/adminlte.js"></script>
        <!-- Ekko Lightbox -->
        <script
            src="<?= asset('assets/panel') ?>/plugins/ekko-lightbox/ekko-lightbox.min.js"></script>
        <!-- Filterizr-->
        <script
            src="<?= asset('assets/panel') ?>/plugins/filterizr/jquery.filterizr.min.js"></script>
        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <script src="<?= asset('assets/panel') ?>/dist/js/pages/dashboard.js"></script>
        <!-- Select2 -->
        <script
            src="<?= asset('assets/panel') ?>/plugins/select2/js/select2.full.min.js"></script>

        <script>

            $('#form_data').on('submit',function(e){
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
                        btn_submit.html(`<i class="fas fa-save"></i> Simpan`);
                        if(result.status==200){
                            location='';
                        }
                        alertToatstr(result.status,result.messages);
                        getData();
                    },
                    error:function(err){
                        btn_submit.removeAttr('disabled');
                        btn_submit.html(`<i class="fas fa-save"></i> Simpan`);
                        alertToatstr(500,'Error Sistem');
                    }
                });
            });

            let sess_is_admin = `{{ session()->get('login_panel')['is_admin'] }}`;
            let get_action = `{{ request()->get('action') }}`;
            if (get_action == 'reload') {
                setTimeout(() => {
                    location = '/panel/myprofile';
                }, 3000);
            }

            $(document).on('click', '[data-toggle="lightbox"]', function (event) {
                event.preventDefault();
                $(this).ekkoLightbox({alwaysShowClose: true});
            });

            function resendAktivasi(self) {
                self.attr('disabled', 'disabled');
                self.html(`<i class="fas fa-spin fa-spinner"></i> Loading..`);
                $.ajax({
                    'url': `{{ route('panel.resendAktivasi') }}`,
                    'type': 'POST',
                    'data': {
                        '_token': '{{ csrf_token() }}'
                    },
                    'success': function (result) {
                        self.removeAttr('disabled');
                        self.html(`Aktivasi`);
                        alertToatstr(result.status, result.messages);
                    },
                    'error': function (err) {
                        self.removeAttr('disabled');
                        self.html(`Aktivasi`);
                        alertToatstr(500, 'Error Sistem');
                    }
                });
            }

            if (sess_is_admin != 1) {
                labelStatusVerif();
                function labelStatusVerif() {
                    var object_ajax = {
                        'url': `{{ route('panel.myprofile.labelStatusVerif') }}`
                    };
                    object_ajax['type'] = 'GET';
                    var alert_confirm_email = $('#alert_confirm_email');
                    alert_confirm_email.html(
                        `<div class="alert alert-info"><i class="fas fa-spin fa-spinner"></i> Loading...</div>`
                    );
                    object_ajax['success'] = function (result) {
                        if (result.status == 500) {
                            alert_confirm_email.html(
                                `
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
                            `
                            );
                        } else if (result.status == 201) {
                            alert_confirm_email.html(
                                `
                                <div class="alert alert-warning">
                                    <i class="ion-close-circled"></i> ${result.messages} 
                                    <button class="btn btn-sm btn-info float-right" style="margin-top: -3px;" type="button" onclick="bantuan()">
                                        <i class="ion-help-circled"></i> Bantuan
                                    </button>
                                </div>
                            `
                            );
                        } else {
                            alert_confirm_email.html(
                                `
                                <div class="alert alert-success">
                                    <i class="fas fa-solid fa-check"></i> ${result.messages}
                                    <button class="btn btn-sm btn-info float-right" style="margin-top: -3px;" type="button" onclick="bantuan()">
                                        <i class="ion-help-circled"></i> Bantuan
                                    </button>
                                </div>
                            `
                            );
                        }

                        if (result.messages_admin) {
                            alert_confirm_email.append(
                                `
                                <div class="alert alert-info">
                                    <i class="ion-ios-email-outline"></i> Pesan Dari Admin : ${result.messages_admin}
                                </div>
                            `
                            );
                        }
                    };
                    object_ajax['error'] = function (err) {
                        alert_confirm_email.html(
                            `
                            <div class="alert alert-danger">Terjadi Kesalahan Koneksi Internet / Kesalahan Sistem</div>
                        `
                        );
                    }
                    $.ajax(object_ajax);
                }
            }

            function bantuan() {
                $('#form_bantuan').trigger('reset');
                $('#modal_bantuan').modal('show');
            }

            $('#form_bantuan').on('submit', function (e) {
                e.preventDefault();
                var btn_submit = $(this).find('button[type="submit"]');
                btn_submit.attr('disabled', 'disabled');
                btn_submit.html(`<i class="fas fa-spin fa-spinner"></i>`);
                var send_form = new FormData(this);
                send_form.append('_method', $(this).attr('method'));
                $.ajax({
                    method: 'POST',
                    processData: false,
                    contentType: false,
                    cache: false,
                    url: $(this).attr('action'),
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: send_form,
                    success: function (result) {
                        btn_submit.removeAttr('disabled');
                        btn_submit.html(`<i class="ion-android-send"></i> Kirim`);
                        alertToatstr(result.status, result.messages);
                        if (result.status == 200) {
                            $('#modal_bantuan').modal('hide');
                        }
                    },
                    error: function (err) {
                        btn_submit.removeAttr('disabled');
                        btn_submit.html(`<i class="ion-android-send"></i> Kirim`);
                        alertToatstr(500, 'Error Sistem');
                    }
                });
            });
        </script>

        <script
            src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
        <script>
            function alertToatstr(status, messages) {
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
                if (status == 200) {
                    toastr.success(messages);
                } else {
                    toastr.error(messages);
                }
            }

            mask('nik');
            mask('npwp');
            mask('telp');

            function mask(id, limit = 9) {
                const element = document.getElementById(id);
                var append_limit = '';
                for ($i = 1; $i <= limit; $i++) {
                    append_limit += '0';
                }
                const maskOptions = {
                    mask: append_limit
                };
                const mask = IMask(element, maskOptions);
            }

            function formatNumber(input) {
                // Menghapus karakter selain angka
                let value = input
                    .value
                    .replace(/[^0-9]/g, '');

                // Menambahkan titik sebagai pemisah ribuan
                input.value = value.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
            }

            function formatRupiah(angka) {
                var angka = angka
                    .toString()
                    .replaceAll('.', ',');
                let number_string = angka
                        .replace(/[^,\d]/g, '')
                        .toString(),
                    split = number_string.split(','),
                    sisa = split[0].length % 3,
                    rupiah = split[0].substr(0, sisa),
                    ribuan = split[0]
                        .substr(sisa)
                        .match(/\d{3}/gi);

                if (ribuan) {
                    let separator = sisa
                        ? '.'
                        : '';
                    rupiah += separator + ribuan.join('.');
                }

                return split[1] !== undefined
                    ? '' + rupiah + ',' + split[1].substr(0, 2)
                    : '' + rupiah;
            }
        </script>

        @yield('js')
    </body>
</html>