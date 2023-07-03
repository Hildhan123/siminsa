@extends('layouts.app')

@section('title', 'Edit Navigasi Kelurahan')

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
                                    <h2 class="mb-0">Edit Navigasi</h2>
                                    <p class="mb-0 text-sm">Kelola Navigasi Kelurahan</p>
                                </div>
                                <div class="mb-3">
                                    <a href="{{ route('navbar.index') }}" class="btn btn-success" title="Kembali"><i
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
                    <h3 class="mb-0">Edit navbar</h3>
                </div>
                <div class="card-body">
                    <form autocomplete="off" action="{{ route('navbar.update',$navbar->id) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf @method("PATCH")
                        <div class="form-group">
                            <label class="form-control-label">Title</label>
                            <input class="form-control @error('title') is-invalid @enderror" name="title"
                                placeholder="Masukkan title ..." value="{{ old('title',$navbar->title) }}">
                            @error('title')
                                <span class="invalid-feedback font-weight-bold">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-control-label" for="parent">Parent</label>
                            <select id="parent" name="parent" class="form-control selectpicker" data-live-search="true">
                                <option value="">Pilih parent</option>
                                @foreach ($parent as $index)
                                    <option value="{{ $index->id }}" @if (old('parent') == $index->id || $navbar->parent == $index->id) selected @endif>
                                        {{ $index->title }}</option>
                                @endforeach
                            </select>
                            @error('parent')
                                <span class="invalid-feedback font-weight-bold">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input name="type" type="radio" class="with-gap radioBtn" data-target-id="1" id="radio_1" value="1"@if(old('type') == 1 || $navbar->type == 1) checked @endif>
                            <label for="radio_1">External Url</label>
                            <input name="type" type="radio" class="with-gap radioBtn" data-target-id="2" id="radio_2" value="2"@if(old('type') == 2 || $navbar->type == 2) checked @endif>
                            <label for="radio_2">Site Link</label>
                            <input name="type" type="radio" class="with-gap radioBtn" data-target-id="3" id="radio_3" value="3"@if(old('type') == 3 || $navbar->type == 3) checked @endif>
                            <label for="radio_3">Page</label>
                            <input name="type" type="radio" class="with-gap radioBtn" data-target-id="4" id="radio_4" value="4"@if(old('type') == 4 || $navbar->type == 4) checked @endif>
                            <label for="radio_4">Modul</label>
                        </div>
                        <div class="my-div me_1" data-target="1">
                            <div class="form-group">
                                <label class="form-control-label">URL</label>
                                <input class="form-control @error('tipe1') is-invalid @enderror" name="tipe1"
                                    placeholder="https://google.com" value="{{ old('tipe1', ($navbar->type == 1) ? $navbar->url : '') }}">
                                @error('tipe1')
                                    <span class="invalid-feedback font-weight-bold">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="my-div me_2" data-target="2" style="display: none;">
                            <div class="form-group">
                                <label class="form-control-label">Site link</label>
                                <input class="form-control @error('tipe2') is-invalid @enderror" name="tipe2"
                                    placeholder="/contoh" value="{{ old('tipe2', ($navbar->type == 2) ? $navbar->url : '') }}">
                                @error('tipe2')
                                    <span class="invalid-feedback font-weight-bold">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="my-div me_3" data-target="3" style="display: none;">
                            <div class="form-group">
                                <label class="form-control-label" for="page">Page</label>
                                <select id="page" name="page" class="form-control selectpicker" data-live-search="true">
                                    <option value="">Pilih Page (halaman)</option>
                                    @foreach ($page as $index)
                                    @php $urlPage = "/p/".$index->id."/".Str::slug($index->judul) @endphp
                                        <option value="{{$urlPage}}" @if (old('page') == $urlPage || $navbar->url == $urlPage) selected @endif>
                                            {{ $index->judul }}</option>
                                    @endforeach
                                </select>
                                @error('page')
                                    <span class="invalid-feedback font-weight-bold">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="my-div me_4" data-target="4" style="display: none;">
                            <div class="form-group">
                                <label class="form-control-label" for="modul">Modul</label>
                                <select id="modul" name="modul" class="form-control selectpicker" data-live-search="true">
                                    <option value="">Pilih Modul</option>
                                    @foreach ($modul as $index)
                                        <option value="/{{ $index->slug }}" @if (old('modul') == '/'.$index->slug || $navbar->url == '/'.$index->slug) selected @endif>
                                            {{ $index->nama }}</option>
                                    @endforeach
                                </select>
                                @error('modul')
                                    <span class="invalid-feedback font-weight-bold">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-control-label">Target</label>
                            <select class="form-control @error('target') is-invalid @enderror" name="target" id="target">
                                <option selected value="">Pilih target</option>
                                <option value="" {{ old('target') == null || $navbar->target == null ? 'selected="true"' : ''  }}>Current Window (default)</option>
                                <option value="_blank" {{ old('target') == '_blank' || $navbar->target == '_blank' ? 'selected="true"' : ''  }}>New Window (_blank)</option>
                            </select>
                            @error('target') <span class="invalid-feedback font-weight-bold">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" id="enable" name="enable" checked>
                            <label class="form-check-label" for="enable">
                              Enable
                            </label>
                        </div>
                        <br>
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
            // $('.radioBtn').click(function(){
            //     var target = $(this).data('target-id');
            //     $('.my-div').hide(); 
            //     $('.my-div[data-target="'+target+'"]').show();  
            // }); 
            $('.my-div').hide();

// Tampilkan elemen yang sesuai dengan nilai input radio saat halaman dimuat
            var selectedValue = $('input[name="type"]:checked').val();
            $('.my-div[data-target="' + selectedValue + '"]').show();

            // Event listener untuk perubahan input radio
            $('input[name="type"]').change(function() {
            // Sembunyikan semua elemen dengan class .my-div
            $('.my-div').hide();

            // Tampilkan elemen yang sesuai dengan nilai input radio yang dipilih
            var selectedValue = $(this).val();
            $('.my-div[data-target="' + selectedValue + '"]').show();
            });
                    });
    </script>
@endpush
