@extends('front.base')
@section('contents')
    <!-- Start Content -->
    @if($databarang)
    <div class="container py-5">
        <div class="row">

            <div class="col-lg-12">
                <div class="row">
                    @foreach($databarang as $rowindex)
                    <div class="col-md-4">
                        <div class="card mb-4 product-wap rounded-0">
                            <div class="card rounded-0">
                                <img class="card-img rounded-0 img-fluid" src="{{ $rowindex->images }}">
                                <div class="card-img-overlay rounded-0 product-overlay d-flex align-items-center justify-content-center">
                                    <ul class="list-unstyled">
                                        <li><a class="btn btn-success text-white mt-2" href="/produk/{{ $rowindex->id }}"><i class="far fa-eye"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-body text-center">
                                <a href="/produk/{{ $rowindex->id }}" class="h3 text-decoration-none">{{ $rowindex->nmbarang }}</a>
                                <ul class="w-100 list-unstyled d-flex justify-content-between mb-0">
                                    <li class="pt-2">
                                        <span class="product-color-dot color-dot-red float-left rounded-circle ml-1"></span>
                                        <span class="product-color-dot color-dot-blue float-left rounded-circle ml-1"></span>
                                        <span class="product-color-dot color-dot-black float-left rounded-circle ml-1"></span>
                                        <span class="product-color-dot color-dot-light float-left rounded-circle ml-1"></span>
                                        <span class="product-color-dot color-dot-green float-left rounded-circle ml-1"></span>
                                    </li>
                                </ul>
                                @if($rowindex->diskon_percent > 0)
                                <p class="text-center mb-0">
                                    <s><b>{{ number_format($rowindex->harga,2,',','.') }}</b></s> <br>
                                    <b>Diskon {{ $rowindex->diskon_percent }}%</b> <br>
                                        <b>
                                            {{ number_format($rowindex->harga-($rowindex->diskon_percent/100*$rowindex->harga),2,',','.') }}
                                        </b>
                                </p>
                                @else
                                <p class="text-center mb-0">
                                    <b>{{ number_format($rowindex->harga,2,',','.') }}</b>
                                </p>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
    <!-- End Content -->
    @endif
@endsection