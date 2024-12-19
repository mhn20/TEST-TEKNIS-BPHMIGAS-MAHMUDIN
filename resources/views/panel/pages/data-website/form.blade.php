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
            <form method="post" action="{{ route('panel.datawebsite.update') }}" entype="multipart/form-data" id="form_data">
                {{ csrf_field() }}
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Icon</label>
                        <br>
                        <img src="{{ $datawebsite->icon }}" class="img-fluid mt-2" id="icon" style="width:60px;">
                        <input
                            name="icon"
                            type="file"
                            class="form-control"
                            placeholder="Input Icon" maxlength="255">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Title</label>
                        <input
                            name="title"
                            type="text"
                            class="form-control"
                            placeholder="Input Title" value="{{ $datawebsite->title }}" required maxlength="255">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Meta</label>
                        <input
                            name="meta"
                            type="text"
                            class="form-control"
                            placeholder="Input Meta" value="{{ $datawebsite->meta }}" required maxlength="255">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Telp/Whatsapp</label>
                        <input
                            name="telp"
                            id="telp"
                            type="text"
                            class="form-control"
                            placeholder="Input Telp/Whatsapp" value="{{ $datawebsite->telp }}" required maxlength="20">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Alamat</label>
                        <textarea name="alamat" class="form-control">{{ $datawebsite->alamat }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">About</label>
                        <textarea name="about" id="summernote" class="form-control">{{ $datawebsite->about }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Term & Condition</label>
                        <textarea name="term_condition" id="term_condition" class="form-control">@php echo $datawebsite->term_condition ; @endphp</textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Footer</label>
                        <input
                            name="footer"
                            type="text"
                            class="form-control"
                            placeholder="Input Meta" value="{{ $datawebsite->footer }}" required maxlength="255">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success btn-md">Simpan</button>
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
    </script>
@endsection