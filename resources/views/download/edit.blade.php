@extends('layouts.app')

@section('title', 'Edit Data')

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
                                    <h2 class="mb-0">Download</h2>
                                    <p class="mb-0 text-sm">Kelola File Download</p>
                                </div>
                                <div class="mb-3">
                                    <a href="{{ route('download.index') }}" class="btn btn-success" title="Kembali"><i
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
                    <h3 class="mb-0">Edit Data</h3>
                </div>
                <div class="card-body">
                    <form autocomplete="off" action="{{route('download.update',$download->id)}}" method="post" enctype="multipart/form-data">
                        @csrf @method('PATCH')
                        <div class="form-group">
                            <label class="form-control-label">Nama File</label>
                            <input class="form-control @error('nama') is-invalid @enderror" name="nama"
                                placeholder="Masukkan nama ..." value="{{$download->nama}}">
                            @error('nama')
                                <span class="invalid-feedback font-weight-bold">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-control-label">Keterangan</label>
                            <input class="form-control @error('keterangan') is-invalid @enderror" name="keterangan"
                                placeholder="Masukkan keterangan ..." value="{{ $download->keterangan }}">
                            @error('keterangan')
                                <span class="invalid-feedback font-weight-bold">{{ $message }}</span>
                            @enderror
                        </div>
                        {{-- <div class="form-group">
                        <label class="form-control-label">Jenis File</label>
                        <select class="form-control @error('tipe') is-invalid @enderror" name="tipe" id="tipe">
                            <option selected value="">Pilih jenis file</option>
                            <option value="Internal" {{ old('tipe') == 'Internal' ? 'selected="true"' : ''  }}>Internal</option>
                            <option value="Eksternal" {{ old('tipe') == 'Eksternal' ? 'selected="true"' : ''  }}>Eksternal</option>
                        </select>
                        @error('tipe') <span class="invalid-feedback font-weight-bold">{{ $message }}</span> @enderror
                    </div> --}}
                        @if ($download->tipe == 'internal')
                        <div class="form-group">
                            <input name="tipe" type="radio" class="with-gap" id="radio_1" value="internal" checked>
                            <label for="radio_1">Internal</label>
                        </div>
                        <div class="form-group" id="internal" style="display:block">
                            <label class="form-control-label">File</label>
                            <a href="{{$download->file}}">Lihat File Sebelumya</a>
                            <input type="file" class="form-control @error('file1') is-invalid @enderror" name="file1"
                                placeholder="Masukkan file ..." value="{{ old('file1') }}">
                            @error('file1')
                                <span class="invalid-feedback font-weight-bold">{{ $message }}</span>
                            @enderror
                        </div>
                        @else
                        <div class="form-group">
                            <input name="tipe" type="radio" class="with-gap" id="radio_2" value="eksternal" checked>
                            <label for="radio_2">Eksternal</label>
                        </div>
                        <div class="form-group" id="eksternal">
                            <label class="form-control-label">File</label>
                            <a href="{{$download->file}}">Lihat File Sebelumya</a>
                            <input type="url" class="form-control @error('file2') is-invalid @enderror" name="file2"
                                placeholder="Masukkan url file ..." value="{{ $download->file }}">
                            @error('file2')
                                <span class="invalid-feedback font-weight-bold">{{ $message }}</span>
                            @enderror
                        </div>
                        @endif
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
                placeholder: 'Silahkan isi konten',
                tabsize: 2,
                height: 300
            });
            // $('input[name="tipe"]').on('change', function(ev) {
            //     if ($(this).is(':checked')) {
            //         var eksternal = document.getElementById("eksternal");
            //         var internal = document.getElementById("internal");
            //         // var jabatan1 = document.getElementById("jabatan1").value
            //         // var jabatan2 = document.getElementById("jabatan2").value
            //         if (eksternal.style.display === "none") {
            //             eksternal.style.display = "block";
            //             internal.style.display = "none";
            //             document.getElementById("jabatan1").value = '';
            //         } else {
            //             eksternal.style.display = "none";
            //             internal.style.display = "block";
            //             document.getElementById("jabatan2").value = '';
            //         }
            //     }
            // }).trigger('change');
        });
    </script>
@endpush
