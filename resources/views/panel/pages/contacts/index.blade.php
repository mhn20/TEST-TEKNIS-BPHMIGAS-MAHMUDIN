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
                    List Data
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
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Keterangan</th>
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
<!-- /.content -->
@endsection
@section('js')
    <script>

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
                'url' : `{{ route('panel.contacts.data') }}`,
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
                                    </td>
                                    <td>${val['nama']}</td>
                                    <td>
                                        ${val['email']}
                                    </td>
                                    <td>
                                        ${val['keterangan']}
                                    </td>
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
                    'url' : `{{ route('panel.contacts.deleteData',-1) }}`.replace(-1,self.attr('data-id')),
                    'headers': {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    'type' : 'post',
                    'data' : {
                        '_method': 'DELETE',
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