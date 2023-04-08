@extends('layouts.app')

@section('content')
  
  <!-- Modal -->
  <div class="modal fade" id="addReview" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-body">
            @auth
            <form action="{{ route('review.store') }}" method="post">
                @csrf
                <input type="hidden" name="kost_id" value="{{ $kost->id }}">
                <div class="mb-3">
                    <label class="form-label">Rating</label>
                    <select name="rating" class="form-select">
                        <option value="5" selected>5 Bintang</option>
                        <option value="4">4 Bintang</option>
                        <option value="3">3 Bintang</option>
                        <option value="2">2 Bintang</option>
                        <option value="1">1 Bintang</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Komentar (Max 500 Kata)</label>
                    <textarea name="komentar" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                </div>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </form>
            @else
            <div class="alert alert-info mb-0">
                <p>
                    Kamu harus login dahulu sebelum membuat komentar
                </p> 
                    <div class="d-flex justify-content-center">
                        <a href="{{ route('login') }}" class="btn btn-info text-white">Login</a>&nbsp;
                        <a href="{{ route('register') }}" class="btn btn-info text-white ml-2">Register</a>
                    </div>
                </div>
            @endauth
        </div>
      </div>
    </div>
  </div>
<div class="container mt-4">
    <div class="row">
        <div class="col-md-7">
            <div class="card shadow-lg mb-4">
                <div class="card-body">
                    <h5 class="text-dark fw-bold mb-0">{{ $kost->nama }}</h5>
                    <small class="text-muted">{{ $kost->lokasi }}</small>
                    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="true">
                        <div class="carousel-inner">
                            @foreach ($kost->gambars as $gambar)
                            <div class="carousel-item @if($loop->iteration == 1)active @endif">
                                <img src="{{ asset('/img/gambar-kost/') }}/{{ $gambar->nama }}" class="d-block w-100">
                            </div>
                            @endforeach
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                          <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                          <span class="carousel-control-next-icon" aria-hidden="true"></span>
                          <span class="visually-hidden">Next</span>
                        </button>
                      </div>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="card shadow-lg mb-4">
                <div class="card-header">Deskripsi</div>
                <div class="card-body">
                    <p>{{ $kost->deskripsi }}</p>
                </div>
            </div>
            <div class="card shadow-lg mb-4">
                <div class="card-header">Fasilitas</div>
                <div class="card-body">
                    <p>{{ $kost->fasilitas }}</p>
                </div>
            </div>
            <div class="card shadow-lg mb-4">
                <div class="card-header bg-success text-white">Kontak Pemilik</div>
                <div class="card-body">
                    <p>{{ $kost->kontak_pemilik }}</p>
                </div>
            </div>
        </div>
    </div>
    <hr class="mt-0">
    <div class="d-flex justify-content-center">
        <div class="col-12">
            <div class="card shadow-lg">
                <div class="card-header bg-dark text-white">
                    <div class="d-flex justify-content-between">
                        <p class="mt-1 mb-0">Rating dan Review</p>
                        <div class="float-end"><button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addReview">Tambah Review</button></div>
                    </div>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger font-bold" role="alert"><i class='bx bx-error-circle'></i> {{ $errors->first() }}
                        </div>
                    @endif
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (!$kost->reviews->isEmpty())
                    @php
                                $average = $kost->reviews()->average('rating');
                                if($average == 0) {
                                    $average = 0;
                                }
                            @endphp
                        <h4>
                            Rating {{ number_format($average, 1) }}@if($average)
                                <i class="fa fa-star @if($average < 5)text-warning @else text-secondary @endif"></i>
                                 <i class="fa fa-star @if($average < 4)text-warning @else text-secondary @endif"></i>
                                 <i class="fa fa-star @if($average < 3)text-warning @else text-secondary @endif"></i>
                                 <i class="fa fa-star @if($average < 2)text-warning @else text-secondary @endif"></i>
                                 <i class="fa fa-star @if($average < 1)text-warning @else text-secondary @endif"></i>
                                 @else
                                 <i class="fa fa-star text-secondary"></i>
                                 <i class="fa fa-star text-secondary"></i>
                                 <i class="fa fa-star text-secondary"></i>
                                 <i class="fa fa-star text-secondary"></i>
                                 <i class="fa fa-star text-secondary"></i>
                                 @endif
                        </h4>
                    @else
                        <div class="d-flex justify-content-center">
                            <h6>Kost ini masih belum memiliki komentar dan review</h6>
                        </div>
                    @endif
                    <div class="row">
                        @foreach ($kost->reviews as $review)
                        <div class="col-md-6">
                            <div class="card mt-2">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-2">
                                            <i class="fa fa-user-circle" style="font-size:50px"></i>
                                        </div>
                                        <div class="col-10">
                                            <h5>{{ $review->user->name }}</h5>
                                            <small>{{ $review->komentar }}</small>
                                            <div class="d-block mt-2">
                                                <div class="float-end">
                                                    <small>
                                                        Rating {{ number_format($review->rating, 1) }}
                                                        <i class="fa fa-star @if($review->rating < 1)text-secondary @else text-warning @endif"></i>
                                                         <i class="fa fa-star @if($review->rating < 2)text-secondary @else text-warning @endif"></i>
                                                         <i class="fa fa-star @if($review->rating < 3)text-secondary @else text-warning @endif"></i>
                                                         <i class="fa fa-star @if($review->rating < 4)text-secondary @else text-warning @endif"></i>
                                                         <i class="fa fa-star @if($review->rating < 5)text-secondary @else text-warning @endif"></i>
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection