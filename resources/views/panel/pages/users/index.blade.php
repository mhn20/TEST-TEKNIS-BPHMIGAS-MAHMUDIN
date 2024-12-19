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
                    <a href="/panel/users/?action=tambah" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i>
                        Add Data
                    </a>
                </h3>

                <div class="card-tools">
                    <div class="input-group input-group-sm" style="width: 100%;">
                        <input
                            type="text"
                            name="table_search"
                            class="form-control float-right"
                            placeholder="Search">

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
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-3">
                                    <select name="limit" class="form-control mt-2 mb-2" onchange="getData()">
                                        <option value="10">10</option>
                                        <option value="25">25</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <select name="orderby" class="form-control mt-2 mb-2">
                                        <option value="terbaru">Urutan Terbaru</option>
                                        <option value="terlama">Urutan Terlama</option>
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
                                <th style="width: 10px" rowspan="2">No.</th>
                                <th class="text-center" style="width:50px;" rowspan="2">Action</th>
                                <th style="width:10%;" rowspan="2">Work ID</th>
                                <th rowspan="2">Nama Composer</th>
                                <th rowspan="2">Alias</th>
                                <th style="width:10%;" rowspan="2">PGT Composer ID</th>
                                <th rowspan="2">Email</th>
                                <th class="text-center" colspan="2">
                                    Verifikasi
                                </th>
                                <th rowspan="2" class="text-center">Total Asset</th> 
                            </tr>
                            <tr>
                                <th class="text-center" style="width:50px;">Email</th>
                                <th class="text-center" style="width:50px;">Admin</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                    <div class="text-right mb-2 paginate"></div>
                </div>
                <!-- /.card-body -->
            </div>
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

        $(`[name="table_search"]`).on('change',function(){
            getData();
        });
        $(`[name="users_search"]`).on('change',function(){
            getData();
        });

        $('[name="orderby"]').on('change',function(){
            getData();
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
                'url' : `{{ route('panel.users.data') }}`,
                'type' : 'GET',
                'data' : {
                    'limit' : $(`select[name="limit"]`).val(),  'page' : page, 
                    'search' : $('[name="table_search"]').val(), 
                    'users_search' : $('[name="users_search"]').val(), 
                    'orderby' : $('[name="orderby"]').val()
                },
                'success' : function(result){
                    if(result.data.length == 0){
                        table_data.html(`
                        <tr>
                            <td style="width: 10px" class="text-center" colspan="18">Data Tidak Ditemukan</td>
                        </tr>
                        `);
                    }else{
                        table_data.html('');
                        $.each(result.data,function(key,val){
                            table_data.append(`
                                <tr>
                                    <td style="width: 10px" class="text-center">${key+1}.</td>
                                    <td class="text-center">
                                        <div class="row">
                                            <div class="col-6">
                                                <i class="fas fa-trash text-danger cursor-pointer" title="Hapus Composer"
                                                    onclick="deleteData($(this))" data-id="${val['id']}"></i>
                                            </div>
                                            <div class="col-6">
                                                <i class="fas fa-clipboard-list text-primary cursor-pointer" title="Edit Composer"
                                                    onclick="location='/panel/users?action=preview&users_id=${val['id']}'"></i>
                                            </div>
                                            <div class="col-6">
                                                <i class="fas fa-music text-primary cursor-pointer" title="Data Asset"
                                                    onclick="location='/panel/asset?users_id=${val['id']}'"></i>
                                            </div>
                                            <div class="col-6">
                                                <i class="nav-icon fas fa-file-contract cursor-pointer text-info" title="Download Kontrak"
                                                onclick="window.open('{{ route('panel.myprofile.download') }}?users_id=${val['id']}')"></i>
                                            </div>
                                            <div class="col-6">
                                                <i class="fas fa-check-circle text-primary cursor-pointer" title="Verifikasi Composer"
                                                    data-id="${val['id']}" data-name="${val['name']}" data-alias="${val['alias']}"
                                                    data-isverif="${val['isverif']}" data-isverifadmin="${val['isverifadmin']}" data-keterangan="${val['keterangan']?val['keterangan']:''}"
                                                    data-page="${page}"
                                                    onclick="verifikasi($(this))"></i>
                                            </div>
                                        </div>
                                    </td>
                                    <td>${val['work_id']?val['work_id']:'-'}</td>
                                    <td>${val['name']?val['name']:'-'}</td>
                                    <td>${val['alias']?val['alias']:'-'}</td>

                                    <td style="white-space:nowrap;">
                                        <div class="input-group input-group-sm" style="width: 200px;">
                                            <input
                                                type="text"
                                                name="pragita_composer_id_${val['id']}"
                                                class="form-control float-right" value="${val['pragita_composer_id']?val['pragita_composer_id']:'-'}" maxlength="30">
                                                <div class="input-group-append">
                                                    <button type="submit" class="btn btn-success" onclick="updatePragitaComposerID($(this))" data-id="${val['id']}">
                                                        <i class="fas fa-save"></i> Simpan
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    
                                    <td>${val['email']?val['email']:'-'}</td>
                                    <td class="text-center">
                                        ${val['isverif']=='1'?'<span style="color:green;"><i class="fas fa-check"></i></span>':'<span style="color:red;"><i class="ion-close-circled"></i></span></span>'}
                                    </td>
                                    <td class="text-center">
                                        ${val['isverifadmin']=='1'?'<span style="color:green;"><i class="fas fa-check"></i></span>':'<span style="color:red;"><i class="ion-close-circled"></i></span></span>'}
                                    </td>
                                    <td class="text-center">${val['total_aset']}</td> 
                                </tr>
                            `);
                        });
                    }

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