@extends('layouts.app')

@section('title', 'Tambah Data')

@section('styles')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
    <style>
        .ikon {
            font-family: fontAwesome;
        }

        .upload-image:hover {
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
                            <div
                                class="d-flex flex-column flex-md-row align-items-center justify-content-center justify-content-md-between text-center text-md-left">
                                <div class="mb-3">
                                    <h2 class="mb-0">Tambah Perangkat Desa</h2>
                                    <p class="mb-0 text-sm">Kelola Perangkat Desa </p>
                                </div>
                                <div class="mb-3">
                                    <a href="{{ route('pegawai.index') }}" class="btn btn-success" title="Kembali"><i
                                            class="fas fa-arrow-left"></i> Kembali</a>
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
                    <h3 class="mb-0">Tambah Pegawai</h3>
                </div>
                <div class="card-body">
                    <form autocomplete="off" action="{{ route('pegawai.store') }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label class="form-control-label">Foto</label>
                            <div class="text-center">
                                <img onclick="$(this).siblings('.images').click()" class="mw-100 upload-image"
                                    style="max-height: 300px" src="{{ asset('storage/upload.jpg') }}" alt="">
                                <input accept="image/*" onchange="uploadImage(this)" type="file" name="photo"
                                    class="images @error('photo') is-invalid @enderror" style="display: none">
                            </div>
                        </div>
                        <div class="form-group">
                            @error('photo')
                                <span class="invalid-feedback font-weight-bold">{{ $message }}</span>
                            @enderror
                            <label class="form-control-label">Nama</label>
                            <input class="form-control @error('nama') is-invalid @enderror" name="nama"
                                placeholder="Masukkan nama ..." value="{{ old('nama') }}">
                            @error('nama')
                                <span class="invalid-feedback font-weight-bold">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-control-label">NIP</label>
                            <input class="form-control @error('nip') is-invalid @enderror" name="nip"
                                placeholder="Masukkan nip ..." value="{{ old('nip') }}">
                            @error('nip')
                                <span class="invalid-feedback font-weight-bold">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input name="tipe_jabatan" type="radio" class="with-gap" id="radio_1" value="struktural"
                                checked="">
                            <label for="radio_1">Struktural</label>
                            <input name="tipe_jabatan" type="radio" class="with-gap" id="radio_2"
                                value="non_struktural">
                            <label for="radio_2">Non-Struktural</label>
                        </div>
                        {{-- <div class="form-group" id="">
                            <label class="form-control-label">Tipe Jabatan</label>
                            <select class="form-control @error('tipe_jabatan') is-invalid @enderror" name="tipe_jabatan"
                                id="tipe_jabatan">
                                <option selected value="">Pilih tipe jabatan</option>
                                <option value="1" {{ old('tipe_jabatan') == 1 ? 'selected="true"' : '' }}>
                                    Struktural
                                </option>
                                <option value="2" {{ old('tipe_jabatan') == 2 ? 'selected="true"' : '' }}>
                                    Non Struktural
                                </option>
                            </select>
                            @error('tipe_jabatan')
                                <span class="invalid-feedback font-weight-bold">{{ $message }}</span>
                            @enderror
                        </div> --}}
                        <div class="form-group" id="struk" style="display:block">
                            <label class="form-control-label" for="jabatan">Jabatan</label>
                            <select id="jabatan1" name="jabatan1" class="form-control selectpicker" data-live-search="true">
                                <option value="" >Pilih Jabatan</option>
                                @foreach ($organisasi as $index)
                                    <option value="{{$index->title}}" @if(old('jabatan') == $index->title) selected @endif>{{$index->title}}</option>    
                                @endforeach
                            </select>
                            @error('jabatan')
                                <span class="invalid-feedback font-weight-bold">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group" id="nonstruk">
                            <label class="form-control-label">Jabatan</label>
                            <input id="jabatan2" class="form-control @error('D') is-invalid @enderror" name="jabatan2"
                                placeholder="Masukkan jabatan ..." value="{{ old('jabatan') }}">
                            @error('jabatan')
                                <span class="invalid-feedback font-weight-bold">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-control-label">Deskripsi</label>
                            <textarea class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi">{{ old('deskripsi') }}</textarea>
                            @error('deskripsi')
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
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.js"></script>
    <script>
        function uploadImage(inputFile) {
            if (inputFile.files && inputFile.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $(inputFile).siblings('img').attr("src", e.target.result);
                }
                reader.readAsDataURL(inputFile.files[0]);
            }
        }
        $(document).ready(function() {
            $(document).on("submit", "form", function() {
                $(this).children("button:submit").attr('disabled', 'disabled');
                $(this).children("button:submit").html(
                    `<img height="20px" src="{{ url('/storage/loading.gif') }}" alt=""> Loading ...`);
            });

            $("textarea").summernote({
                dialogsInBody: true,
                placeholder: 'Silahkan isi deskripsi',
                tabsize: 2,
                height: 300
            });

            $('input[name="tipe_jabatan"]').on('change', function(ev) {
                if ($(this).is(':checked')) {
                    var nonstruk = document.getElementById("nonstruk");
                    var struk = document.getElementById("struk");
                    // var jabatan1 = document.getElementById("jabatan1").value
                    // var jabatan2 = document.getElementById("jabatan2").value
                    if (nonstruk.style.display === "none") {
                        nonstruk.style.display = "block";
                        struk.style.display = "none";
                        document.getElementById("jabatan1").value = '';
                    } else {
                        nonstruk.style.display = "none";
                        struk.style.display = "block";
                        document.getElementById("jabatan2").value = '';
                    }
                }
            }).trigger('change');
        })
    </script>
@endpush
