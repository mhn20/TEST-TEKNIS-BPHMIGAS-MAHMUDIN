@extends('panel.base')
@section('css')
    <style>
        .bg-info-1{

        }
        .bg-info-2{
            
        }
    </style>
@endsection
@section('contents')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Dashboard - {{ $periode }}</h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<section class="content">
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-6 col-6">
                <!-- small box -->
                <div class="small-box bg-info-1">
                    <div class="inner">
                        <h3>{{ $total_asset }}</h3>

                        <p>Total Barang</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bar"></i>
                    </div>
                    <a href="/panel/barang" class="small-box-footer">More info
                        <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-6 col-6">
                <!-- small box -->
                <div class="small-box  bg-info-1">
                    <div class="inner">
                        <h3>
                            {{ $total_pendapatan }}
                        </h3>

                        <p>Total Pendapatan</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="/panel/invoice" class="small-box-footer">More info
                        <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            @if($dataslider)
            <div class="col-md-12 mt-2">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <?php $no = 0; foreach($dataslider as $rowindex){ $vno = $no++; ?>
                        <li data-target="#carouselExampleIndicators" data-slide-to="{{ $vno }}" class="{{ $vno==0?'active':'' }}"></li>
                        <?php } ?>
                    </ol>
                    <div class="carousel-inner">
                        <?php $no = 0; foreach($dataslider as $rowindexx){  $vno = $no++; ?>
                        <div class="carousel-item {{ $vno==0?'active':'' }}">
                            <img src="{{ $rowindexx->images }}" class="d-block w-100" alt="{{ $rowindexx->title }}">
                        </div>
                        <?php } ?>
                    </div>
                    <button class="carousel-control-prev" type="button" data-target="#carouselExampleIndicators" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-target="#carouselExampleIndicators" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </button>
                </div>
            </div>
            @endif
        </div>

    </div>
    <!-- /.container-fluid -->
</section>
@endsection