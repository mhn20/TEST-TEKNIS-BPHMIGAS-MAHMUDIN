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
        .cursor-pointer{
            cursor: pointer;
        }

        .table_composer tbody tr td{
            padding-top:5px;
            padding-bottom:5px;
            font-size:18px;
        }
        .table_composer tbody tr{
            border-bottom:1px dashed #ddd;
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
        @if(@$datauser)
        <a href="/panel/asset" class="btn btn-danger btn-sm mb-2">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
        <section class="content">
            
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
            
        </section>
        @endif
    </div>
    <div class="container-fluid">
        
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">
                    <a class="btn btn-primary btn-sm" href="?action=tambah&users_id={{ request()->get('users_id') }}">
                        <i class="fas fa-plus"></i>
                        Add Data
                    </a>
                </h3>

                <div class="card-tools">
                    <div class="input-group input-group-sm" style="width: 150px;">
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
                <div class="card-body p-0 ">
                    
                    <div class="table-responsive p-2">
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
                                    <th style="width: 10px">No.</th>
                                    <th style="width: 70px" class="text-center">Action</th>
                                    @if(session()->get('login_panel')['is_admin'])
                                    <th style="width:10%;">PGT Asset ID</th>
                                    @endif
                                    <th class="text-center">Work ID</th>
                                    <th class="text-center">Judul Lagu</th>
                                    <th class="text-center">Notasi</th>
                                    <th class="text-center">Lirik</th>
                                    <th class="text-center">Artis/Penyanyi</th>
                                    <th class="text-center">ISRC</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                        <div class="text-right mb-2 paginate"></div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
</section>
<!-- Modal -->
<form  entype="multipart/form-data" id="form_data">
{{ csrf_field() }}
<div class="modal fade" id="form_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body overflowheight">
        <div class="row">
            <div class="col-md-12">
                <label for="">
                    <b>
                        Images
                    </b>
                </label>
                <br>
                <img src="" class="img-fluid mt-2" id="images" style="width:100px;">
                <input type="file" name="images" class="form-control">
            </div>
            <div class="col-md-12 mt-2">
                <label for="">
                    <b>
                        Title
                    </b>
                </label>
                <input type="text" name="title" class="form-control" maxlength="100" placeholder="Title" required>
            </div>
            <div class="col-md-12 mt-2">
                <label for="">
                    <b>
                        Description
                    </b>
                </label>
                <input type="text" name="description" class="form-control" maxlength="255" placeholder="Description" required>
            </div>
            <div class="col-md-12 mt-2">
                <label for="">
                    <b>
                        Content
                    </b>
                </label>
                <textarea id="summernote" name="content"></textarea>
            </div>
            <div class="col-md-12 mt-2">
                <label for="">
                    <b>
                        Publisher
                    </b>
                </label>
                <input type="text" name="publisher" class="form-control" maxlength="255" placeholder="Publisher" value="{{ strtoupper(session()->get('login_panel')['name']) }}" required>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success">Save</button>
      </div>
    </div>
  </div>
</div>
</form>
<!-- /.content -->
@endsection
@section('js')
    <script>
        
        let is_admin = `{{ session()->get('login_panel')['is_admin'] }}`;

        $('#btn_modal').on('click',function(){
            $('#exampleModalLabel').html(`<i class="fas fa-plus"></i> Add Data`);
            $('#form_modal').modal('show');
            $('#form_data').trigger('reset');
            $('#form_data').attr('method','POST');
            $('#form_data').attr('action',`{{ route('panel.articles.postData') }}`);
            $('[name="images"]').attr('required','required');
            
            $('#images').removeAttr('src');
            $('[name="content"]').summernote('code',``);
        });

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

        $('[name="orderby"]').on('change',function(){
            getData();
        });

        getData();

        function getData(page=1){
            $('.paginate').html('');
            var table_data = $('#table_data > tbody');
            table_data.html(`
                <tr>
                    <td style="width: 10px" class="text-center" colspan="12"><i class="fas fa-spin fa-spinner"></i> Loading</td>
                </tr>
            `);
            $.ajax({
                'url' : `{{ route('panel.asset.data') }}`,
                'type' : 'GET',
                'data' : {
                    'limit' : $(`select[name="limit"]`).val(), 'page' : page, 'search' : $('[name="table_search"]').val(), 'users_id' : `{{ request()->get('users_id') }}`, 
                    'orderby' : $('[name="orderby"]').val()
                },
                'success' : function(result){
                    if(result.data.length == 0){
                        table_data.html(`
                            <tr>
                                <td style="width: 10px" class="text-center" colspan="12">Data Tidak Ditemukan</td>
                            </tr>
                        `);
                    }else{
                        table_data.html('');
                        $.each(result.data,function(key,val){
                            table_data.append(`
                                <tr>
                                    <td style="width: 10px" class="text-center">${key+1}</td>
                                    <td style="width: 70px" class="text-center">
                                        <i class="fas fa-solid fa-trash text-danger cursor-pointer" title="Hapus Asset"
                                        onclick="deleteData($(this))" ${is_admin!='1'?`style="display:none;"`:``}
                                        data-id="${val['id']}"></i>

                                        <i class="fas fa-clipboard-list text-info cursor-pointer" title="Preview Asset"
                                        onclick="location='?action=preview&id=${val['id']}&users_id={{ request()->get('users_id') }}'"></i>
                                    </td>
                                    <td style="white-space:nowrap;${is_admin!=1?`display:none;`:''}">
                                        <div class="input-group input-group-sm" style="width: 200px;">
                                            <input
                                                type="text"
                                                name="pragita_asset_id_${val['id']}"
                                                class="form-control float-right" value="${val['pragita_asset_id']?val['pragita_asset_id']:'-'}" maxlength="30">
                                                <div class="input-group-append">
                                                    <button type="submit" class="btn btn-success" onclick="updatePragitaAssetID($(this))" data-id="${val['id']}">
                                                        <i class="fas fa-save"></i> Simpan
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">${val['work_id']}</td>
                                    <td>${val['title']}</td>
                                    <td class="text-center"><b>${val['notasi']?'<i class="far fa-check-circle text-success"></i>':'<i class="far fa-times-circle text-danger"></i>'}</b></td>
                                    <td class="text-center"><b>${val['lirik']?'<i class="far fa-check-circle text-success"></i>':'<i class="far fa-times-circle text-danger"></i>'}</b></td>
                                    <td>${val['performer']}</td>
                                    <td>${val['isrc']}</td>
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
                            <td style="width: 10px" class="text-center" colspan="12">Terjadi Kesalahan Sistem...</td>
                        </tr>
                    `);
                }
            });
        }

        function updatePragitaAssetID(self){
            self.attr('disabled','disabled');
            self.html(`<i class="fas fa-spin fa-spinner"></i> Loading..`);
            $.ajax({
                'url' : `{{ route('panel.asset.updatePragitaAssetID',-1) }}`.replace(-1,self.attr('data-id')),
                'type' : 'POST', 
                'data' : {
                    '_token' : `{{ csrf_token() }}`,
                    'pragita_asset_id' : $(`[name="pragita_asset_id_${self.attr('data-id')}"]`).val()
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
                    'url' : `{{ route('panel.asset.deleteData',-1) }}`.replace(-1,self.attr('data-id')),
                    'type' : 'delete',
                    'data' : {
                        '_token' : $('input[name="_token"]').val()
                    },
                    'success' : function(result){
                        self.removeAttr('disabled');
                        self.html(``);
                        alertToatstr(result.status,result.messages);
                        getData(1);
                    },
                    'error':function(err){
                        self.removeAttr('disabled');
                        self.html(``);
                        alertToatstr(500,'Error Sistem');
                    }
                })
            }
        }
    </script>
@endsection