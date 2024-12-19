@extends('front.base')
@section('contents')
<!-- Open Content -->
<section class="bg-light">
<div class="container pb-5">
    <div class="row">
        <div class="col-lg-5 mt-5">
            <div class="card mb-3">
                <img
                    class="card-img img-fluid"
                    src="{{ $databarang->images }}"
                    alt="Card image cap"
                    id="product-detail">
            </div>
        </div>
        <!-- col end -->
        <div class="col-lg-7 mt-5">
            <div class="card">
                <div class="card-body">
                    <h1 class="h2">{{ $databarang->nmbarang }}</h1>
                    @if($databarang->diskon_percent > 0)
                    <p class="h3 py-2">
                        <s><b>{{ number_format($databarang->harga,2,',','.') }}</b></s> <br>
                        <b>Diskon {{ $databarang->diskon_percent }}%</b> <br>
                            <b>
                                {{ number_format($databarang->harga-($databarang->diskon_percent/100*$databarang->harga),2,',','.') }}
                            </b>
                    </p>
                    @else
                    <p class="h3 py-2">
                        <b>{{ number_format($databarang->harga,2,',','.') }}</b>
                    </p>
                    @endif
                    <p>
                        {{ $databarang->deskripsi }}
                    </p>

                    <form action="" method="GET">
                        <input type="hidden" name="product-title" value="Activewear">
                        <div class="row">
                            <div class="col-auto">
                                <ul class="list-inline pb-3">
                                    <li class="list-inline-item text-right">
                                        Quantity
                                        <input type="hidden" name="product-quanity" id="product-quanity" value="1">
                                    </li>
                                    <li class="list-inline-item">
                                        <span class="btn btn-success" id="btn-minus">-</span></li>
                                    <li class="list-inline-item">
                                        <span class="badge bg-secondary" id="var-value">1</span></li>
                                    <li class="list-inline-item">
                                        <span class="btn btn-success" id="btn-plus">+</span></li>
                                </ul>
                            </div>
                        </div>
                        <div class="row pb-3">
                            <div class="col d-grid">
                                <button
                                    type="submit"
                                    class="btn btn-success btn-lg"
                                    name="submit"
                                    value="addtocard">Add To Cart</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
</section>
<!-- Close Content -->
@endsection