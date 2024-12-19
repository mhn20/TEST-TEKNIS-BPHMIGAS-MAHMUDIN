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
<form method="post" action="{{ route('panel.myprofile.update') }}" entype="multipart/form-data" id="form_data">
<div class="row">
    <div class="col-md-3">
        <section class="content">
            <div class="container-fluid">
                <div class="card card-primary">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-12">
                                <h3 class="card-title">Foto Profile</h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <center>
                                        <img src="{{ $datauser->avatar }}" class="img-circle elevation-2 img-circle-custom mt-2" id="avatar">
                                    </center>
                                    <input name="avatar"
                                        type="file"
                                        class="form-control mt-2"
                                        placeholder="Input Icon" maxlength="255">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div class="col-md-9">
        <section class="content">
            <div class="container-fluid">
                <div class="card card-primary">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6">
                                <h3 class="card-title mt-2">Form Data</h3>
                            </div>
                            <div class="col-md-6">
                                <a href="{{ route('panel.myprofile.download') }}" target="_blank" class="btn btn-primary float-right">
                                    <i class="fas fa-download"></i> Download Kontrak
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nama Composer</label>
                                    <input
                                        name="name"
                                        type="text"
                                        class="form-control"
                                        placeholder="Input Nama Composer" value="{{ $datauser->name }}" required readonly maxlength="255">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Alamat Email</label>
                                    <input
                                        name="email"
                                        type="text"
                                        class="form-control"
                                        placeholder="Input Name" value="{{ $datauser->email }}" disabled maxlength="255">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="card @if(!$datauser->tempat or !$datauser->alamat or !$datauser->alias or !$datauser->telp or !$datauser->telp or !$datauser->nik or !$datauser->dokumen_ktp or !$datauser->npwp or !$datauser->dokumen_npwp) card-danger @else card-info @endif">
                    <div class="card-header">
                        <h3 class="card-title">
                            @if(!$datauser->tempat or !$datauser->alamat or !$datauser->alias or !$datauser->telp or !$datauser->telp or !$datauser->nik or !$datauser->dokumen_ktp or !$datauser->npwp or !$datauser->dokumen_npwp) Lengkapi Biodata Anda @else Biodata Anda @endif
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    @if($datauser->tempat)
                                        <label for="exampleInputEmail1">Tempat</label>
                                    @else
                                        <label class="text-danger">
                                            <b><blink>! Tempat Belum Diisi</blink></b>
                                        </label>
                                    @endif
                                    <input
                                        name="tempat"
                                        type="text"
                                        class="form-control"
                                        placeholder="Input Tempat" value="{{ $datauser->tempat }}" required maxlength="100">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    @if($datauser->alias)
                                    <label for="exampleInputEmail1">Alias</label>
                                    @else
                                    <label class="text-danger">
                                        <b><blink>! Alias Belum Diisi</blink></b>
                                    </label>
                                    @endif
                                    <input
                                        name="alias"
                                        type="text"
                                        class="form-control"
                                        placeholder="Input Alias" value="{{ !$datauser->alias?$datauser->name:$datauser->alias }}" maxlength="100">
                                    <span>
                                        <b>Jika Nama Alias Tidak Ada Maka diisi dengan Nama Asli</b>
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    @if($datauser->alamat)
                                        <label for="exampleInputEmail1">Alamat</label>
                                    @else
                                        <label class="text-danger">
                                            <b><blink>! Alamat Belum Diisi</blink></b>
                                        </label>
                                    @endif
                                    <input
                                        name="alamat"
                                        type="text"
                                        class="form-control"
                                        placeholder="Input Alamat" value="{{ $datauser->alamat }}" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            @if($datauser->telp)
                            <label for="exampleInputEmail1">No Telp / Whatsapp</label>
                            @else
                            <label class="text-danger">
                                <b><blink>! Telp / Whatsapp Belum Diisi</blink></b>
                            </label>
                            @endif
                            <input
                                name="telp"
                                type="number"
                                class="form-control"
                                placeholder="Input Telp" value="{{ $datauser->telp }}" required minlength="6" maxlength="15">
                        </div>
        
                        @if(!session()->get('login_panel')['is_admin'])
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    @if($datauser->nik)
                                    <label for="exampleInputEmail1">NIK</label>
                                    @else
                                    <label class="text-danger">
                                        <b><blink>! NIK Belum Diisi</blink></b>
                                    </label>
                                    @endif
                                    <input
                                        name="nik"
                                        id="nik"
                                        type="number"
                                        class="form-control"
                                        placeholder="Input NIK" value="{{ $datauser->nik }}" required minlength="10" maxlength="20">
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
                                    @if($datauser->npwp)
                                    <label for="exampleInputEmail1">NPWP</label>
                                    @else
                                    <label class="text-danger">
                                        <b><blink>! NPWP Belum Diisi</blink></b>
                                    </label>
                                    @endif
                                    <input
                                        name="npwp"
                                        id="npwp"
                                        type="number"
                                        class="form-control"
                                        placeholder="Input NPWP" value="{{ $datauser->npwp }}" required maxlength="20">
                                </div>
                            </div>
                            <div class="col-md-6">
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
                <div class="card  @if(!$datauser->cabang or !$datauser->namabank or !$datauser->norek or !$datauser->nama_rek) card-danger @else card-info @endif">
                    <div class="card-header">
                        <h3 class="card-title">
                            @if(!$datauser->cabang or !$datauser->namabank or !$datauser->norek or !$datauser->nama_rek) Lengkapi Data Perbankan Anda @else Data Perbankan Anda @endif
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    @if($datauser->cabang)
                                    <label for="exampleInputEmail1">Cabang</label>
                                    @else
                                    <label class="text-danger">
                                        <b><blink>! Cabang Belum Diisi</blink></b>
                                    </label>
                                    @endif
                                    <input
                                        name="cabang"
                                        type="text"
                                        class="form-control"
                                        placeholder="Input Cabang" value="{{ $datauser->cabang }}" required maxlength="50">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    @if($datauser->namabank)
                                    <label for="exampleInputEmail1">Nama Bank</label>
                                    @else
                                    <label class="text-danger">
                                        <b><blink>! Nama Bank Belum Diisi</blink></b>
                                    </label>
                                    @endif
                                    <input
                                        name="namabank"
                                        type="text"
                                        class="form-control"
                                        placeholder="Input Nama Bank" value="{{ $datauser->namabank }}" required maxlength="50">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    @if($datauser->norek)
                                    <label for="exampleInputEmail1">No Rekening</label>
                                    @else
                                    <label class="text-danger">
                                        <b><blink>! No Rekening Belum Diisi</blink></b>
                                    </label>
                                    @endif
                                    <input
                                        name="norek"
                                        type="number"
                                        class="form-control"
                                        placeholder="Input No Rekening" value="{{ $datauser->norek }}" required maxlength="50">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    @if($datauser->nama_rek)
                                    <label for="exampleInputEmail1">Nama Rekening</label>
                                    @else
                                    <label class="text-danger">
                                        <b><blink>! Nama Rekening Belum Diisi</blink></b>
                                    </label>
                                    @endif
                                    <input
                                        name="nama_rek"
                                        type="text"
                                        class="form-control"
                                        placeholder="Input Nama Rekening" value="{{ $datauser->nama_rek }}" required maxlength="50">
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="card @if(!@$dataaset->title or (!@$dataaset->notasi and !@$dataaset->lirik) or !@$dataaset->performer or (!@$dataaset->isrc and !@$dataaset->link_youtube_official and !@$dataaset->link_youtube_others)) card-danger @else card-info @endif">
                    <div class="card-header">
                        <h3 class="card-title">
                            @if(!@$dataaset->title or (!@$dataaset->notasi and !@$dataaset->lirik) or !@$dataaset->performer or (!@$dataaset->isrc and !@$dataaset->link_youtube_official and !@$dataaset->link_youtube_others)) Lengkapi Data Asset Anda @else Data Asset Anda @endif
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    @if(@$dataaset->title)
                                        <label for="exampleInputEmail1">Judul Lagu</label>
                                    @else
                                        <label class="text-danger">
                                            <b><blink>! Judul Lagu Belum Diisi</blink></b>
                                        </label>
                                    @endif
                                    <input
                                        name="title"
                                        type="text"
                                        class="form-control"
                                        placeholder="Input Judul Lagu" value="{{ @$dataaset->title }}" required maxlength="50">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    @if(@$dataaset->notasi or @$dataaset->lirik)
                                        <label for="exampleInputEmail1">Klaim</label>
                                    @else
                                        <label class="text-danger">
                                            <b><blink>! Klaim Belum Diisi</blink></b>
                                        </label>
                                    @endif
                                    <table>
                                        <tr>
                                            <td>
                                                <div class="custom-control custom-checkbox cursor-pointer">
                                                    <input class="custom-control-input" type="checkbox" id="notasi" name="notasi"
                                                    value="1" 
                                                    <?= @$dataaset->notasi?'checked':'' ?>>
                                                    <label for="notasi" class="custom-control-label">Notasi</label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="custom-control custom-checkbox cursor-pointer ml-4">
                                                    <input class="custom-control-input" type="checkbox" id="lirik" name="lirik" value="1"
                                                    <?= @$dataaset->lirik?'checked':'' ?>>
                                                    <label for="lirik" class="custom-control-label">Lirik</label>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    @if(@$dataaset->performer)
                                        <label for="exampleInputEmail1">Artis/Penyanyi</label>
                                    @else
                                        <label class="text-danger">
                                            <b><blink>! Artis/Penyanyi Belum Diisi</blink></b>
                                        </label>
                                    @endif
                                    <input
                                        name="performer"
                                        type="text"
                                        class="form-control"
                                        placeholder="Input Artis/Penyanyi" value="{{ @$dataaset->performer }}" required maxlength="50">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">ISRC</label>
                                    <input
                                        name="isrc"
                                        type="text"
                                        class="form-control form_mandatori_asset"
                                        placeholder="Input ISRC" value="{{ @$dataaset->isrc }}" maxlength="50">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Youtube Link Official</label>
                                    <input
                                        name="link_youtube_official"
                                        type="text"
                                        class="form-control form_mandatori_asset"
                                        placeholder="Input Youtube Link Official" value="{{ @$dataaset->link_youtube_official }}" maxlength="255">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Youtube Link Lainnya</label>
                                    <input
                                        name="link_youtube_others"
                                        type="text"
                                        class="form-control form_mandatori_asset"
                                        placeholder="Input Youtube Link Lainnya" value="{{ @$dataaset->link_youtube_others }}" maxlength="255">
                                </div>
                            </div>
                        </div>
                        
                        
                    </div>
                </div>
            </div>
        </section>
        <div class="container-fluid">
            <div class="form-group">
                <button type="submit" class="btn btn-success btn-md">
                    <i class="fas fa-save"></i> Simpan
                </button>
                <a href="{{ route('panel.myprofile.download') }}" target="_blank" class="btn btn-info float-right">
                    <i class="fas fa-download"></i> Download Kontrak
                </a>
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
                    btn_submit.html(`<i class="fas fa-download"></i> Simpan`);
                    if(result.save_icon){
                        $('#icon').attr('src',result.save_icon);
                    }
                    if(result.status == '200'){
                        setTimeout(() => {
                            location='';
                        }, 1000);
                    }
                    alertToatstr(result.status,result.messages);
                    setTimeout(() => {
                        location=`{{ route('panel.myprofile') }}`;
                    }, 1000);
                },
                error:function(err){
                    btn_submit.removeAttr('disabled');
                    btn_submit.html(`<i class="fas fa-download"></i> Simpan`);
                    alertToatstr(500,'Error Sistem');
                }
            });
        });

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