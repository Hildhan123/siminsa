@extends('layouts.app')

@section('title', 'Edit Data')

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
                                <h2 class="mb-0">Edit Data</h2>
                                <p class="mb-0 text-sm">Kelola struktur organisasi </p>
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
                <h3 class="mb-0">Edit Data</h3>
            </div>
            <div class="card-body">
                <form autocomplete="off" action="{{ route('organisasi.update',$organisasi->id) }}" method="post" enctype="multipart/form-data">
                    @csrf @method('PATCH')
                    <div class="form-group">
                        <label class="form-control-label">Title Jabatan</label>
                        <input class="form-control @error('title') is-invalid @enderror" name="title" placeholder="Masukkan title jabatan ..." value="{{$organisasi->title}}">
                        @error('title') <span class="invalid-feedback font-weight-bold">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-control-label">Deskripsi</label>
                        <textarea class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi">{{$organisasi->deskripsi}}</textarea>
                        @error('deskripsi') <span class="invalid-feedback font-weight-bold">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group" id="struk" style="display:block">
                        <label class="form-control-label" for="jabatan">Pegawai</label>
                        <select id="jabatan1" name="pegawai_id" class="form-control selectpicker" data-live-search="true">
                            <option value="" >Pilih pegawai</option>
                            @foreach ($pegawai as $index)
                                <option value="{{$index->id}}" @if($organisasi->pegawai_id == $index->id) selected @endif>{{$index->nama}}</option>    
                            @endforeach
                        </select>
                        @error('jabatan')
                            <span class="invalid-feedback font-weight-bold">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-control-label">Order Index</label>
                        <input class="form-control @error('order') is-invalid @enderror" name="order" placeholder="Masukkan order index ..." value="{{ $organisasi->order }}">
                        @error('order') <span class="invalid-feedback font-weight-bold">{{ $message }}</span> @enderror
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
<script src="{{ asset('js/selectbootstrap.js') }}"></script>
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
