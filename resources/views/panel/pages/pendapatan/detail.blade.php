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
@if(@$datauser)
    <section class="content">
        <div class="container-fluid">
            <div class="card card-primary">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-12">
                            <h3 class="card-title">{{ $datauser->name?$datauser->name:'-' }}</h3>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-2">
                            <img src="{{ $datauser->avatar }}" class="img-fluid img-responsive" style="width:100%;" id="avatar">
                        </div>
                        <div class="col-md-10">
                            <div class="row">
                                <div class="col-md-6 mt-2">
                                    <b>Verifikasi Email : @if($datauser->isverif==1) <span class="text-success"><i class="ion-checkmark-circled"></i> Terverifikasi</span> @else <span class="text-danger"><i class="ion-close-circled"></i> Belum Terverifikasi</span> @endif</b>
                                </div>
                                <div class="col-md-6 mt-2">
                                    <b>Verifikasi Admin : @if($datauser->isverifadmin==1) <span class="text-success"><i class="ion-checkmark-circled"></i> Terverifikasi</span> @else <span class="text-danger"><i class="ion-close-circled"></i> Belum Terverifikasi</span> @endif</b>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="">
                                        <b>WORK ID</b>
                                    </label>
                                    <p style="margin-top: -13px;">
                                        @if(strlen($datauser->id) == 1)
                                            HYPE{{ '0'.$datauser->id }}
                                        @else
                                            HYPE{{ $datauser->id }}
                                        @endif
                                    </p>
                                </div>
                                <div class="col-md-6">
                                    <label for="">
                                        <b>Alias</b>
                                    </label>
                                    <p style="margin-top: -13px;">
                                        {{ $datauser->alias?$datauser->alias:'-' }}
                                    </p>
                                </div>
                                <div class="col-md-6">
                                    <label for="">
                                        <b>Email</b>
                                    </label>
                                    <p style="margin-top: -13px;">
                                        {{ $datauser->email?$datauser->email:'-' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <button type="button" class="btn btn-sm btn-info mb-2" id="btn_add">
            <i class="fas fa-plus"></i> Tambah Pendapatan
        </button>
        @if(session()->get('login_panel')['is_admin'] == 1)
        <button type="button" class="btn btn-sm btn-info mb-2 ml-2" id="btn_upload_csv">
            <i class="fas fa-file-csv"></i> Upload CSV
        </button>
        @endif
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title" id="label_periode">
                    {{ $periode }}
                </h3>

                <div class="card-tools">
                    <div class="input-group input-group-sm" style="width: 100%;">
                        <select name="bulan" class="form-control">
                            @foreach($select_bulan as $rowindex)
                                <option value="{{ $rowindex['key'] }}" <?= $rowindex['key']==substr(request()->get('tahunbulan',date('Ym')),4,2)?'selected':'' ?>>{{ $rowindex['val'] }}</option>
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
            <div class="p-2">
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
                <div class=" table-responsive">
                    <table class="table table-bordered" id="table_data">
                        <thead>
                            <tr>
                                <th style="width: 10px">No.</th>
                                <th class="text-center" style="width:50px;">Action</th>
                                @if(session()->get('login_panel')['is_admin'] == 1)
                                <th class="text-right">Total Gross Royalti</th>
                                <th class="text-center">Management Fee Percent</th>
                                <th class="text-center">Management Fee</th>
                                @endif
                                <th class="text-right">Gross Royalti</th>
                                <th class="text-center">PPH23 Percent</th>
                                <th class="text-right">PPH23</th>
                                <th class="text-center">NPPN Percent</th>
                                <th class="text-right">NPPN</th>
                                <th class="text-right">Total NET Royalti</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                    <div class="text-right mb-2 paginate"></div>
                </div>
            </div>
            <!-- /.card-body -->
            <!-- /.card -->
        </div>
    </div>
</section>
<form action="{{ route('panel.pendapatan.postData') }}" method="post" enctype="multipart/form-data" id="form_add">
    {{ csrf_field() }}
    <!-- Modal -->
    <div class="modal fade" id="modal_add" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel"><i class="fas fa-check-circle"></i> Tambah Pendapatan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <label for="">
                            <b>Nilai Pendapatan</b>
                        </label>
                        <div class="input-group input-group-sm" style="width:100%;">
                            <input
                                type="text"
                                name="total_gross_royalti"
                                class="form-control"
                                value=""
                                placeholder="Total Gross Royalti"  oninput="formatNumber(this)">
                            ,
                            <input
                                type="number"
                                name="pembulat"
                                class="form-control"
                                value="00"
                                placeholder="Total Gross Royalti">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger mr-auto" data-dismiss="modal"><i class="ion-close-circled"></i> Close</button>
                <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Simpan</button>
            </div>
            </div>
        </div>
    </div>
</form>
<!-- /.content -->
 
<form action="{{ route('panel.pendapatan.uploadCSV') }}" method="post" enctype="multipart/form-data" id="form_upload_csv">
    {{ csrf_field() }}
    <!-- Modal -->
    <div class="modal fade" id="modal_upload_csv" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel"><i class="fas fa-file-csv"></i> Upload CSV</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-success">
                            <b>
                                Silahkan Download Terlebih Dahulu Format CSV yang Telah Disediakan >> 
                                <a href="/upload/csv/REVENUE_REPORT_sampel.csv" class="btn btn-xs btn-danger"><i class="fas fa-download"></i> Download</a>
                            </b>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label for="">
                            <b>Dokumen CSV</b>
                        </label>
                        <input type="file" required name="dokumen_csv" accept=".csv" class="form-control">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger mr-auto" data-dismiss="modal"><i class="ion-close-circled"></i> Close</button>
                <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Simpan</button>
            </div>
            </div>
        </div>
    </div>
</form>


<form action="{{ route('panel.pendapatan.uploadDokumenPPH23', -1) }}" method="put" enctype="multipart/form-data" id="form_upload_dokumen_pph23">
    {{ csrf_field() }}
    <!-- Modal -->
    <div class="modal fade" id="modal_upload_dokumen_pph23" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel"><i class="fas fa-file-csv"></i> Upload Dokumen Pajak</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <label for="">
                            <b>Dokumen Pajak</b>
                        </label>
                        <input type="file" required name="dokumen_pph23" accept="image/*,.pdf" class="form-control">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger mr-auto" data-dismiss="modal"><i class="ion-close-circled"></i> Close</button>
                <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Simpan</button>
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

        function formatNumber(input) {
            // Menghapus karakter selain angka
            let value = input.value.replace(/[^0-9]/g, '');

            // Menambahkan titik sebagai pemisah ribuan
            input.value = value.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        }

        $('#btn_add').on('click',function(){
            $('#modal_add').modal('show');
        });

        $('#btn_upload_csv').on('click',function(){
            $('#modal_upload_csv').modal('show');
        });

        function uploadDokumenPPH23(self){
            $('#modal_upload_dokumen_pph23').modal('show');
            $('#form_upload_dokumen_pph23').attr('data-id',self.attr('data-id'));
        }

        function inputpercent(self){
            if(parseInt(self.val()) >100){
                self.val(100);
            }
        }

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

        $('#form_add').on('submit',function(e){
            e.preventDefault();
            var btn_submit = $(this).find('button[type="submit"]');
            btn_submit.attr('disabled','disabled');
            btn_submit.html(`<i class="fas fa-spin fa-spinner"></i>`);
            var send_form = new FormData(this);
            send_form.append('_method', $(this).attr('method'));
            send_form.append('users_id', `{{ $users_id }}`);
            send_form.append('tahunbulan', $('[name="tahun"]').val()+$('[name="bulan"]').val());
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
                    if(result.status == '200'){
                        $('#modal_add').modal('hide');
                        getData(1);
                    }
                    alertToatstr(result.status,result.messages);
                },
                error:function(err){
                    btn_submit.removeAttr('disabled');
                    btn_submit.html(`<i class="fas fa-save"></i> Simpan`);
                    alertToatstr(500,'Error Sistem');
                }
            });
        });

        $('#form_upload_csv').on('submit',function(e){
            e.preventDefault();
            var btn_submit = $(this).find('button[type="submit"]');
            btn_submit.attr('disabled','disabled');
            btn_submit.html(`<i class="fas fa-spin fa-spinner"></i>`);
            var send_form = new FormData(this);
            send_form.append('_method', $(this).attr('method'));
            send_form.append('users_id', `{{ $users_id }}`);
            send_form.append('tahunbulan', $('[name="tahun"]').val()+$('[name="bulan"]').val());
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
                    if(result.status == '200'){
                        $('#modal_upload_csv').modal('hide');
                        getData(1);
                    }
                    alertToatstr(result.status,result.messages);
                },
                error:function(err){
                    btn_submit.removeAttr('disabled');
                    btn_submit.html(`<i class="fas fa-save"></i> Simpan`);
                    alertToatstr(500,'Error Sistem');
                }
            });
        });

        $('#form_upload_dokumen_pph23').on('submit',function(e){
            e.preventDefault();
            var btn_submit = $(this).find('button[type="submit"]');
            btn_submit.attr('disabled','disabled');
            btn_submit.html(`<i class="fas fa-spin fa-spinner"></i>`);
            var send_form = new FormData(this);
            send_form.append('_method', $(this).attr('method'));
            send_form.append('users_id', `{{ $users_id }}`);
            send_form.append('tahunbulan', $('[name="tahun"]').val()+$('[name="bulan"]').val());
            $.ajax({
                method:'POST',
                processData: false,
                contentType: false,
                cache: false,
                url: $(this).attr('action').replaceAll('-1',$(this).attr('data-id')),
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: send_form,
                success:function(result){
                    btn_submit.removeAttr('disabled');
                    btn_submit.html(`<i class="fas fa-save"></i> Simpan`);
                    if(result.status == '200'){
                        $('#modal_upload_dokumen_pph23').modal('hide');
                        getData($(this).attr('data-page'));
                    }
                    alertToatstr(result.status,result.messages);
                },
                error:function(err){
                    btn_submit.removeAttr('disabled');
                    btn_submit.html(`<i class="fas fa-save"></i> Simpan`);
                    alertToatstr(500,'Error Sistem');
                }
            });
        });

        $('document').ready(function(){
            $('#summernote').summernote();
        });

        $.each(['[name="orderby"]',`[name="bulan"]`,`[name="tahun"]`,`[name="komposisi"]`],function(key,val){
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
                'url' : `{{ route('panel.pendapatan.dataDetailComposer') }}`,
                'type' : 'GET',
                'data' : {
                    'limit' : $(`select[name="limit"]`).val(),  'page' : page, 
                    'users_id' : `{{ $users_id }}`,
                    'tahunbulan' : $('[name="tahun"]').val()+$('[name="bulan"]').val(), 
                    'orderby' : $('[name="orderby"]').val(), 
                    'komposisi' : $('[name="komposisi"]').val()
                },
                'success' : function(result){
                    $('#label_periode').html(result.label_periode);
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
                                            <div class="col-6">
                                                <i class="fas fa-solid fa-trash cursor-pointer text-danger" 
                                                    title="Hapus Data" 
                                                    onclick="deleteData($(this))"
                                                    data-id="${val['id']}"></i>
                                            </div>
                                            <div class="col-6" ${is_admin!=1?`style="display:none;"`:``}>
                                                <i class="fas fa-upload cursor-pointer text-info" 
                                                    title="Upload Bukti Pajak" 
                                                    onclick="uploadDokumenPPH23($(this))"
                                                    data-id="${val['id']}"
                                                    data-page="${page}"></i>
                                            </div>
                                            <div class="col-6" ${!val['dokumen_pph23']?'style="display:none;"':''}>
                                                <i class="fas fa-paste cursor-pointer text-info" 
                                                    title="Download Bukti Pajak" 
                                                    onclick="window.open('${val['dokumen_pph23']}')"></i>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-right" ${is_admin!=1?`style="display:none;"`:``}>${val['total_gross_royalti']?formatRupiah(val['total_gross_royalti']):'-'}</td>
                                    <td class="text-center" ${is_admin!=1?`style="display:none;"`:``}>
                                        <span ${is_admin==1?`style="display:none;"`:``}>${val['management_fee_percent']?val['management_fee_percent']:0}%</span>
                                        <div class="input-group input-group-sm" style="width: 200px;${is_admin!=1?`display:none;"`:``}">
                                            <input
                                                type="number"
                                                name="management_fee_percent_${val['id']}"
                                                class="form-control float-right" oninput="inputpercent($(this))" value="${val['management_fee_percent']?val['management_fee_percent']:0}" maxlength="3">
                                                <div class="input-group-append">
                                                    <button type="submit" class="btn btn-success" onclick="updatePercent($(this))" data-id="${val['id']}" data-page="${page}">
                                                        <i class="fas fa-save"></i> Simpan
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-right" ${is_admin!=1?`style="display:none;"`:``}>${val['management_fee']?formatRupiah(val['management_fee']):'-'}</td>
                                    <td class="text-right">${val['gross_royalti']?formatRupiah(val['gross_royalti']):'-'}</td>
                                    <td class="text-center">
                                        <span ${is_admin==1?`style="display:none;"`:``}>${val['pph23_percent']?val['pph23_percent']:0}%</span>
                                        <div class="input-group input-group-sm" style="width: 200px;${is_admin!=1?`display:none;"`:``}">
                                            <input
                                                type="number"
                                                name="pph23_percent_${val['id']}"
                                                class="form-control float-right" oninput="inputpercent($(this))" value="${val['pph23_percent']?val['pph23_percent']:0}" maxlength="3">
                                                <div class="input-group-append">
                                                    <button type="submit" class="btn btn-success" onclick="updatePercent($(this))" data-id="${val['id']}" data-page="${page}">
                                                        <i class="fas fa-save"></i> Simpan
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-right">${val['pph23']?formatRupiah(val['pph23']):'-'}</td>
                                    <td class="text-center">
                                        <span ${is_admin==1?`style="display:none;"`:``}>${val['nppn_percent']?val['nppn_percent']:0}%</span>
                                        <div class="input-group input-group-sm" style="width: 200px;${is_admin!=1?`display:none;"`:``}" >
                                            <input
                                                type="number"
                                                name="nppn_percent_${val['id']}"
                                                class="form-control float-right" oninput="inputpercent($(this))" value="${val['nppn_percent']?val['nppn_percent']:0}" maxlength="3">
                                                <div class="input-group-append">
                                                    <button type="submit" class="btn btn-success" onclick="updatePercent($(this))" data-id="${val['id']}" data-page="${page}">
                                                        <i class="fas fa-save"></i> Simpan
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
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
                    $('#label_periode').html('Terjadi Kesalahan Sistem');
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


        

        function updatePercent(self){
            self.attr('disabled','disabled');
            self.html(`<i class="fas fa-spin fa-spinner"></i> Loading..`);
            var management_fee_percent = $(`[name="management_fee_percent_${self.attr('data-id')}"]`).val();
            var pph23_percent = $(`[name="pph23_percent_${self.attr('data-id')}"]`).val();
            var nppn_percent = $(`[name="nppn_percent_${self.attr('data-id')}"]`).val();
            $.ajax({
                'url' : `{{ route('panel.pendapatan.updatePercent',-1) }}`.replace(-1,self.attr('data-id')),
                'type' : 'POST', 
                'data' : {
                    '_token' : `{{ csrf_token() }}`,
                    '_method' : 'put',
                    'management_fee_percent' : management_fee_percent,
                    'pph23_percent' : pph23_percent,
                    'nppn_percent' : nppn_percent
                },
                'success' : function(result){
                    self.removeAttr('disabled');
                    self.html(`<i class="fas fa-save"></i> Simpan`);
                    alertToatstr(result.status,result.messages);
                    if(result.status == 200){
                        getData(self.attr('data-page'));
                    }
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
                    'url' : `{{ route('panel.pendapatan.deleteData',-1) }}`.replace(-1,self.attr('data-id')),
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