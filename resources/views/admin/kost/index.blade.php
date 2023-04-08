@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
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
            <div class="card shadow-lg">
                <div class="card-body">
                    <div class="d-flex justify-content-center">
                        <h5>Masukkan Nama Kost yang ingin dicari!</h5>
                    </div>
                    <form action="{{ route('admin.kost.index') }}" method="get">
                        @csrf
                        <input type="text" name="search" class="form-control" id="" value="{{ Request::get('search') }}">
                    </form>
                </div>
            </div>
            <div class="card mt-4 shadow-lg">
                <div class="card-header bg-secondary text-white">{{ __('List Kost Belum Terverifikasi') }}</div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <td>#</td>
                                <td>Nama Kost</td>
                                <td>Kontak Pemilik</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kosts_unverif as $kost)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $kost->nama }}</td>
                                    <td>{{ $kost->kontak_pemilik }}</td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <a href="{{ route('admin.kost.show',$kost->id) }}" class="btn btn-sm btn-primary text-white"><i class="fa fa-check-square-o"></i></a>&nbsp;
                                            <form id="destroy-kost" action="{{ route('admin.kost.destroy', $kost->id) }}" method="POST">
                                                @method("delete")
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-danger text-white"><i class="fa fa-trash"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center">
                        {{ $kosts_unverif->links() }}
                    </div>
                </div>
            </div>
            <div class="card mt-4 shadow-lg">
                <div class="card-header bg-dark text-white">{{ __('List Kost') }}</div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <td>#</td>
                                <td>Nama Kost</td>
                                <td>Kontak Pemilik</td>
                                <td>Rating</td>
                                <td>Komentar</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kosts as $kost)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $kost->nama }}</td>
                                    <td>{{ $kost->kontak_pemilik }}</td>
                                    <td>@if($kost->reviews->average('rating')){{ $kost->reviews->average('rating') }}@else 0 @endif</td>
                                    <td>{{ $kost->reviews->count() }}</td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <a href="{{ route('details',$kost->id) }}" target="_blank" class="btn btn-sm btn-info text-white"><i class="fa fa-eye"></i></a>&nbsp;
                                            <form id="destroy-kost" action="{{ route('admin.kost.destroy', $kost->id) }}" method="POST">
                                                @method("delete")
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-danger text-white"><i class="fa fa-trash"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center">
                        {{ $kosts->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
