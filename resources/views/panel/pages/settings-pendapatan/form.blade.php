@extends('panel.base')
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
                <h3 class="card-title">Form Data</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form method="post" action="{{ route('panel.settings_pendapatan.update') }}" entype="multipart/form-data" id="form_data">
                {{ csrf_field() }}
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="exampleInputEmail1">Management Fee Percent %</label>
                            <input
                                name="management_fee_percent"
                                id="management_fee_percent"
                                type="number"
                                class="form-control percent"
                                placeholder="Input Management Fee Percent %" value="{{ @$dataset->management_fee_percent }}" required maxlength="3"> 
                        </div>
                        <div class="col-md-6">
                            <label for="exampleInputEmail1">PPH23 Percent %</label>
                            <input
                                name="pph23_percent"
                                id="pph23_percent"
                                type="number"
                                class="form-control percent"
                                placeholder="Input PPH23 Percent %" value="{{ @$dataset->pph23_percent }}" required maxlength="3"> 
                        </div>
                        <!-- <div class="col-md-4">
                            <label for="exampleInputEmail1">NPPN Percent %</label>
                            <input
                                name="nppn_percent"
                                id="nppn_percent"
                                type="number"
                                class="form-control percent"
                                placeholder="Input NPPN Percent %" value="{{ @$dataset->nppn_percent }}" required maxlength="3">
                        </div> -->
                    </div>
                    <div class="form-group mt-3">
                        <button type="submit" class="btn btn-success btn-md">
                            <i class="fas fa-save"></i> Simpan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
<!-- /.content -->
@endsection
@section('js')
    <script>

        $('document').ready(function(){
            $('#summernote').summernote();
            $('#term_condition').summernote();
            mask('management_fee_percent',3);
            mask('pph23_percent',3);
            mask('npwp_percent',3);
            mask('nppn_percent',3);
        });

        $('.percent').on('input',function(){
            if(parseInt($(this).val()) > 100){
                $(this).val('100');
            }
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