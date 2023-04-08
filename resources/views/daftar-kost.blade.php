@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-dark text-white">{{ __('Daftarkan Kost') }}</div>
                <div class="card-body">
                    @if (\Session::has('success'))
                        <div class="alert alert-success">
                            {!! \Session::get('success') !!}
                        </div>
                    @else
                    <div class="alert alert-info">Kami juga menyambut pemilik kost untuk bergabung dengan kami dan memasukkan informasi kost ke dalam database kami. Kami berharap dapat membantu pemilik kost memperluas jangkauan pasar dan memperoleh calon penyewa yang berkualitas. Selamat datang di website pencarian kost kami, tempat yang tepat untuk mencari dan menyewakan kost dengan mudah dan efisien.</div>
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
                    <form action="{{ route('daftar-kost.store') }}" enctype="multipart/form-data" method="post">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Nama Kost</label>
                            <input type="text" name="nama" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Lokasi Kost</label>
                            <input type="text" name="lokasi" class="form-control">
                            <small>Contoh : Kecamatan Bae, Kudus</small>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Deksripsi</label>
                            <textarea name="deskripsi" class="form-control" rows="3"></textarea>
                            <small>Jelaskan mengapa calon penyewa harus menyewa di kost ini</small>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Fasilitas</label>
                            <textarea name="fasilitas" class="form-control" rows="3"></textarea>
                            <small>Jelaskan apa saja fasilitas di kost ini</small>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Kontak Pemilik</label>
                            <textarea name="kontak_pemilik" class="form-control" rows="3"></textarea>
                            <small>Masukkan Nomor HP/Email/Whatsapp/Dll yang dapat dihubungi</small>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Harga</label>
                            <input type="text" name="harga" class="form-control">
                            <small>Masukkan harga umum kost</small>
                        </div>
                        <div class="mb-3">
                            <label for="formFileMultiple" class="form-label">Gambar Kost</label>
                            <input class="form-control mb-2" id="images" type="file" name="name_gambar[]" multiple="true">
                            <div class="imgPreview row"> </div>
                          </div>
                        <div class="mb-3 float-end">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-paper-plane"></i>  Ajukan Pendaftaran</button>
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
