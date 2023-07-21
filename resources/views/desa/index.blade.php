@extends('layouts.app')

@section('title')
    Profil Kelurahan
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/jquery.fancybox.css') }}">
@endsection

@section('content-header')
    <div class="header pb-8 pt-5 pt-lg-8 d-flex align-items-center"
        style="background-image: url({{ asset('/img/cover-bg-profil.jpg') }}); background-size: cover; background-position: center top;">

        <!-- Mask -->
        <span class="mask bg-gradient-primary opacity-6"></span>
        <!-- Header container -->
        <div class="container-fluid d-flex align-items-center">

            <div class="row">
                <div class="col-lg-7 col-md-10">
                    <h1 class="display-2 text-white">Kelurahan {{ $desa->nama_kelurahan }}</h1>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-xl-4 order-xl-2 mb-5 mb-xl-0">
            <div class="card card-profile shadow">
                <div class="row justify-content-center">
                    <div class="col-lg-3 order-lg-2">
                        <div class="card-profile-image">
                            <a href="{{ asset(Storage::url($desa->logo)) }}" data-fancybox>
                                <img id="logo" src="{{ asset(Storage::url($desa->logo)) }}"
                                    alt="{{ asset(Storage::url($desa->logo)) }}" class="rounded-circle"
                                    style="height: 150px; width: 150px; object-fit: cover">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-header text-center border-0 pt-md-4 pb-0 pb-md-4">
                    <a id="" href="#" class="btn btn-sm mt-5"></a>
                </div>
                <div class="card-body pt-0 pt-md-4 pt-5">
                    <div class="text-center">
                        <h3>
                            Kelurahan {{ $desa->nama_kelurahan }}
                        </h3>
                        <div class="h5 font-weight-300">
                            Kec. Demak, Kab. Demak
                        </div>
                        <hr>
                        <h3>
                            Maps
                        </h3>
                        @if ($desa->iframe)
                            {!! $desa->iframe !!}
                        @else
                            Tidak Ada Data
                        @endif
                        <br>
                        {{-- <h3>
                            Perbarui Maps
                        </h3>
                        <div class="h5 font-weight-300">
                            *Copy paste link dari share Embed Map dari Gmaps dengan custom size 300x300
                        </div>
                        <form action="{{ route('iframe', ['desa' => $desa]) }}" method="POST">
                            @csrf @method('patch')
                            <div class="form-group">
                                <input name="iframe" type="name" id="iframe"
                                    class="form-control form-control-alternative @error('iframe') is-invalid @enderror"
                                    placeholder='<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15392.706102968958!2d110.63238986765374!3d-6.8981869786563506!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e70ebe97924f94d%3A0x1724549a1b1e8797!2sMasjid%20Agung%20Demak!5e0!3m2!1sen!2sid!4v1689815801207!5m2!1sen!2sid" width="300" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>'
                                    value="{{ old('iframe', $desa->iframe) }}">
                                @error('iframe')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Simpan</button>
                        </form> --}}
                    </div>
                </div>

            </div>
        </div>
        <div class="col-xl-8 order-xl-1">
            <div class="card bg-secondary shadow h-100">
                <div class="card-header bg-white border-0">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">Informasi Profil Kelurahan</h3>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @include('layouts.components.alert')
                    <form action="{{ route('update-desa', ['desa' => $desa]) }}" method="POST">
                        @csrf @method('patch')
                        <div class="form-group">
                            <label class="form-control-label" for="nama_kelurahan">Nama Kelurahan</label>
                            <input name="nama_kelurahan" type="name" id="nama_kelurahan"
                                class="form-control form-control-alternative @error('nama_kelurahan') is-invalid @enderror"
                                placeholder="Masukkan nama kelurahan"
                                value="{{ old('nama_kelurahan', $desa->nama_kelurahan) }}">
                            @error('nama_kelurahan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-control-label" for="alamat">Alamat</label>
                            <input name="alamat" id="alamat"
                                class="form-control form-control-alternative @error('alamat') is-invalid @enderror"
                                placeholder="Masukkan alamat" value="{{ old('alamat', $desa->alamat) }}">
                            @error('alamat')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-control-label" for="kodepos">Kodepos</label>
                            <input name="kodepos" type="number" id="kodepos"
                                class="form-control form-control-alternative @error('kodepos') is-invalid @enderror"
                                placeholder="Masukkan kodepos" value="{{ old('kodepos', $desa->kodepos) }}">
                            @error('kodepos')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-control-label" for="kontak">Kontak</label>
                            <input name="kontak" type="number" id="kontak"
                                class="form-control form-control-alternative @error('kontak') is-invalid @enderror"
                                placeholder="Masukkan kontak" value="{{ old('kontak', $desa->kontak) }}">
                            @error('kontak')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-control-label" for="iframe">Maps</label>
                            <input name="iframe" type="name" id="iframe"
                                class="form-control form-control-alternative @error('iframe') is-invalid @enderror"
                                placeholder='<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15392.706102968958!2d110.63238986765374!3d-6.8981869786563506!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e70ebe97924f94d%3A0x1724549a1b1e8797!2sMasjid%20Agung%20Demak!5e0!3m2!1sen!2sid!4v1689815801207!5m2!1sen!2sid" width="300" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>'
                                value="{{ old('iframe', $desa->iframe) }}">
                            @error('iframe')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <p>*Copy paste link dari share Embed Map dari Gmaps dengan custom size 300x300</p>
                        </div>
                        {{-- <div class="form-group">
                        <label class="form-control-label" for="nama_kecamatan">Nama Kecamatan</label>
                        <input name="nama_kecamatan" type="text" id="nama_kecamatan" class="form-control form-control-alternative @error('nama_kecamatan') is-invalid @enderror" placeholder="Masukkan nama desa" value="{{ old('nama_kecamatan',$desa->nama_kecamatan) }}">
                        @error('nama_kecamatan')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-control-label" for="nama_kabupaten">Nama Kabupaten</label>
                        <input name="nama_kabupaten" type="text" id="nama_kabupaten" class="form-control form-control-alternative @error('nama_kabupaten') is-invalid @enderror" placeholder="Masukkan nama desa" value="{{ old('nama_kabupaten',$desa->nama_kabupaten) }}">
                        @error('nama_kabupaten')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div> --}}
                        {{-- <div class="form-group">
                        <label class="form-control-label" for="alamat">Alamat</label>
                        <input name="alamat" type="text" id="alamat" class="form-control form-control-alternative @error('alamat') is-invalid @enderror" placeholder="Masukkan nama desa" value="{{ old('alamat',$desa->alamat) }}">
                        @error('alamat')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-control-label" for="nama_kepala_desa">Nama Kepala Desa</label>
                        <input name="nama_kepala_desa" type="text" id="nama_kepala_desa" class="form-control form-control-alternative @error('nama_kepala_desa') is-invalid @enderror" placeholder="Masukkan nama desa" value="{{ old('nama_kepala_desa',$desa->nama_kepala_desa) }}">
                        @error('nama_kepala_desa')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-control-label" for="alamat_kepala_desa">Alamat Kepala Desa</label>
                        <input name="alamat_kepala_desa" type="text" id="alamat_kepala_desa" class="form-control form-control-alternative @error('alamat_kepala_desa') is-invalid @enderror" placeholder="Masukkan nama desa" value="{{ old('alamat_kepala_desa',$desa->alamat_kepala_desa) }}">
                        @error('alamat_kepala_desa')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div> --}}
                        <button type="submit" class="btn btn-primary btn-block">Simpan Perubahan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <input type="file" name="logo" id="input-logo" style="display: none">
@endsection

@push('scripts')
    <script src="{{ asset('js/jquery.fancybox.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#btn-ganti-logo').on('click', function() {
                $('#input-logo').click();
            });

            $(document).on("submit", "form", function() {
                $(this).children("button:submit").attr('disabled', 'disabled');
                $(this).children("button:submit").html(
                    `<img height="20px" src="{{ url('/storage/loading.gif') }}" alt=""> Loading ...`);
            });

            $('#input-logo').on('change', function() {
                if (this.files && this.files[0]) {
                    let formData = new FormData();
                    let oFReader = new FileReader();
                    formData.append("logo", this.files[0]);
                    formData.append("_method", "patch");
                    formData.append("_token", "{{ csrf_token() }}");
                    oFReader.readAsDataURL(this.files[0]);

                    $.ajax({
                        url: "{{ route('update-desa', $desa) }}",
                        type: 'POST',
                        data: formData,
                        contentType: false,
                        cache: false,
                        processData: false,
                        beforeSend: function() {
                            $('#img-logo').attr('src', "{{ url('/storage/loading.gif') }}");
                        },
                        success: function(data) {
                            if (data.error) {
                                $('#img-logo').attr('src', $("#img-logo").attr('alt'));
                            } else {
                                location.reload();
                            }
                        }
                    });
                }
            });
        });
    </script>
@endpush
