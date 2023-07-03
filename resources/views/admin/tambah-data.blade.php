@extends('admin.layouts.app')

@section('title', 'Tambah Data')

@section('styles')
    <link href="{{ asset('/css/style.css') }}" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
    <style>
        .ikon {
            font-family: fontAwesome;
        }

        .animate-up:hover {
            top: -5px;
        }
    </style>
    <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('content-header')
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <div class="card shadow h-100">
                        <div class="card-header border-0">
                            <div
                                class="d-flex flex-column flex-md-row align-items-center justify-content-center justify-content-md-between text-center text-md-left">
                                <div class="mb-3">
                                    <h2 class="mb-0">Tambah Data</h2>
                                    {{-- <p class="mb-0 text-sm">Kelola Perangkat Desa</p> --}}
                                </div>
                                <div class="mb-3">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('content')
    @include('layouts.components.alert')
    <div class="row">
        <div class="col">
            <div class="card bg-secondary shadow h-100">
                <div class="card-header bg-white border-0">
                    <h3 class="mb-0"></h3>
                </div>
                <div class="card-body">
                    <form autocomplete="off" action="{{ route('admin.tambah-data') }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <h2>User</h2>
                        <div class="form-group">
                            <label class="form-control-label">Nama</label>
                            <input class="form-control @error('name') is-invalid @enderror" name="name"
                                placeholder="Masukkan nama ..." value="{{ old('name') }}">
                            @error('name')
                                <span class="invalid-feedback font-weight-bold">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-control-label">Email</label>
                            <input class="form-control @error('email') is-invalid @enderror" name="email" type="email"
                                placeholder="Masukkan email ..." value="{{ old('email') }}">
                            @error('email')
                                <span class="invalid-feedback font-weight-bold">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-control-label">Password</label>
                            <input class="form-control @error('password') is-invalid @enderror" name="password" required
                                placeholder="Password" type="password" value="{{ old('password') }}">
                            @error('password')
                                <span class="invalid-feedback font-weight-bold">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-control-label">Konfirmasi Password</label>
                            <input class="form-control" name="password_confirmation" required
                                placeholder="Konfirmasi Password" type="password"
                                value="{{ old('password_confirmation') }}">
                        </div>
                        <hr>
                        <h2>Kelurahan</h2>
                        <div class="form-group">
                            <label class="form-control-label">Nama Kelurahan</label>
                            <input class="form-control @error('nama_kelurahan') is-invalid @enderror" name="nama_kelurahan"
                                placeholder="Masukkan nama kelurahan ..." value="{{ old('nama_kelurahan') }}">
                            @error('nama_kelurahan')
                                <span class="invalid-feedback font-weight-bold">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-control-label">Kodepos</label>
                            <input class="form-control @error('kodepos') is-invalid @enderror" name="kodepos"
                                placeholder="Masukkan kodepos ..." value="{{ old('kodepos') }}">
                            @error('kodepos')
                                <span class="invalid-feedback font-weight-bold">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary btn-block" id="simpan">SIMPAN</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('scripts')
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            var table = $('#dataTable').DataTable();
            //$("#modal-hapus").modal()
            $('a[data-action]').on('click', function() {
                var actionUrl = $(this).data('action'); // Mendapatkan URL aksi dari atribut data-action

                // Mengubah atribut action pada form dengan URL aksi yang diperoleh
                $('#form-hapus').attr('action', actionUrl);
            })
        })
    </script>
@endpush
