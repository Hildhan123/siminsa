@extends('layouts.app')

@section('title', 'Tambah Tautan')

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
                                <h2 class="mb-0">Tambah Tautan</h2>
                                <p class="mb-0 text-sm">Kelola Tautan</p>
                            </div>
                            <div class="mb-3">
                                <a href="{{ route("tautan.index") }}" class="btn btn-success" title="Kembali"><i class="fas fa-arrow-left"></i> Kembali</a>
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
                <h3 class="mb-0">Tambah Tautan</h3>
            </div>
            <div class="card-body">
                <form autocomplete="off" action="{{route('tautan.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label class="form-control-label">Gambar</label>
                        <div class="text-center">
                            <img onclick="$(this).siblings('.images').click()" class="mw-100 upload-image" style="max-height: 300px" src="{{ asset('storage/upload.jpg') }}" alt="">
                            <input accept="image/*" onchange="uploadImage(this)" type="file" name="gambar" class="images" style="display: none">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-control-label">Title</label>
                        <input class="form-control @error('title') is-invalid @enderror" name="title" placeholder="Masukkan title ..." value="{{ old('title') }}">
                        @error('title') <span class="invalid-feedback font-weight-bold">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-control-label">Site link (URL)</label>
                        <input class="form-control @error('url') is-invalid @enderror" name="url" placeholder="Masukkan url ex:https://google.com" value="{{ old('url') }}">
                        @error('url') <span class="invalid-feedback font-weight-bold">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-control-label">Target</label>
                        <select class="form-control @error('target') is-invalid @enderror" name="target" id="target">
                            <option selected value="">Pilih target</option>
                            <option value="" {{ old('target') == null ? 'selected="true"' : ''  }}>Current Window (default)</option>
                            <option value="_blank" {{ old('target') == '_blank' ? 'selected="true"' : ''  }}>New Window (_blank)</option>
                        </select>
                        @error('target') <span class="invalid-feedback font-weight-bold">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-control-label">Deskripsi</label>
                        <textarea class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi">{{ old('deskripsi') }}</textarea>
                        @error('deskripsi') <span class="invalid-feedback font-weight-bold">{{ $message }}</span> @enderror
                    </div>
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
            placeholder: 'Silahkan isi konten',
            tabsize: 2,
            height: 300
        });
    });
</script>
@endpush
