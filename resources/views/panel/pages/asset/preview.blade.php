@extends('panel.base')
@section('css')
    <style>
        body{
            overflow-x:hidden;
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
                    <li class="breadcrumb-item active">Form Edit Data</li>
                </ol>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- Main content -->
<div class="row">
    <div class="col-md-12">
        <section class="content">
            <div class="container-fluid">
                <a href="/panel/asset?users_id={{ request()->get('users_id') }}" class="btn btn-danger btn-sm mb-2">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
                <a href="/panel/asset?action=edit&id={{ request()->get('id') }}&users_id={{ request()->get('users_id') }}" class="btn btn-info btn-sm ml-2 mb-2">
                    <i class="fas fa-edit"></i> Edit Asset
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
    @endif
    <div class="col-md-12">
        <section class="content">
            <div class="container-fluid">
                <div class="card card-primary">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-12">
                                <h3 class="card-title">{{ $dataaset->title?$dataaset->title:'-' }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-2">
                                <img src="{{ $dataaset->cover_art }}" class="img-fluid img-responsive" style="width:100%;" id="save_cover_art">
                            </div>
                            <div class="col-md-10">
                                <div class="row">
                                    <div class="col-md-6 mt-2">
                                        <label for="">
                                            <b>Work ID</b>
                                        </label>
                                        <p style="margin-top: -13px;">
                                            {{ $dataaset->work_id?$dataaset->work_id:'-' }}
                                        </p>
                                    </div>
                                    <div class="col-md-6 mt-2">
                                        <label for="">
                                            <b>New Rev</b>
                                        </label>
                                        <p style="margin-top: -13px;">
                                            {{ $dataaset->new_rev?$dataaset->new_rev:'-' }}
                                        </p>
                                    </div>
                                    <div class="col-md-6 mt-2">
                                        <label for="">
                                            <b>Ori Ver</b>
                                        </label>
                                        <p style="margin-top: -13px;">
                                            {{ $dataaset->ori_ver?$dataaset->ori_ver:'-' }}
                                        </p>
                                    </div>
                                    <div class="col-md-6 mt-2">
                                        <div class="row">
                                            <div class="col-2">
                                                <div class="custom-control custom-checkbox cursor-pointer">
                                                    <input class="custom-control-input" type="checkbox" id="notasi" name="notasi"
                                                    value="1" <?= $dataaset->notasi?'checked':'' ?> disabled>
                                                    <label for="notasi" class="custom-control-label">Notasi</label>
                                                </div>
                                            </div>
                                            <div class="col-2">
                                                <div class="custom-control custom-checkbox cursor-pointer">
                                                    <input class="custom-control-input" type="checkbox" id="lirik" name="lirik" value="1"
                                                    <?= $dataaset->lirik?'checked':'' ?> disabled>
                                                    <label for="lirik" class="custom-control-label">Lirik</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mt-2">
                                        <label for="">
                                            <b>Artis/Penyanyi</b>
                                        </label>
                                        <p style="margin-top: -13px;">
                                            {{ $dataaset->performer }}
                                        </p>
                                    </div>
                                    @if(session()->get('login_panel')['is_admin'])
                                    <div class="col-md-6 mt-2">
                                        <label for="">
                                            <b>PGT Asset ID</b>
                                        </label>
                                        <p style="margin-top: -13px;">
                                            {{ $dataaset->pragita_asset_id }}
                                        </p>
                                    </div>
                                    @endif
                                    <div class="col-md-12"></div>
                                    <div class="col-md-12 mt-2">
                                        <label for="">
                                            <b>Link Youtube Official</b>
                                        </label>
                                        <p style="margin-top: -13px;">
                                            {{ $dataaset->link_youtube_official?$dataaset->link_youtube_official:'-' }}
                                        </p>
                                    </div>
                                    <div class="col-md-12 mt-2">
                                        <label for="">
                                            Link Youtube Lainnya
                                        </label>
                                        <p style="margin-top: -13px;">
                                            {{ $dataaset->link_youtube_others?$dataaset->link_youtube_others:'-' }}
                                        </p>
                                    </div>
                                    
                                    <div class="col-md-12 mt-2">
                                        <label for="">
                                            <b>Link Audio</b>
                                        </label>
                                        <p style="margin-top: -13px;">
                                            {{ $dataaset->link_audio?$dataaset->link_audio:'-' }}
                                        </p>
                                    </div>
                                    <div class="col-md-12 mt-2">
                                        <label for="">
                                            <b>Link Lainnya</b>
                                        </label>
                                        <p style="margin-top: -13px;">
                                            {{ $dataaset->link_lainnya?$dataaset->link_lainnya:'-' }}
                                        </p>
                                    </div>
                                    <div class="col-md-6 mt-2">
                                        <label for="">
                                            <b>ISWC</b>
                                        </label>
                                        <p style="margin-top: -13px;">
                                            {{ $dataaset->iswc?$dataaset->iswc:'-' }}
                                        </p>
                                    </div>
                                    <div class="col-md-6 mt-2">
                                        <label for="">
                                            <b>ISRC</b>
                                        </label>
                                        <p style="margin-top: -13px;">
                                            {{ $dataaset->isrc?$dataaset->isrc:'-' }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
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
                if(result.save_cover_art){
                    $('#save_cover_art').attr('src',result.save_cover_art);
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
</script>
@endsection