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
                  Table {{ $page_title }}
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
                      <th style="width: 10px">Action</th>
                      <th>No Invoice</th>
                      <th>Status</th>
                      <th>Email</th>
                      <th>Nama</th>
                      <th>Negara</th>
                      <th>Kota</th>
                      <th>Kecamatan</th>
                      <th>Kelurahan</th>
                      <th>Alamat</th>
                      <th>Jumlah Item</th>
                      <th>Subtotal</th>
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



<form  entype="multipart/form-data"  method="put"action="{{ route('panel.invoice.verifikasi',-1) }}" id="form_csl1">
{{ csrf_field() }}
<div class="modal fade" id="modal_csl1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Verifikasi Customer Service Layer 1</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <label for="">
              <b>
                Verifikasi
              </b>
            </label>
            <select name="status" class="form-control" required>
              <option value="-1">Batalkan Pembayaran</option>
              <option value="2">Konfirmasi Pembayaran</option>
            </select>
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

<form  entype="multipart/form-data" method="put" action="{{ route('panel.invoice.verifikasi',-1) }}" id="form_csl2">
{{ csrf_field() }}
<div class="modal fade" id="modal_csl2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Verifikasi @if(session()->get('login_panel')['level'] == 'admin') Oleh Admin @else Customer Service Layer 2 @endif</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <label for="">
              <b>
                Verifikasi
              </b>
            </label>
            <select name="status" class="form-control" required>
              @if(session()->get('login_panel')['level'] == 'admin')
              <option value="-1">Batalkan Pembayaran</option>
              <option value="2">Konfirmasi Pembayaran</option>
              @endif
              <option value="3">Pesanan Dikirim</option>
              <option value="4">Pesanan Sudah Sampai Oleh Penerima</option>
            </select>
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
      $('#form_data').attr('method','POST');
      $('#form_data').attr('action',`{{ route('panel.barang.postData') }}`);
    });

    $('#btn_modal_excel').on('click',function(){
      $('#modal_upload_excel').modal('show');
    });

    function modalCSL1(self){
      $('#modal_csl1').modal('show');
      $()
    }

    function editData(self){
      $('#exampleModalLabel').html(`<i class="fas fa-pencil-alt"></i> Edit Data`);
      $('#form_modal').modal('show');
      $('#form_data').trigger('reset');
      $('#form_data').attr('method','PUT');
      $('#form_data').attr('action',`{{ route('panel.barang.editData',-1) }}`.replace(-1,self.attr('data-id')));
      $(`[name="sku"]`).val(self.attr('data-sku'));
      $(`[name="nmbarang"]`).val(self.attr('data-nmbarang')); 
      $(`[name="stok"]`).val(self.attr('data-stok')); 
      $(`[name="harga"]`).val(formatRupiah(self.attr('data-harga'))); 
      $(`[name="berat"]`).val(self.attr('data-berat')); 
      $(`[name="diskon_percent"]`).val(self.attr('data-diskon_percent'));
      $(`[name="deskripsi"]`).val(self.attr('data-deskripsi'));
    }

    $('#form_csl1').on('submit',function(e){
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
                  $('#modal_csl1').modal('hide');
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

    $('#form_csl2').on('submit',function(e){
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
                  $('#modal_csl2').modal('hide');
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
          <td style="width: 10px" class="text-center" colspan="16"><i class="fas fa-spin fa-spinner"></i> Loading</td>
        </tr>
      `);
      $.ajax({
        'url' : `{{ route('panel.invoice.data') }}`,
        'type' : 'GET',
        'data' : {
          'page' : page, 'search' : $('[name="table_search"]').val()
        },
        'success' : function(result){
          if(result.data.length == 0){
            table_data.html(`
              <tr>
                <td style="width: 10px" class="text-center" colspan="16">Data Tidak Ditemukan</td>
              </tr>
            `);
            
            $('#paginate').html('');
          }else{
            table_data.html('');
            $.each(result.data,function(key,val){
              
              table_data.append(`
                <tr>
                  <td style="width: 10px" class="text-center">${key+1}</td>
                  <td style="width: 10px" class="text-center">
                    <div class="row">
                      <div class="col-md-6 text-center cursor-pointer">
                        <i class="fas fa-file-invoice" title="Detail Invoice"
                        onclick="window.open('${`{{ route('panel.invoice.detailInvoice',-1) }}`.replace(-1,val['id'])}')"></i>
                      </div>
                      <div class="col-md-6 text-center cursor-pointer">
                        ${sess_level=='csl1'?`<i class="fas fa-check" title="Verifikasi" data-id="${val['id']}" data-status="${val['status']}" onclick="modalCSL1($(this))"></i>`:`<i class="fas fa-check" title="Verifikasi" data-id="${val['id']}" data-status="${val['status']}" onclick="modalCSL2($(this))"></i>`}
                      </div>
                    </div>
                  </td>
                  <td>${val['noinvoice']}</td>
                  <td class="text-center">${val['labelstatus']}</td>
                  <td>${val['user']['email']}</td>
                  <td>${val['user']['name']}</td>
                  <td>${val['negara']}</td>
                  <td>${val['kota']}</td>
                  <td>${val['kecamatan']}</td>
                  <td>${val['kelurahan']}</td>
                  <td>${val['alamat']}</td>
                  <td class="text-center">${val['jumlahitem']}</td>
                  <td class="text-right">${formatRupiah(val['subtotal'])}</td>
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
                  <td style="width: 10px" class="text-center" colspan="16">Terjadi Kesalahan Sistem...</td>
              </tr>
          `);
        }
      });
    }

    function modalCSL1(self){
      $('#modal_csl1').modal('show');
      $('[name="status"]').val(self.attr('data-status'));
      var form_csl = $('#form_csl1');
      form_csl.attr('action',form_csl.attr('action').replaceAll(-1,self.attr('data-id')));
    }

    function modalCSL2(self){
      $('#modal_csl2').modal('show');
      $('[name="status"]').val(self.attr('data-status'));
      var form_csl = $('#form_csl2');
      form_csl.attr('action',form_csl.attr('action').replaceAll(-1,self.attr('data-id')));
    }

    function deleteData(self){
      var konfirm = confirm('Hapus Data ?');
      if(konfirm == true){
        self.attr('disabled','disabled');
        self.html(`<i class="fas fa-spin fa-spinner"></i>`);
        $.ajax({
          'url' : `{{ route('panel.barang.deleteData',-1) }}`.replace(-1,self.attr('data-id')),
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