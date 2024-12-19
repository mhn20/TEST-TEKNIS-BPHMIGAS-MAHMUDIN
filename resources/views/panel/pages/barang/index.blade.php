@extends('panel.base')
@section('css')
  <style>
    .cursor-pointer{
      cursor: pointer;
    }
    .img-circle-custom{
        height: 50px;
        width: 50px;
    }
  </style>
@endsection
@section('contents')
<?php date_default_timezone_set('Asia/Jakarta'); ?>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">{{ $page_title }}</h1>
            </div>
            <!-- /.col -->
            <!-- <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="/panel/dashboard">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">Data Website</li>
                </ol>
            </div> -->
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
            <div class="">
              <div class="card-header">
                <h3 class="card-title">
                    @if(session()->get('login_panel')['level'] == 'admin')
                    <button class="btn btn-info btn-sm" id="btn_modal">
                        <i class="fas fa-plus"></i> Add Data
                    </button>

                    <button class="btn btn-info btn-sm ml-2" id="btn_modal_excel">
                        <i class="fas fa-file-excel"></i> Upload Excel
                    </button>
                    @else
                    {{ session()->get('login_panel')['name'] }}
                    @endif
                </h3>
                <div class="card-tools">
                    <div class="input-group input-group-sm" style="width: 200px;">
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
              <div class="card-body p-0 table-responsive p-2">
                <table class="table table-bordered" id="table_data">
                  <thead>
                    <tr>
                      <th style="width: 10px">No.</th>
                      @if(session()->get('login_panel')['level'] == 'admin')
                      <th style="width: 10px">Action</th>
                      @endif
                      <th>Images</th>
                      <th>SKU</th>
                      <th>Nama Barang</th>
                      <th>Stok</th>
                      <th>Harga</th>
                      <th>Berat (Gram)</th>
                      <th>Diskon %</th>
                    </tr>
                  </thead>
                  <tbody>
                    
                  </tbody>
                </table>
                
                <div class="text-right" id="paginate"></div>
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
  <div class="modal-dialog">
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
            <input type="file" name="images" class="form-control" placeholder="images">
          </div>
          <div class="col-md-12 mt-2">
            <label for="">
              <b>
                SKU
              </b>
            </label>
            <input type="text" name="sku" class="form-control" maxlength="50" placeholder="SKU" required>
          </div>
          <div class="col-md-12 mt-2">
            <label for="">
              <b>
                Nama Barang
              </b>
            </label>
            <input type="text" name="nmbarang" class="form-control" maxlength="100" placeholder="Nama Barang" required>
          </div>
          <div class="col-md-12 mt-2">
            <label for="">
              <b>
                Stok
              </b>
            </label>
            <input type="number" name="stok" class="form-control" placeholder="Stok" required>
          </div>
          <div class="col-md-12 mt-2">
            <label for="">
              <b>
                Harga
              </b>
            </label>
            <input type="text" name="harga" class="form-control" placeholder="Harga" required oninput="formatNumber(this)">
          </div>
          <div class="col-md-12 mt-2">
            <label for="">
              <b>
                Berat (Gram)
              </b>
            </label>
            <input type="number" name="berat" class="form-control" placeholder="Berat (Gram)" required>
          </div>
          <div class="col-md-12 mt-2">
            <label for="">
              <b>
                Diskon (%)
              </b>
            </label>
            <input type="number" name="diskon_percent" class="form-control" placeholder="Diskon (%)" required>
          </div>
          <div class="col-md-12 mt-2">
            <label for="">
              <b>
                Deskripsi
              </b>
            </label>
            <textarea name="deskripsi" class="form-control" required></textarea>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Simpan</button>
      </div>
    </div>
  </div>
</div>
</form>



<form action="{{ route('panel.barang.uploadDataExcel') }}" method="post" enctype="multipart/form-data" id="form_upload_excel">
    {{ csrf_field() }}
    <!-- Modal -->
    <div class="modal fade" id="modal_upload_excel" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel"><i class="fas fa-file-excel"></i> Upload Excel</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-info">
                            <b>
                                Silahkan Download Terlebih Dahulu Format Excel yang Telah Disediakan 
                                <a href="/upload/barang/sample/format_upload.csv" class="btn btn-xs btn-primary float-right"><i class="fas fa-download"></i> Download</a>
                            </b>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label for="">
                            <b>Dokumen Excel</b>
                        </label>
                        <input type="file" required name="document_excel" accept=".csv" class="form-control">
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
@endsection

@section('js')
  <script>
    var sess_level = `{{ session()->get('login_panel')['level'] }}`;

    $('input[name="max_clock_in_time"]').datetimepicker({
      format:'HH:mm:ss'
    });

    $('input[name="max_clock_out_time"]').datetimepicker({
      format:'HH:mm:ss'
    });


    $(`[name="table_search"]`).on('change',function(){
        getData();
    });

    $(`[name="btn_search"]`).on('click',function(){
        getData();
    });

    $('#btn_modal').on('click',function(){
      $('#exampleModalLabel').html(`<i class="fas fa-plus"></i> Add Data`);
      $('#form_modal').modal('show');
      $('#form_data').trigger('reset');
      $('#form_data').attr('method','post');
      $('#form_data').attr('action',`{{ route('panel.barang.postData') }}`);
    });

    $('#btn_modal_excel').on('click',function(){
      $('#modal_upload_excel').modal('show');
    });

    function editData(self){
      $('#exampleModalLabel').html(`<i class="fas fa-pencil-alt"></i> Edit Data`);
      $('#form_data').attr('action',`{{ route('panel.barang.editData',-1) }}`.replaceAll(-1,self.attr('data-id')));
      $('#form_modal').modal('show');
      $('#form_data').trigger('reset');
      $('#form_data').attr('method','put');
      $(`[name="sku"]`).val(self.attr('data-sku'));
      $(`[name="nmbarang"]`).val(self.attr('data-nmbarang')); 
      $(`[name="stok"]`).val(self.attr('data-stok')); 
      $(`[name="harga"]`).val(formatRupiah(self.attr('data-harga'))); 
      $(`[name="berat"]`).val(self.attr('data-berat')); 
      $(`[name="diskon_percent"]`).val(self.attr('data-diskon_percent'));
      $(`[name="deskripsi"]`).val(self.attr('data-deskripsi'));
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
                btn_submit.html(`<i class="fas fa-save"></i> Simpan`);
                if(result.status==200){
                  $('#form_modal').modal('hide');
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

    $('#form_upload_excel').on('submit',function(e){
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
                  $('#modal_upload_excel').modal('hide');
                  $('#form_upload_excel').trigger('reset');
                }
                alertToatstr(result.status,result.messages);
                getData();
            },
            error:function(err){
                btn_submit.removeAttr('disabled');
                btn_submit.html(`<i class="fas fa-save"></i> Simpan`);
                alertToatstr(500,'Error Sistem');
                $('#form_upload_excel').trigger('reset');
            }
        });
    });

    getData();

    function getData(page=1){
      var table_data = $('#table_data > tbody');
      table_data.html(`
        <tr>
          <td style="width: 10px" class="text-center" colspan="11"><i class="fas fa-spin fa-spinner"></i> Loading</td>
        </tr>
      `);
      $.ajax({
        'url' : `{{ route('panel.barang.data') }}`,
        'type' : 'GET',
        'data' : {
          'page' : page, 'search' : $('[name="table_search"]').val()
        },
        'success' : function(result){
          if(result.data.length == 0){
            table_data.html(`
              <tr>
                <td style="width: 10px" class="text-center" colspan="11">Data Tidak Ditemukan</td>
              </tr>
            `);
            
            $('#paginate').html('');
          }else{
            table_data.html('');
            $.each(result.data,function(key,val){
              table_data.append(`
                <tr>
                  <td style="width: 10px" class="text-center">${key+1}</td>
                  <td style="width: 10px;${sess_level!='admin'?'display:none;':''}" class="text-center">
                    <i class="fas fa-solid fa-trash text-danger cursor-pointer"
                      onclick="deleteData($(this))"
                      data-id="${val['id']}"></i>
                    <i class="fas fa-solid fa-pencil-alt text-info cursor-pointer"
                      onclick="editData($(this))"
                      data-id="${val['id']}"
                      data-sku="${val['sku']}"
                      data-nmbarang="${val['nmbarang']}" 
                      data-stok="${val['stok']}" 
                      data-harga="${val['harga']}" 
                      data-berat="${val['berat']}" 
                      data-diskon_percent="${val['diskon_percent']}"
                      data-deskripsi="${val['deskripsi']}">
                  </td>
                  <td class="text-center">
                    <img src="${val['images']}" class="img-fluid img-circle-custom">
                  </td>
                  <td>${val['sku']}</td>
                  <td>${val['nmbarang']}</td>
                  <td class="text-center">${val['stok']}</td>
                  <td class="text-right">${formatRupiah(val['harga'])}</td>
                  <td class="text-center">${val['berat']}</td>
                  <td class="text-center">${val['diskon_percent']}</td>
                </tr>
              `);
            });
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
          }
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
          'url' : `{{ route('panel.barang.deleteData',-1) }}`.replaceAll(-1,self.attr('data-id')),
          'type' : 'delete',
          'data' : {
            '_token' : $('input[name="_token"]').val()
          },
          'success' : function(result){
            self.removeAttr('disabled');
            self.html(``);
            alertToatstr(result.status,result.messages);
            getData();
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