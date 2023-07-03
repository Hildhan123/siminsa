@extends('layouts.app')

@section('title', 'Tambah Data')

@section('styles')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.css" rel="stylesheet">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
<style>
    .ikon {
        font-family: fontAwesome;
    }
    .upload-image:hover{
        cursor: pointer;
        opacity: 0.7;
    }
</style>
@endsection

@section('content-header')
<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card shadow h-100">
                    <div class="card-header border-0">
                        <div class="d-flex flex-column flex-md-row align-items-center justify-content-center justify-content-md-between text-center text-md-left">
                            <div class="mb-3">
                                <h2 class="mb-0">Tambah Data</h2>
                                <p class="mb-0 text-sm">Kelola Lembaga Desa </p>
                            </div>
                            <div class="mb-3">
                                <a href="{{ route("organisasi.index") }}" class="btn btn-success" title="Kembali"><i class="fas fa-arrow-left"></i> Kembali</a>
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
                <h3 class="mb-0">Tambah Data</h3>
            </div>
            <div class="card-body">
                <form autocomplete="off" action="{{ route('lembaga.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label class="form-control-label">Logo Lembaga</label>
                        <div class="text-center">
                            <img onclick="$(this).siblings('.images').click()" class="mw-100 upload-image" style="max-height: 300px" src="{{ asset('storage/upload.jpg') }}" alt="">
                            <input accept="image/*" onchange="uploadImage(this)" type="file" name="logo" class="images" style="display: none">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-control-label">Nama Lembaga</label>
                        <input class="form-control @error('nama') is-invalid @enderror" name="nama" placeholder="Masukkan nama ..." value="{{ old('nama') }}">
                        @error('nama') <span class="invalid-feedback font-weight-bold">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-control-label">Singkatan</label>
                        <input class="form-control @error('singkatan') is-invalid @enderror" name="singkatan" placeholder="Masukkan singkatan ..." value="{{ old('singkatan') }}">
                        @error('singkatan') <span class="invalid-feedback font-weight-bold">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-control-label">Dasar Hukum</label>
                        <input class="form-control @error('dasar_hukum') is-invalid @enderror" name="dasar_hukum" placeholder="Masukkan dasar hukum ..." value="{{ old('dasar_hukum') }}">
                        @error('dasar_hukum') <span class="invalid-feedback font-weight-bold">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-control-label">Alamat Kantor</label>
                        <input class="form-control @error('alamat') is-invalid @enderror" name="alamat" placeholder="Masukkan alamat ..." value="{{ old('alamat') }}">
                        @error('alamat') <span class="invalid-feedback font-weight-bold">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-control-label">Profil</label>
                        <textarea class="form-control @error('profil') is-invalid @enderror" name="profil">{{ old('profil') }}</textarea>
                        @error('profil') <span class="invalid-feedback font-weight-bold">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-control-label">Visi Misi</label>
                        <textarea class="form-control @error('visi_misi') is-invalid @enderror" name="visi_misi">{{ old('visi_misi') }}</textarea>
                        @error('visi_misi') <span class="invalid-feedback font-weight-bold">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-control-label">Tugas Pokok dan Fungsi</label>
                        <textarea class="form-control @error('tugas_dan_fungsi') is-invalid @enderror" name="tugas_dan_fungsi">{{ old('tugas_dan_fungsi') }}</textarea>
                        @error('tugas_dan_fungsi') <span class="invalid-feedback font-weight-bold">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-control-label">Kepengurusan</label>
                        <textarea class="form-control @error('kepengurusan') is-invalid @enderror" name="kepengurusan">{{ old('kepengurusan') }}</textarea>
                        @error('kepengurusan') <span class="invalid-feedback font-weight-bold">{{ $message }}</span> @enderror
                    </div>
                    {{-- <div class="form-group">
                        <label class="form-control-label">Galeri Lembaga</label>
                        <div class="text-center">
                            <img onclick="$(this).siblings('.images').click()" class="mw-100 upload-image" style="max-height: 300px" src="{{ asset('storage/upload.jpg') }}" alt="">
                            <input accept="image/*" onchange="uploadImage(this)" type="file" name="galeri" class="images" style="display: none">
                        </div>
                    </div> --}}
                    <button type="submit" class="btn btn-primary btn-block" id="simpan">SIMPAN</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.js"></script>
<script>
    function uploadImage (inputFile) {
        if (inputFile.files && inputFile.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $(inputFile).siblings('img').attr("src", e.target.result);
            }
            reader.readAsDataURL(inputFile.files[0]);
        }
    }
    $(document).ready(function () {
        $(document).on("submit","form", function () {
            $(this).children("button:submit").attr('disabled','disabled');
            $(this).children("button:submit").html(`<img height="20px" src="{{ url('/storage/loading.gif') }}" alt=""> Loading ...`);
        });

        $("textarea").summernote({
            dialogsInBody: true,
            placeholder: 'Silahkan isi deskripsi',
            tabsize: 2,
            height: 300
        });
    });
</script>
@endpush
