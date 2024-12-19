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
                    <button class="btn btn-info btn-sm" id="btn_modal">
                        <i class="fas fa-plus"></i>
                        Add Data
                    </button>
                </h3>

                <div class="card-tools">
                    <div class="input-group input-group-sm" style="width: 100%;">
                        <input
                            type="text"
                            name="table_search"
                            class="form-control float-right"
                            placeholder="Search Email, Nama Composer, Alias, Composer ID, No Kontrak">

                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default" id="btn_search">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- /.card-header -->
                <div class="card-body p-0  table-responsive">
                    <table class="table table-bordered" id="table_data">
                        <thead>
                            <tr>
                                <th style="width: 10px">No.</th>
                                <th style="width: 10px" class="text-center">Action</th>
                                <th>Document</th>
                                <th>Email</th>
                                <th>Nama Composer</th>
                                <th>Alias</th>
                                <th class="text-center">Composer ID</th>
                                <th>No Kontrak</th>
                                <th>Periode</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                    <div class="text-center" id="paginate"></div>
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
<div class="modal fade" id="form_modal" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
            @if(session()->get('login_panel')['is_admin'])
                <div class="col-md-12 mt-2">
                    <label for="">
                        <b>
                            Pilih User
                        </b>
                    </label>
                    <select name="users_id" class="form-control select2bs4" required>
                        <option value="">Pilih User</option>
                        @foreach($dataset_user as $rowindex)
                        <option value="{{ $rowindex->id }}">{{ $rowindex->email }} {{ $rowindex->name?'| '.$rowindex->name:'' }} {{ $rowindex->alias?'| '.$rowindex->alias:'' }}</option>
                        @endforeach
                    </select>
                </div>
            @endif
            <div class="col-md-12 mt-2">
                <label for="">
                    <b>
                        Composer ID
                    </b>
                </label>
                <input type="text" name="composer_id" class="form-control remove_spasi" maxlength="30" placeholder="Composer ID" required>
            </div>
            <div class="col-md-12 mt-2">
                <label for="">
                    <b>
                        No Contract
                    </b>
                </label>
                <input type="text" name="no_kontrak" class="form-control remove_spasi" maxlength="30" placeholder="No Contract" required>
            </div>
            <div class="col-md-12 mt-2">
                <a href="/upload/users/sample/Form HYPE Publisher + Surat Kuasa(NEW FINAL).docx" class="btn btn-info btn-sm">
                    <i class="fas fa-upload"></i> Download Sample Dokumen Surat Kuasa
                </a>
            </div>
            <div class="col-md-12 mt-2">
                <div class="row">
                    <div class="col-md-6">
                        <label for="">
                            <b>
                                Bulan
                            </b>
                        </label>
                        <select name="bulan" class="form-control" required>
                            <option value="">Pilih Bulan</option>
                            <?php foreach($databulan as $rowindex){ ?>
                                <option value="{{ $rowindex['key'] }}">{{ $rowindex['value'] }}</option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="">
                            <b>
                                Tahun
                            </b>
                        </label>
                        <select name="tahun" class="form-control" required>
                            <?php foreach($datatahun as $rowindex){ ?>
                                <option value="{{ $rowindex['key'] }}">{{ $rowindex['key'] }}</option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-12 mt-2">
                <label for="">
                    <b>
                        Upload Dokumen Surat Kuasa
                    </b>
                </label>
                <input type="file" name="document" class="form-control" required>
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
            $('[name="composer_id"]').val(self.attr('data-composer_id'));
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

        getData();

        function getData(page=1){
            $('#paginate').html('');
            var table_data = $('#table_data > tbody');
            table_data.html(`
                <tr>
                <td style="width: 10px" class="text-center" colspan="10"><i class="fas fa-spin fa-spinner"></i> Loading</td>
                </tr>
            `);
            $.ajax({
                'url' : `{{ route('panel.document-contract.data') }}`,
                'type' : 'GET',
                'data' : {
                'page' : page, 'search' : $('[name="table_search"]').val(), 'users_search' : $('[name="users_search"]').val()
                },
                'success' : function(result){
                    if(result.data.length == 0){
                        table_data.html(`
                        <tr>
                            <td style="width: 10px" class="text-center" colspan="10">Data Tidak Ditemukan</td>
                        </tr>
                        `);
                    }else{
                        table_data.html('');
                        $.each(result.data,function(key,val){
                            table_data.append(`
                                <tr>
                                    <td style="width: 10px" class="text-center">${key+1}</td>
                                    <td style="width: 10px" class="text-center">
                                        <i class="fas fa-solid fa-trash text-danger cursor-pointer"
                                        onclick="deleteData($(this))"
                                        data-id="${val['id']}"></i>

                                        <i class="fas fa-solid fa-pencil-alt text-info cursor-pointer"
                                        onclick="editData($(this))"
                                        data-id="${val['id']}"
                                        data-users_id="${val['user']['id']}"
                                        data-composer_id="${val['composer_id']}"
                                        data-no_kontrak="${val['no_kontrak']}"
                                        data-bulan="${val['bulan']}"
                                        data-tahun="${val['tahun']}"
                                        data-document="${val['document']}"></i>
                                    </td>
                                    <td style="width: 10px" class="text-center">
                                        <a href="${val['document']}" target="_blank"><i class="fas fa-download"></i></a>
                                    </td>
                                    <td>${val['user']['email']?val['user']['email']:'-'}</td>
                                    <td>${val['user']['name']?val['user']['name']:'-'}</td>
                                    <td>${val['user']['alias']?val['user']['alias']:'-'}</td>
                                    <td class="text-center">${val['composer_id']}</td>
                                    <td>${val['no_kontrak']}</td>
                                    <td>${val['periode']}</td>
                                </tr>
                            `);
                        });
                    }

                    var total_page = parseInt(result.total)/parseInt(result.per_page);
                    var total_page = Math.ceil(total_page);

                    $('#paginate').html(`
                        <button class="btn btn-info btn-sm" onclick="getData(${parseInt(result.current_page)-1})" ${result.last_page_url==null?'disabled':''}>
                            <i class="fas fa-arrow-left"></i>
                        </button>
                        ${result.current_page}/${total_page} | Total Rows ${result.total}
                        <button class="btn btn-info btn-sm" onclick="getData(${parseInt(result.current_page)+1})" ${result.next_page_url==null?'disabled':''}>
                            <i class="fas fa-arrow-right"></i>
                        </button>
                    `);
                }, 'error' : function(err){
                    $('#paginate').html('');
                    table_data.html(`
                        <tr>
                            <td style="width: 10px" class="text-center" colspan="7">Terjadi Kesalahan Sistem...</td>
                        </tr>
                    `);
                }
            });
        }

        function deleteData(self){
            var konfirm = confirm('Hapus Data ?');
            if(konfirm == true){
                self.attr('disabled','disabled');
                self.html(`<i class="fas fa-spin fa-spinner"></i>`);
                $.ajax({
                    'url' : `{{ route('panel.document-contract.deleteData',-1) }}`.replace(-1,self.attr('data-id')),
                    'type' : 'delete',
                    'data' : {
                        '_token' : $('input[name="_token"]').val()
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
    </script>
@endsection