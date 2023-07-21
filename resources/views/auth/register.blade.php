@extends('layouts.layout')

@section('title', 'Register')

@section('header')
    <h1 class="text-white">Register</h1>
    <p class="text-lead text-light">Silahkan Daftar Terlebih Dahulu</p>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-5 col-md-7">
        <div class="card bg-secondary shadow border-0">
            <div class="card-body px-lg-5 py-lg-5">
                <div class="text-center text-muted mb-4">
                    <small>Register</small>
                </div>
                <div class="text-center mb-4">
                    <img height="150px" src="{{ url('/storage/logo.png') }}" alt="logo">
                </div>
                <form role="form" action="{{ route('register') }}" method="POST">
                    @csrf
                    <div id="profil">
                        <div class="form-group mb-3">
                            <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                </div>
                                <input class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email" type="email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-circle-08"></i></span>
                                </div>
                                <input class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" placeholder="Nama" type="name">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                </div>
                                <input class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password" type="password" value="{{ old('password') }}">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                </div>
                                <input class="form-control" name="password_confirmation" required autocomplete="current-password" placeholder="Konfirmasi Password" type="password" value="{{ old('password_confirmation') }}">
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary my-4">Daftar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        $(document).on("submit","form", function () {
            $(this).find("button:submit").attr('disabled','disabled');
            $(this).find("button:submit").html(`<img height="20px" src="{{ url('/storage/loading.gif') }}" alt=""> Loading ...`);
        });
    });
</script>
@endpush