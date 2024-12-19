@extends('panel.base')
@section('css')
    <style>
        body{
            overflow-x: hidden;
        }
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
<form method="put" action="{{ route('panel.users.updateData',request()->get('users_id')) }}" entype="multipart/form-data" id="form_data">
{{ csrf_field() }}
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <section class="content">
                <div class="container-fluid">
                    <a href="/panel/users" class="btn btn-danger btn-sm float-left mb-2">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                    <a href="/panel/asset?users_id={{ request()->get('users_id') }}" target="_blank" class="btn btn-info btn-sm float-left ml-2">
                        <i class="fas fa-solid fa-music mr-1"></i>  Data Asset
                    </a>
                </div>
            </section>
        </div>
    </div>
</section>
<div class="row">
    <div class="col-md-3">
        <section class="content">
            <div class="container-fluid">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">
                            Pas Foto
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Foto Profile</label>
                            <center>
                            <img src="{{ $datauser->avatar }}" class="img-circle elevation-2 img-circle-custom mt-2" id="avatar">
                            </center>
                            <input name="avatar"
                                type="file"
                                class="form-control"
                                placeholder="Input Icon" maxlength="255">
                            
                            <span>
                                <b>Type File Image Ukuran 1MB</b>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div class="col-md-9">
        <section class="content">
            <div class="container-fluid">
                <div class="card card-info">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6">
                                <h3 class="card-title mt-2">
                                    Biodata Anda
                                </h3>
                            </div>
                            <div class="col-md-6">
                                <a href="{{ route('panel.myprofile.download') }}?users_id={{ request()->get('users_id') }}" target="_blank" class="btn btn-info float-right">
                                    <i class="fas fa-download"></i> Download Kontrak
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">PGT Composer ID</label>
                                    <input
                                        name="pragita_composer_id"
                                        type="text"
                                        class="form-control"
                                        placeholder="PGT Composer ID" value="{{ @$datauser->pragita_composer_id }}" maxlength="255">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">No Kontrak</label>
                                    <input
                                        name="no_kontrak"
                                        type="text"
                                        class="form-control"
                                        placeholder="Input No Kontrak" value="{{ @$auto_no_kontrak }}" required readonly maxlength="100">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nama Composer</label>
                                    <input
                                        name="name"
                                        type="text"
                                        class="form-control"
                                        placeholder="Input Nama Composer" value="{{ @$datauser->name }}" required maxlength="255">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Alamat Email</label>
                                    <input
                                        name="email"
                                        type="text"
                                        class="form-control"
                                        placeholder="Input Email" value="{{ @$datauser->email }}" maxlength="255">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tempat</label>
                                    <input
                                        name="tempat"
                                        type="text"
                                        class="form-control"
                                        placeholder="Input Tempat" value="{{ @$datauser->tempat }}" required maxlength="100">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Alias</label>
                                    <input
                                        name="alias"
                                        type="text"
                                        class="form-control"
                                        placeholder="Input Alias" value="{{ !@$datauser->alias?@$datauser->name:@$datauser->alias }}" maxlength="100">
                                    <span>
                                        <b>Jika Nama Alias Tidak Ada Maka diisi dengan Nama Asli</b>
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Alamat</label>
                                    <input
                                        name="alamat"
                                        type="text"
                                        class="form-control"
                                        placeholder="Input Alamat" value="{{ @$datauser->alamat }}" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">No Telp / Whatsapp</label>
                            <input
                                name="telp"
                                type="number"
                                class="form-control"
                                placeholder="Input Telp" value="{{ @$datauser->telp }}" required minlength="6" maxlength="15">
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">NIK</label>
                                    <input
                                        name="nik"
                                        id="nik"
                                        type="number"
                                        class="form-control"
                                        placeholder="Input NIK" value="{{ @$datauser->nik }}" required minlength="10" maxlength="20">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="row">
                                        @if($datauser->dokumen_ktp)
                                        <div class="col-md-2 col-sm-12">
                                            <a href="{{ $datauser->dokumen_ktp }}" target="_blank" class="btn btn-primary" style="height:100%;width:100%;vertical-align:middle;">
                                                <i class="fas fa-download icon-download"></i>
                                            </a>
                                        </div>
                                        @endif
                                        <div class="{{ $datauser->dokumen_ktp?'col-md-10':'col-md-12' }} col-sm-12">
                                            @if($datauser->dokumen_ktp)
                                            <label for="exampleInputEmail1">Dokumen KTP</label>
                                            @else
                                            <label class="text-danger">
                                                <b><blink>! Dokumen KTP Belum Diisi</blink></b>
                                            </label>
                                            @endif
                                            <input
                                                name="dokumen_ktp"
                                                type="file"
                                                class="form-control"
                                                placeholder="Upload Dokumen KTP" minlength="10" maxlength="20">
                                            <span>
                                                <b>Type File Image/PDF Ukuran 2MB</b>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Status</label>
                                    <select name="isnpwp" class="form-control" required>
                                        <option value="1" <?= @$datauser->isnpwp==1?'selected':'' ?>>Ada NPWP</option>
                                        <option value="0" <?= @$datauser->isnpwp!=1?'selected':'' ?>>Tidak Ada NPWP</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12"></div>
                            <div class="col-md-6 isnpwp">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">NPWP</label>
                                    <input
                                        name="npwp"
                                        id="npwp"
                                        type="number"
                                        class="form-control"
                                        placeholder="Input NPWP" value="{{ @$datauser->npwp }}" minlength="10" maxlength="20">
                                </div>
                            </div>
                            <div class="col-md-6 isnpwp">
                                <div class="form-group">
                                    <div class="row">
                                        @if($datauser->dokumen_npwp)
                                        <div class="col-md-2 col-xs-12">
                                            <a href="{{ $datauser->dokumen_npwp }}" target="_blank" class="btn btn-primary" style="height:100%;width:100%;vertical-align:middle;">
                                                <i class="fas fa-download icon-download"></i>
                                            </a>
                                        </div>
                                        @endif
                                        <div class="{{ $datauser->dokumen_npwp?'col-md-10':'col-md-12' }} col-xs-12">
                                            @if($datauser->dokumen_npwp)
                                            <label for="exampleInputEmail1">Dokumen NPWP</label>
                                            @else
                                            <label class="text-danger">
                                                <b><blink>! Dokumen NPWP Belum Diisi</blink></b>
                                            </label>
                                            @endif
                                            <input
                                                name="dokumen_npwp"
                                                type="file"
                                                class="form-control"
                                                placeholder="Upload Dokumen NPWP">
                                            <span>
                                                <b>Type File Image/PDF Ukuran 2MB</b>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">
                            Data Perbankan Anda
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Cabang</label>
                                    <input
                                        name="cabang"
                                        type="text"
                                        class="form-control"
                                        placeholder="Input Cabang" value="{{ @$datauser->cabang }}" required maxlength="50">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nama Bank</label>
                                    <input
                                        name="namabank"
                                        type="text"
                                        class="form-control"
                                        placeholder="Input Nama Bank" value="{{ @$datauser->namabank }}" required maxlength="50">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">No Rekening</label>
                                    <input
                                        name="norek"
                                        type="number"
                                        class="form-control"
                                        placeholder="Input No Rekening" value="{{ @$datauser->norek }}" required maxlength="50">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nama Rekening</label>
                                    <input
                                        name="nama_rek"
                                        type="text"
                                        class="form-control"
                                        placeholder="Input Nama Rekening" value="{{ @$datauser->nama_rek }}" required maxlength="50">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">
                            Password Anda
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Password</label>
                                    <input
                                        name="password"
                                        type="password"
                                        class="form-control"
                                        placeholder="Input Password" maxlength="100">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Konfirmasi Password</label>
                                    <input
                                        name="confirm_password"
                                        type="password"
                                        class="form-control"
                                        placeholder="Input Konfirmasi Password" maxlength="100">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="container-fluid pb-4">
            <div class="row">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
</form>
<!-- /.content -->
@endsection
@section('js')
    <script>

        $(`[name="isnpwp"]`).on('change',function(){
            actNPWP();
        });
        actNPWP();
        function actNPWP(){
            if($(`[name="isnpwp"]`).val() == 1){
                $('.isnpwp').show();
                $(`[name="npwp"]`).attr('required','required');
            }else if($(`[name="isnpwp"]`).val() == 0){
                $('.isnpwp').hide();
                $(`[name="npwp"]`).removeAttr('required');
            }else{
                $('.isnpwp').show();
                $(`[name="npwp"]`).removeAttr('required');
            }
        }

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
                    btn_submit.html(`Simpan`);
                    if(result.save_icon){
                        $('#icon').attr('src',result.save_icon);
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