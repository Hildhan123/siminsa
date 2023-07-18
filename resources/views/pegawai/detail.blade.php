@extends('home.layouts.app')

@section('title', 'Pegawai')

@section('content')
    @include('home.layouts.header')

    <div class="container">
        <div class="border-bottom pb-4">
            <div class="row">
                <div class="col-4">
                    <img
                    @if ($pegawai->photo) src="{{ $pegawai->photo }}" @else src="{{ asset('storage/noavatar.png') }}" @endif
                    class="avatar avatar-medium rounded-circle img-thumbnail" alt="" height="300" width="300">
                </div>
                <div class="col-lg-6 mt-4">
                    <h5>Personal Details :</h5>
                    <div class="mt-4">
                        <div class="media align-items-center"> <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round"
                                class="feather feather-mail fea icon-ex-md text-muted mr-3">
                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z">
                                </path>
                                <polyline points="22,6 12,13 2,6"></polyline>
                            </svg>
                            <div class="media-body">
                                <h6 class="text-primary mb-0">Nama :</h6> <a href="javascript:void(0)"
                                    class="text-muted">{{$pegawai->nama}}</a>
                            </div>
                        </div><br>
                        <div class="media align-items-center"> <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round"
                                class="feather feather-mail fea icon-ex-md text-muted mr-3">
                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z">
                                </path>
                                <polyline points="22,6 12,13 2,6"></polyline>
                            </svg>
                            <div class="media-body">
                                <h6 class="text-primary mb-0">NIP :</h6> <a href="javascript:void(0)"
                                    class="text-muted">{{$pegawai->nip}}</a>
                            </div>
                        </div>
                        <div class="media align-items-center mt-3"> <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round"
                                class="feather feather-globe fea icon-ex-md text-muted mr-3">
                                <circle cx="12" cy="12" r="10"></circle>
                                <line x1="2" y1="12" x2="22" y2="12"></line>
                                <path
                                    d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z">
                                </path>
                            </svg>
                            <div class="media-body">
                                <h6 class="text-primary mb-0">Jabatan :</h6> <a href="javascript:void(0)"
                                    class="text-muted">{{$pegawai->jabatan}}</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end col-->
            </div>
            <!--end row-->
        </div>
    </div>
@endsection
