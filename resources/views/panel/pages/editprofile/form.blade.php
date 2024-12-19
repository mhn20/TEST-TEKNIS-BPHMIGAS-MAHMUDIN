@extends('panel.base')
@section('css')
    <style>
        .overflowheight{
            height: 500px; /* Sesuaikan dengan tinggi layar */
            overflow-y: scroll; /* Tampilkan scrollbar vertikal jika konten melebihi */
        }
        .img-circle-custom{
            height: 100px;
            width: 100px;
        }
        td{
            vertical-align:middle !important;
        }
        .cursor-pointer{
            cursor: pointer;
        }
        table tr th {
            vertical-align:middle !important;
        }
        .cursor-pointer{
            cursor:pointer !important;
        }
        .icon-download{
            font-size: 68px;
        }
        @media only screen and (max-width: 1024px) {
            label{
                font-size:12px;
            }
            .icon-download{
                font-size:12px;
            }
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
<form method="post" action="{{ route('panel.editprofile.update') }}" entype="multipart/form-data" id="form_data">
{{ csrf_field() }}
<section class="content">
    <div class="container-fluid">
        <div class="card card-primary">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <h3 class="card-title">Form Data</h3>
                    </div>
                    <div class="col-md-6">
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    @if(session()->get('login_panel')['is_admin'] == false)
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama Composer</label>
                            <input
                                name="name"
                                type="text"
                                class="form-control"
                                placeholder="Input Nama Composer" value="{{ $datauser->name }}" required readonly maxlength="255">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Alias</label>
                            <input
                                name="alias"
                                type="text"
                                class="form-control"
                                placeholder="Input Alias" value="{{ $datauser->alias }}" required readonly maxlength="100">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Alamat Email</label>
                            <input
                                name="email"
                                type="text"
                                class="form-control"
                                placeholder="Input Name" value="{{ $datauser->email }}" disabled maxlength="255">
                        </div>
                    </div>
                    @endif
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Password Lama</label>
                            <input
                                name="password_lama"
                                type="password"
                                class="form-control"
                                placeholder="Input Password Lama" required maxlength="100" minlength="5">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Password Baru</label>
                            <input
                                name="password_baru"
                                type="password"
                                class="form-control"
                                placeholder="Input Password Baru" required maxlength="100" minlength="5">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Konfirmasi Password Baru</label>
                            <input
                                name="confirm_password"
                                type="password"
                                class="form-control"
                                placeholder="Input Konfirmasi Password Baru" required maxlength="100" minlength="5">
                        </div>
                    </div>
                    <div class="col-md-12 mt-2">
                        <button class="btn btn-success" type="submit">
                            <i class="fas fa-save"></i> Simpan
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
</form>
<!-- /.content -->
@endsection
@section('js')
    <script>

        $('.remove_spasi').on('input', function(){
            var remove_spasi = $(this).val().replace(/[^A-Z0-9-/]/ig, "");
            $(this).val(remove_spasi);
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
                    if(result.save_icon){
                        $('#icon').attr('src',result.save_icon);
                    }
                    if(result.status == '200'){
                        setTimeout(() => {
                            location='';
                        }, 1000);
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

        function resendAktivasi(self){
            self.attr('disabled','disabled');
            self.html(`<i class="fas fa-spin fa-spinner"></i> Loading..`);
            $.ajax({
                'url' : `{{ route('panel.resendAktivasi') }}`,
                'type' : 'POST',
                'data' : {
                    '_token' : '{{ csrf_token() }}'
                },
                'success' : function(result){
                    self.removeAttr('disabled');
                    self.html(`Aktivasi`);
                    alertToatstr(result.status,result.messages);
                },
                'error':function(err){
                    self.removeAttr('disabled');
                    self.html(`Aktivasi`);
                    alertToatstr(500,'Error Sistem');
                }
            });
        }


        var keyverif = `{{ request()->get('keyverif') }}`;

        if(keyverif){
            $.ajax({
                'url' : `{{ route('panel.updateIsverif') }}`,
                'type' : 'POST',
                'data' : {
                    '_token' : '{{ csrf_token() }}', 'keyverif' : keyverif
                },
                'success' : function(result){
                    alertToatstr(result.status,result.messages);
                },
                'error':function(err){
                    alertToatstr(500,'Error Sistem');
                }
            });
        }
    </script>
@endsection