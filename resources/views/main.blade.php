@extends('layouts.app')

@section('content')
<style>
.carousel-content {
  position: absolute;
  bottom: 30%;
  left: 10%;
  margin: auto;
  z-index: 20;
  color: white;
  text-shadow: 0 5px 3px rgba(0,0,0,.6);
}
.ribbon {
  position: absolute;
  top: 5%;
  right: 1%;
  margin: auto;
  z-index: 20;
}
</style>
<div id="carouselExampleIndicators" class="carousel slide shadow-lg" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img class="w-100 " style="object-fit: cover;" height="300" src="{{ asset('assets/img/kost.png') }}" alt="First slide">
        <div class="carousel-content">
            <h1>Kost-Ong</h1>
            <h4 class="m-auto">Pencarian dan Rating Kost di Kudus</h4>
          </div>
      </div>
    </div>
  </div>
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow-lg rounded">
                <div class="card-body">
                    <div class="d-flex justify-content-center">
                        <h5>Tuliskan Nama Kost yang ingin dicari !</h5>
                    </div>
                    <form action="{{ route('home') }}" method="get">
                        <input type="text" class="form-control" name="search" id="" value="{{ Request::get('search') }}">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-center">
        <div class="col-11">
            <div class="row">
                @foreach ($kosts as $kost)
                <div class="col-md-3 mt-4">
                    <div class="card">
                        <img style="max-height:200px;object-fit: cover;" class="card-img-top" src="{{ asset('/img/gambar-kost/') }}/@if ($kost->gambars->first()){{ $kost->gambars->first()->attributesToArray()['nama'] }}@endif">
                        <label class="ribbon badge bg-primary fw-4" style="font-size: 85%">Rp. {{ $kost->harga }},-</label>
                        <div class="card-body">
                            <div class="text-center mb-2">
                                <h5 class="fw-bold mb-0">{{ $kost->nama }}</h5>
                                <small class="text-muted">{{ $kost->lokasi }}</small><br>
                            </div>
                            <div class="d-grid gap-2">
                                <a class="btn btn-outline-primary" href="{{ route('details', $kost->id) }}">Lihat Property</a>
                            </div>
                            @php
                                $average = $kost->reviews()->average('rating');
                                if($average == 0) {
                                    $average = 0;
                                }
                            @endphp
                            <small class="float-end">
                                Rating {{ number_format($average, 1) }}@if($average)
                                <i class="fa fa-star @if($average < 1)text-secondary @else text-warning @endif"></i>
                                 <i class="fa fa-star @if($average < 2)text-secondary @else text-warning @endif"></i>
                                 <i class="fa fa-star @if($average < 3)text-secondary @else text-warning @endif"></i>
                                 <i class="fa fa-star @if($average < 4)text-secondary @else text-warning @endif"></i>
                                 <i class="fa fa-star @if($average < 5)text-secondary @else text-warning @endif"></i>
                                 @else
                                 <i class="fa fa-star text-secondary"></i>
                                 <i class="fa fa-star text-secondary"></i>
                                 <i class="fa fa-star text-secondary"></i>
                                 <i class="fa fa-star text-secondary"></i>
                                 <i class="fa fa-star text-secondary"></i>
                                 @endif
                            </small>
                        </div>
                    </div>
                </div>
                @endforeach
                @if ($kosts->isEmpty())
                <div class="d-flex justify-content-center mt-5">
                        <h4>
                            Tidak ada data ditemukan !
                        </h4>
                    </div>
                    <div class="d-flex justify-content-center">
                        <a href="{{ route('home') }}" class="btn btn-dark text-white">Kembali</a>
                    </div>
                @endif
                <div class="d-flex justify-content-center mt-4">
                    {{ $kosts->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection