@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <a href="{{ route('admin.kost.index') }}" class="btn btn-secondary mb-2 shadow-sm"><i class="fa fa-arrow-left"></i> Kembali</a>
            <div class="card shadow-lg">
                <div class="card-header bg-dark text-white">{{ __('Pengajuan Kost') }} <span class="fw-bold"><u>{{ $kost->nama }}</u></span></div>
                <div class="card-body">
                    @if (\Session::has('success'))
                        <div class="alert alert-success">
                            {!! \Session::get('success') !!}
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger font-bold" role="alert"><i class='bx bx-error-circle'></i> Formulir belum lengkap !
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form action="{{ route('admin.kost.verif') }}" enctype="multipart/form-data" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{ $kost->id }}">
                        <div class="mb-3">
                            <label class="form-label">Nama Kost</label>
                            <input type="text" name="nama" class="form-control" value="{{ $kost->nama }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Lokasi Kost</label>
                            <input type="text" name="lokasi" class="form-control" value="{{ $kost->lokasi }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Deksripsi</label>
                            <textarea name="deskripsi" class="form-control" rows="3">{{ $kost->deskripsi }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Fasilitas</label>
                            <textarea name="fasilitas" class="form-control" rows="3">{{ $kost->fasilitas }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Kontak Pemilik</label>
                            <textarea name="kontak_pemilik" class="form-control" rows="3">{{ $kost->kontak_pemilik }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Harga</label>
                            <input type="text" name="harga" class="form-control" value="{{ $kost->harga }}">
                        </div>
                        <div class="mb-3">
                            <label for="formFileMultiple" class="label d-block mb-3">Gambar Kost</label>
                            @foreach ($kost->gambars as $gambar)
                                <img class="col-4 col-md-3 mb-3" src="{{ asset('/img/gambar-kost/') }}/{{ $gambar->nama }}">
                            @endforeach
                          </div>
                        <div class="mb-3 float-end">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-archive"></i>  Update dan Verifikasi</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('js/jquery.js') }}"></script>
<script>
    $(function() {
        // Multiple images preview with JavaScript
        var multiImgPreview = function(input, imgPreviewPlaceholder) {
            if (input.files) {
                var filesAmount = input.files.length;
                for (i = 0; i < filesAmount; i++) {
                    var reader = new FileReader();
                    reader.onload = function(event) {
                        $($.parseHTML('<img class="col-4 col-md-3 mb-3">')).attr('src', event.target
                                .result)
                            .appendTo(
                                imgPreviewPlaceholder);
                    }
                    reader.readAsDataURL(input.files[i]);
                }
            }
        };
        $('#images').on('change', function() {
            $('div.imgPreview').empty();
            multiImgPreview(this, 'div.imgPreview');
        });
    });
</script>
@endsection
