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
        td{
            padding-top:5px;
            padding-bottom:5px;
            font-size:18px;
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
                    <li class="breadcrumb-item active">{{ $page_title }}</li>
                </ol>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<section class="content mb-2">
    <div class="row">
        <div class="col-md-12">
            <section class="content">
                <a href="?action=edit" class="btn btn-info btn-sm">
                    <i class="fas fa-edit"></i>  Edit Data
                </a>
            </section>
        </div>
    </div>
</section>
<!-- Main content -->
<div class="row">
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
                            <div class="col-md-3">
                                <img src="{{ $datauser->avatar }}" class="img-fluid img-responsive" style="width:100%;" id="avatar">
                            </div>
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-md-6 mt-2">
                                        <b>Verifikasi Email : @if($datauser->isverif==1) <span class="text-success"><i class="ion-checkmark-circled"></i> Terverifikasi</span> @else <span class="text-danger"><i class="ion-close-circled"></i> Belum Terverifikasi</span> @endif</b>
                                    </div>
                                    <div class="col-md-6 mt-2">
                                        <b>Verifikasi Admin : @if($datauser->isverifadmin==1) <span class="text-success"><i class="ion-checkmark-circled"></i> Terverifikasi</span> @else <span class="text-danger"><i class="ion-close-circled"></i> Belum Terverifikasi</span> @endif</b>
                                    </div>
                                </div>
                                <hr>
                                    <h2>
                                        <b>Informasi Pribadi</b>
                                    </h2>
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
                                    <div class="col-md-12">
                                        <label for="">
                                            <b>Email</b>
                                        </label>
                                        <p style="margin-top: -13px;">
                                            {{ $datauser->email?$datauser->email:'-' }}
                                        </p>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">
                                            <b>NIK</b>
                                        </label>
                                        
                                        @if($datauser->dokumen_ktp)<a href="{{ $datauser->dokumen_ktp }}" target="_blank" class="btn btn-xs btn-info float-right  float-left mr-2"><i class="fas fa-download"></i></a>@endif
                                        <p style="margin-top: -13px;">
                                            {{ $datauser->nik?$datauser->nik:'-' }}
                                        </p>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">
                                            <b>NPWP</b>
                                        </label>
                                        
                                        @if($datauser->isnpwp)
                                            @if($datauser->dokumen_npwp)<a href="{{ $datauser->dokumen_npwp }}" target="_blank" class="btn btn-xs btn-info float-right  float-left mr-2"><i class="fas fa-download"></i></a>@endif
                                        @endif
                                        <p style="margin-top: -13px;">
                                            @if($datauser->isnpwp)
                                                {{ $datauser->npwp?$datauser->npwp:'-' }}
                                            @else
                                                Tidak Ada NPWP
                                            @endif
                                        </p>
                                    </div>
                                </div>
                                
                                <hr>
                                    <h2>
                                        <b>Data Perbankan</b>
                                    </h2>
                                <hr>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="">
                                            <b>Cabang</b>
                                        </label>
                                        <p style="margin-top: -13px;">
                                            {{ $datauser->cabang?$datauser->cabang:'-' }}
                                        </p>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">
                                            <b>Nama Bank</b>
                                        </label>
                                        <p style="margin-top: -13px;">
                                            {{ $datauser->namabank?$datauser->namabank:'-' }}
                                        </p>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">
                                            <b>No Rekening</b>
                                        </label>
                                        <p style="margin-top: -13px;">
                                            {{ $datauser->norek?$datauser->norek:'-' }}
                                        </p>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">
                                            <b>Nama Rekening</b>
                                        </label>
                                        <p style="margin-top: -13px;">
                                            {{ $datauser->nama_rek?$datauser->nama_rek:'-' }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <div class="container-fluid">
            <div class="form-group">
                <button type="button" onclick="window.open(`{{ route('panel.myprofile.download') }}`)" class="btn btn-info">
                    <i class="fas fa-download"></i> Download Kontrak
                </button>
            </div>
        </div>
    </div>
</div>
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
                    btn_submit.html(`Simpan`);
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