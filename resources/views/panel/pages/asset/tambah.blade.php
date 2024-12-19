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
        td{
            padding-top:5px;
            padding-bottom:5px;
            font-size:18px;
            vertical-align:top !important;
        }
        table tbody tr{
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
                    <li class="breadcrumb-item active">
                        <a href="/panel/asset">{{ $page_title }}</a>
                    </li>
                    <li class="breadcrumb-item active">Form Add Data</li>
                </ol>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- Main content -->
<form action="{{ route('panel.asset.postData') }}" method="post" enctype="multipart/form-data" id="form_data">
{{ csrf_field() }}
<div class="row">
    <div class="col-md-12">
        <section class="content">
            <div class="container-fluid">
                <a href="/panel/asset?users_id={{ request()->get('users_id') }}" class="btn btn-danger btn-sm float-left mb-2">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
        </section>
    </div>

    @if(@$datauser)
    <div class="col-md-12">
        <section class="content">
            <div class="container-fluid">
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
            </div>
        </section>
    </div>
    <div class="col-md-12 text-center">
        <h3>
            <b>
                ASSET
            </b>
        </h3>
    </div>
    @endif
    <div class="col-md-3">
        <section class="content">
            <div class="container-fluid">
                <div class="card card-primary">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6">Cover Art</div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <input name="cover_art"
                                type="file"
                                class="form-control"
                                placeholder="Input Cover Art" maxlength="255">
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
                            <div class="col-md-6">Form Add Data</div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @if(session()->get('login_panel')['is_admin'])
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">
                                        <b>
                                            PGT Asset ID
                                        </b>
                                    </label>
                                    <input type="text" name="pragita_asset_id" class="form-control">
                                </div>
                            </div>
                            @endif
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">
                                        <b>
                                            New Rev
                                        </b>
                                    </label>
                                    <input type="text" name="new_rev" class="form-control" max-length="50">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">
                                        <b>
                                            Ori Ver
                                        </b>
                                    </label>
                                    <input type="text" name="ori_ver" class="form-control" max-length="50">
                                </div>
                            </div>
                            
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="">
                                        <b>
                                            Judul Lagu
                                        </b>
                                    </label>
                                    <input type="text" name="title" class="form-control" max-length="100">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">
                                        <b>
                                            Klaim
                                        </b>
                                    </label>
                                    <table>
                                        <tr>
                                            <td>
                                                <div class="custom-control custom-checkbox cursor-pointer">
                                                    <input class="custom-control-input" type="checkbox" id="notasi" name="notasi"
                                                    value="1">
                                                    <label for="notasi" class="custom-control-label">Notasi</label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="custom-control custom-checkbox cursor-pointer ml-4">
                                                    <input class="custom-control-input" type="checkbox" id="lirik" name="lirik" value="1">
                                                    <label for="lirik" class="custom-control-label">Lirik</label>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">
                                        <b>
                                            Artis/Penyanyi
                                        </b>
                                    </label>
                                    <input type="text" name="performer" class="form-control" max-length="100">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">
                                        <b>
                                            ISWC
                                        </b>
                                    </label>
                                    <input type="text" name="iswc" class="form-control" max-length="100">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">
                                        <b>
                                            ISRC
                                        </b>
                                    </label>
                                    <input type="text" name="isrc" class="form-control" max-length="100">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">
                                        <b>
                                            Link Youtube Official
                                        </b>
                                    </label>
                                    <input type="text" name="link_youtube_official" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">
                                        <b>
                                            Link Youtube Lainnya
                                        </b>
                                    </label>
                                    <input type="text" name="link_youtube_others" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">
                                        <b>
                                            Link Audio
                                        </b>
                                    </label>
                                    <input type="text" name="link_audio" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">
                                        <b>
                                            Link Lainnya
                                        </b>
                                    </label>
                                    <input type="text" name="link_lainnya" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12 mt-2">
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-save"></i> Simpan
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </section>
    </div>
</div>
</form>
@endsection
@section('js')
<script>
    let users_id = `{{ request()->get('users_id') }}`;
    let is_admin = `{{ session()->get('login_panel')['is_admin'] }}`;

    $('#form_data').on('submit',function(e){
        e.preventDefault();
        var btn_submit = $(this).find('button[type="submit"]');
        btn_submit.attr('disabled','disabled');
        btn_submit.html(`<i class="fas fa-spin fa-spinner"></i>`);
        var send_form = new FormData(this);
        if(is_admin=='1'){
            if(users_id){
                send_form.append('users_id', users_id);
            }
        }
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
                if(result.status == '200'){
                    if(users_id){
                        location=`/panel/asset?users_id=${users_id}`;
                    }else{
                        location='/panel/asset';
                    }
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
</script>
@endsection