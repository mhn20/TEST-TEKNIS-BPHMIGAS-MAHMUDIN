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
                <div class="card-body p-0  table-responsive">
                    <table class="table" id="table_data">
                        <thead>
                            <tr>
                                <th style="width: 10px">No.</th>
                                <th style="width: 10px" class="text-center">Action</th>
                                <th class="text-center">Images</th>
                                <th>Title</th>
                                <th>Description</th>
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
<div class="modal fade" id="form_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                <input type="text" name="description" class="form-control" maxlength="100" placeholder="Description" required>
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

        $('#btn_modal').on('click',function(){
            $('#exampleModalLabel').html(`<i class="fas fa-plus"></i> Add Data`);
            $('#form_modal').modal('show');
            $('#form_data').trigger('reset');
            $('#form_data').attr('method','POST');
            $('#form_data').attr('action',`{{ route('panel.sliders.postData') }}`);
            $('[name="images"]').attr('required','required');
            
            $('#images').removeAttr('src');
            $('[name="content"]').summernote('code',``);
        });

        function editData(self){
            $('#exampleModalLabel').html(`<i class="fas fa-pencil-alt"></i> Edit Data`);
            $('#form_modal').modal('show');
            $('#form_data').trigger('reset');
            $('#form_data').attr('method','PUT');
            $('#form_data').attr('action',`{{ route('panel.sliders.editData',-1) }}`.replace(-1,self.attr('data-id')));
            $('[name="title"]').val(self.attr('data-title'));
            $('[name="description"]').val(self.attr('data-description'));
            $('#images').attr('src',self.attr('data-images'));
            $('[name="images"]').removeAttr('required');
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

        getData();

        function getData(page=1){
            $('#paginate').html('');
            var table_data = $('#table_data > tbody');
            table_data.html(`
                <tr>
                <td style="width: 10px" class="text-center" colspan="5"><i class="fas fa-spin fa-spinner"></i> Loading</td>
                </tr>
            `);
            $.ajax({
                'url' : `{{ route('panel.sliders.data') }}`,
                'type' : 'GET',
                'data' : {
                'page' : page, 'search' : $('[name="table_search"]').val()
                },
                'success' : function(result){
                    if(result.data.length == 0){
                        table_data.html(`
                        <tr>
                            <td style="width: 10px" class="text-center" colspan="5">Data Tidak Ditemukan</td>
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
                                        data-title="${val['title']}"
                                        data-description="${val['description']}"
                                        data-images="${val['images']}"></i>
                                    </td>
                                    <td class="text-center">
                                        <a href="${val['images']}" data-toggle="lightbox" data-title="${val['title']}">
                                            <img src="${val['images']}" class="img-circle elevation-2 img-circle-custom" alt="${val['title']}"/>
                                        </a>
                                    </td>
                                    <td>${val['title']}</td>
                                    <td>${val['description']}</td>
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
                            <td style="width: 10px" class="text-center" colspan="5">Terjadi Kesalahan Sistem...</td>
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
                    'url' : `{{ route('panel.sliders.deleteData',-1) }}`.replace(-1,self.attr('data-id')),
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