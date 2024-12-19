@extends('panel.base')
@section('css')
    <style>
        .overflowheight{
            height: 500px; /* Sesuaikan dengan tinggi layar */
            overflow-y: scroll; /* Tampilkan scrollbar vertikal jika konten melebihi */
        }
        .img-circle-custom{
            height: 50px;
            width: 50px;
        }
        td{
            vertical-align:middle !important;
        }
        th{
            white-space:nowrap;
        }
        .cursor-pointer{
            cursor: pointer;
        }

        #table_data thead tr  th{
            vertical-align:middle;
            padding:10px;
        }

        #table_data tbody tr td{
            vertical-align:top !important;
            padding:10px;
        }
        
    </style>
@endsection
@section('contents')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">{{ $page_title }}</h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="/panel/dashboard">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">{{ $page_title }}</li>
                </ol>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">
                    Pendapatan Perbulan
                </h3>

                <div class="card-tools">
                    <div class="input-group input-group-sm" style="width: 100%;">
                        <select name="bulan_awal" class="form-control">
                            @foreach($select_bulan as $rowindex)
                                <option value="{{ $rowindex['key'] }}" <?= $rowindex['key']=='01'?'selected':'' ?>>{{ $rowindex['val'] }}</option>
                            @endforeach
                        </select>
                        <select name="bulan_akhir" class="form-control">
                            @foreach($select_bulan as $rowindex)
                            <option value="{{ $rowindex['key'] }}" <?= date('m')==$rowindex['key']?'selected':'' ?>>{{ $rowindex['val'] }}</option>
                            @endforeach
                        </select>
                        <input
                            type="text"
                            name="tahun"
                            class="form-control"
                            value="<?= date('Y') ?>"
                            placeholder="Tahun">

                        <div class="input-group-append">
                            <button type="submit" class="btn btn-default" id="btn_search">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
                
            </div>
            <!-- /.card-header -->
            <div class="p-2 table-responsive">
                <div class="row">
                    @if(session()->get('login_panel')['is_admin'] == 1)
                    <div class="col-md-2">
                        <div class="alert alert-info">
                            <b>Total Gross Royalti</b>
                            <br> <span id="total_gross_royalti"></span>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="alert alert-info">
                            <b>Management Fee</b>
                            <br> <span id="management_fee"></span>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="alert alert-info">
                            <b>Gross Royalti</b>
                            <br> <span id="gross_royalti"></span>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="alert alert-info">
                            <b>PPH23</b>
                            <br> <span id="pph23"></span>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="alert alert-info">
                            <b>NPPN</b>
                            <br> <span id="nppn"></span>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="alert alert-info">
                            <b>Total NET Royalti</b>
                            <br> <span id="total_net_royalti"></span>
                        </div>
                    </div>
                    @else
                    <div class="col-md-3">
                        <div class="alert alert-info">
                            <b>Gross Royalti</b>
                            <br> <span id="gross_royalti"></span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="alert alert-info">
                            <b>PPH23</b>
                            <br> <span id="pph23"></span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="alert alert-info">
                            <b>NPPN</b>
                            <br> <span id="nppn"></span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="alert alert-info">
                            <b>Total NET Royalti</b>
                            <br> <span id="total_net_royalti"></span>
                        </div>
                    </div>
                    @endif
                    <div class="col-md-12"></div>
                    <div class="col-md-6 mt-2">
                        <div class="row">
                            <div class="col-md-3">
                                <select name="limit" class="form-control mt-2 mb-2" onchange="getData()">
                                    <option value="10">10</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <select name="orderby" class="form-control mt-2 mb-2">
                                    <option value="terbaru">Total Net Royalti Terbesar</option>
                                    <option value="terlama">Total Net Royalti Terendah</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="text-right mb-2 mt-2 paginate"></div>
                    </div>
                </div>
                <table class="table table-bordered" id="table_data">
                    <thead>
                        <tr>
                            <th style="width: 10px">No.</th>
                            <th class="text-center" style="width:50px;">Action</th>
                            <th style="width:10%;">Bulan Tahun</th>
                            @if(session()->get('login_panel')['is_admin'] == 1)
                            <th class="text-right">Total Gross Royalti</th>
                            <th class="text-center">Management Fee</th>
                            @endif
                            <th class="text-right">Gross Royalti</th>
                            <th class="text-right">PPH23</th>
                            <th class="text-right">NPPN</th>
                            <th class="text-right">Total NET Royalti</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
                <div class="text-right mb-2 paginate"></div>
            </div>
            <!-- /.card-body -->
            <!-- /.card -->
        </div>
    </div>
</section>
<form action="{{ route('panel.users.updateVerifikasi') }}" method="put" enctype="multipart/form-data" id="form_verifikasi">
    {{ csrf_field() }}
    <!-- Modal -->
    <div class="modal fade" id="modal_verif" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel"><i class="fas fa-check-circle"></i> Verifikasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <label for="">
                            <b>Nama Composer</b>
                        </label>
                        <input type="text" name="name" readonly class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label for="">
                            <b>Alias</b>
                        </label>
                        <input type="text" name="alias" readonly class="form-control">
                    </div>
                    <div class="col-md-12 mt-2">
                        <label for="">
                            <b>Verifikasi Email</b>
                        </label>
                        <select name="isverif" class="form-control">
                            <option value="">Terverifikasi / Batalkan Terverifikasi</option>
                            <option value="1">Terverifikasi</option>
                            <option value="0">Belum Terverifikasi</option>
                        </select>
                    </div>
                    <div class="col-md-12 mt-2">
                        <label for="">
                            <b>Verifikasi Admin</b>
                        </label>
                        <select name="isverifadmin" class="form-control">
                            <option value="">Terverifikasi / Tidak Terverifikasi / Batalkan Terverifikasi</option>
                            <option value="1">Terverifikasi</option>
                            <option value="-1">Tidak Terverifikasi</option>
                            <option value="0">Belum Terverifikasi</option>
                        </select>
                    </div>
                    <div class="col-md-12 mt-2">
                        <label for="">
                            <b>Keterangan</b>
                        </label>
                        <textarea name="keterangan" class="form-control"></textarea>
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
<!-- /.content -->
@endsection
@section('js')
    <script>

        var is_admin = `{{ session()->get('login_panel')['is_admin'] }}`;

        $('.remove_spasi').on('input', function(){
            var remove_spasi = $(this).val().replace(/[^A-Z0-9-/]/ig, "");
            $(this).val(remove_spasi);
        });

        $('.select2').select2({
            'width' : '100%'
        });

        $('.select2bs4').select2({
            theme: 'bootstrap4'
        });

        $('#btn_modal').on('click',function(){
            $('#exampleModalLabel').html(`<i class="fas fa-plus"></i> Add Data`);
            $('#form_modal').modal('show');
            $('#form_data').trigger('reset');
            $('#form_data').attr('method','POST');
            $('#form_data').attr('action',`{{ route('panel.document-contract.postData') }}`);
            $('[name="document"]').attr('required','required');
            $('[name="users_id"]').trigger('change');
        });

        function editData(self){
            $('#exampleModalLabel').html(`<i class="fas fa-pencil-alt"></i> Edit Data`);
            $('#form_modal').modal('show');
            $('#form_data').trigger('reset');
            $('#form_data').attr('method','PUT');
            $('#form_data').attr('action',`{{ route('panel.document-contract.editData',-1) }}`.replace(-1,self.attr('data-id')));
            $('[name="pragita_composer_id"]').val(self.attr('data-pragita_composer_id'));
            $('[name="users_id"]').val(self.attr('data-users_id'));
            $('[name="users_id"]').trigger('change');
            $('[name="no_kontrak"]').val(self.attr('data-no_kontrak'));
            
            $('[name="bulan"]').val(self.attr('data-bulan'));
            $('[name="tahun"]').val(self.attr('data-tahun'));
            $('[name="document"]').removeAttr('required');
        }

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
                    btn_submit.html(`Simpan`);
                    if(result.save_images){
                        $('#images').attr('src',result.save_images);
                    }
                    if(result.status == '200'){
                        $('#form_modal').modal('hide');
                        getData(1);
                    }
                    alertToatstr(result.status,result.messages);
                },
                error:function(err){
                    btn_submit.removeAttr('disabled');
                    btn_submit.html(`Simpan`);
                    alertToatstr(500,'Error Sistem');
                }
            });
        });

        $('document').ready(function(){
            $('#summernote').summernote();
        });

        $.each(['[name="orderby"]',`[name="bulan_awal"]`,`[name="bulan_akhir"]`,`[name="tahun"]`],function(key,val){
            $(val).on('change',function(){
                getData();
            });
        });

        getData();

        function getData(page=1){
            $('.paginate').html('');
            var table_data = $('#table_data > tbody');
            table_data.html(`
                <tr>
                    <td style="width: 10px" class="text-center" colspan="18"><i class="fas fa-spin fa-spinner"></i> Loading</td>
                </tr>
            `);
            $.ajax({
                'url' : `{{ route('panel.pendapatan.dataPerbulan') }}`,
                'type' : 'GET',
                'data' : {
                    'limit' : $(`select[name="limit"]`).val(),  'page' : page, 
                    'bulan_awal' : $('[name="bulan_awal"]').val(), 
                    'bulan_akhir' : $('[name="bulan_akhir"]').val(), 
                    'tahun' : $('[name="tahun"]').val(), 
                    'orderby' : $('[name="orderby"]').val()
                },
                'success' : function(result){
                    var rekap = result.rekap;
                    if(result.table.data.length == 0){
                        table_data.html(`
                            <tr>
                                <td style="width: 10px" class="text-center" colspan="18">Data Tidak Ditemukan</td>
                            </tr>
                        `);
                        $('#total_gross_royalti').html(0);
                        $('#management_fee').html(0);
                        $('#gross_royalti').html(0);
                        $('#pph23').html(0);
                        $('#npwp').html(0);
                        $('#nppn').html(0);
                        $('#total_net_royalti').html(0);
                    }else{
                        table_data.html('');
                        $('#total_gross_royalti').html(formatRupiah(rekap.total_gross_royalti));
                        $('#management_fee').html(formatRupiah(rekap.management_fee));
                        $('#gross_royalti').html(formatRupiah(rekap.gross_royalti));
                        $('#pph23').html(formatRupiah(rekap.pph23));
                        $('#npwp').html(formatRupiah(rekap.npwp));
                        $('#nppn').html(formatRupiah(rekap.nppn));
                        $('#total_net_royalti').html(formatRupiah(rekap.total_net_royalti));
                        $.each(result.table.data,function(key,val){
                            table_data.append(`
                                <tr>
                                    <td style="width: 10px" class="text-center">${key+1}.</td>
                                    <td class="text-center">
                                        <div class="row">
                                            <div class="col-12">
                                                <i class="fas fa-solid fa-music cursor-pointer" title="Lihat Data Percomposer" 
                                                onclick="location='?action=percomposer&tahunbulan=${val['tahunbulan']}'"></i>
                                            </div>
                                        </div>
                                    </td>
                                    <td>${val['periode']?val['periode']:'-'}</td>
                                    <td class="text-right" ${is_admin!=1?`style="display:none;"`:``}>${val['total_gross_royalti']?formatRupiah(val['total_gross_royalti']):'-'}</td>
                                    <td class="text-right" ${is_admin!=1?`style="display:none;"`:``}>${val['management_fee']?formatRupiah(val['management_fee']):'-'}</td>
                                    <td class="text-right">${val['gross_royalti']?formatRupiah(val['gross_royalti']):'-'}</td>
                                    <td class="text-right">${val['pph23']?formatRupiah(val['pph23']):'-'}</td>
                                    <td class="text-right">${val['nppn']?formatRupiah(val['nppn']):'-'}</td>
                                    <td class="text-right">${val['total_net_royalti']?formatRupiah(val['total_net_royalti']):'-'}</td>
                                </tr>
                            `);
                        });
                    }
                    var result = result.table;
                    var total_page = parseInt(result.total)/parseInt(result.per_page);
                    var total_page = Math.ceil(total_page);

                    $('.paginate').html(`
                        <button class="btn btn-info btn-sm" onclick="getData(${parseInt(result.current_page)-1})" ${result.last_page_url==null?'disabled':''}>
                            <i class="fas fa-arrow-left"></i>
                        </button>
                        ${result.current_page}/${total_page} | Total Rows ${result.total}
                        <button class="btn btn-info btn-sm" onclick="getData(${parseInt(result.current_page)+1})" ${result.next_page_url==null?'disabled':''}>
                            <i class="fas fa-arrow-right"></i>
                        </button>
                    `);
                }, 'error' : function(err){
                    $('.paginate').html('');
                    $('#total_gross_royalti').html(0);
                    $('#management_fee').html(0);
                    $('#gross_royalti').html(0);
                    $('#pph23').html(0);
                    $('#npwp').html(0);
                    $('#nppn').html(0);
                    $('#total_net_royalti').html(0);
                    table_data.html(`
                        <tr>
                            <td style="width: 10px" class="text-center" colspan="18">Terjadi Kesalahan Sistem...</td>
                        </tr>
                    `);
                }
            });
        }

        

        function updatePragitaComposerID(self){
            self.attr('disabled','disabled');
            self.html(`<i class="fas fa-spin fa-spinner"></i> Loading..`);
            $.ajax({
                'url' : `{{ route('panel.users.updatePragitaComposerID',-1) }}`.replace(-1,self.attr('data-id')),
                'type' : 'POST', 
                'data' : {
                    '_token' : `{{ csrf_token() }}`,
                    'pragita_composer_id' : $(`[name="pragita_composer_id_${self.attr('data-id')}"]`).val()
                },
                'success' : function(result){
                    self.removeAttr('disabled');
                    self.html(`<i class="fas fa-save"></i> Simpan`);
                    alertToatstr(result.status,result.messages);
                },
                'error':function(err){
                    self.removeAttr('disabled');
                    self.html(`<i class="fas fa-save"></i> Simpan`);
                    alertToatstr(500,'Error Sistem');
                }
            })
        }

        function deleteData(self){
            var konfirm = confirm('Hapus Data ?');
            if(konfirm == true){
                self.attr('disabled','disabled');
                self.html(`<i class="fas fa-spin fa-spinner"></i>`);
                $.ajax({
                    'url' : `{{ route('panel.users.deleteData',-1) }}`.replace(-1,self.attr('data-id')),
                    'type' : 'post',
                    'data' : {
                        '_method' : 'delete',
                        '_token' : "{{ csrf_token() }}"
                    },
                    'success' : function(result){
                        self.removeAttr('disabled');
                        self.html(``);
                        getData(1);
                        alertToatstr(result.status,result.messages);
                    },
                    'error':function(err){
                        self.removeAttr('disabled');
                        self.html(``);
                        alertToatstr(500,'Error Sistem');
                    }
                })
            }
        }

        function verifikasi(self){
            $('#modal_verif').modal('show');
            $('[name="name"]').val(self.attr('data-name'));
            $('[name="alias"]').val(self.attr('data-alias'));
            $('[name="isverif"]').val(self.attr('data-isverif'));
            $('[name="isverifadmin"]').val(self.attr('data-isverifadmin'));
            $('[name="keterangan"]').val(self.attr('data-keterangan'));
            $('#form_verifikasi').attr('data-id',self.attr('data-id'));
            $('#form_verifikasi').attr('data-page',self.attr('data-page'));
        }

        $('#form_verifikasi').on('submit',function(e){
            e.preventDefault();
            var btn_submit = $(this).find('button[type="submit"]');
            btn_submit.attr('disabled','disabled');
            btn_submit.html(`<i class="fas fa-spin fa-spinner"></i>`);
            var send_form = new FormData(this);
            send_form.append('_method', $(this).attr('method'));
            send_form.append('id', $(this).attr('data-id'));
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
                        $('#modal_verif').modal('hide');
                        getData($(this).attr('data-page'));
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
@endsection