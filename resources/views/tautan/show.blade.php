@extends('home.layouts.app')

@section('title', 'Lembaga Desa')

@section('content')
    @include('home.layouts.header')

    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-12 mb-4 pb-2">
                <div class="card blog rounded border-0 shadow overflow-hidden h-100">
                    <div class="row align-items-center no-gutters">
                        <div class="col-md-6"> <img
                                src="http://sumberejo-mranggen.desa.id/assets/files/data/website-desa-sumberejo-3321012003/images/nomor_penting2.jpg"
                                class="img-fluid" alt="">
                            <div class="overlay bg-dark"></div>
                        </div>
                        <div class="col-md-6">
                            <div class="card-body content">
                                <h5><a href="http://sumberejo-mranggen.desa.id/layanan/akses-masyarakat-sumberejo-pada-standar-pelayanan-minimum-spm"
                                        class="card-title title text-dark">AKSES MASYARAKAT SUMBEREJO PADA STANDAR PELAYANAN
                                        MINIMUM (SPM)</a></h5>
                                <p class="text-muted mb-0">AKSES MASYARAKAT SUMBEREJO PADA STANDAR PELAYANAN MINIMUM (SPM)
                                    Sebagai komitmen terhadap Penguatan Kualitas Publik, masyarakat Desa Sumberejo dapa…</p>
                                <div class="post-meta d-flex justify-content-between mt-3"> <a
                                        href="{{route('layanan.detail')}}"
                                        class="text-muted readmore">Read More <i class="mdi mdi-chevron-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-12 mb-4 pb-2">
                <div class="card blog rounded border-0 shadow overflow-hidden h-100">
                    <div class="row align-items-center no-gutters">
                        <div class="col-md-6"> <img
                                src="http://sumberejo-mranggen.desa.id/assets/files/data/website-desa-sumberejo-3321012003/images/Jenis_Layanan_800X600.jpg"
                                class="img-fluid" alt="">
                            <div class="overlay bg-dark"></div>
                        </div>
                        <div class="col-md-6">
                            <div class="card-body content">
                                <h5><a href="http://sumberejo-mranggen.desa.id/layanan/jenis-layanan-dan-kelengkapan-yang-dibutuhkan"
                                        class="card-title title text-dark">Jenis Layanan dan Kelengkapan yang Dibutuhkan</a>
                                </h5>
                                <p class="text-muted mb-0">SEMUA PELAYANAN DI DESA SUMBEREJO BERSIFAT GRATIS!
                                    Dasar:&nbsp;Perkades 141/13 Tahun 2022 tentang Standar Pelayanan Minimal Pemdes
                                    Sumberejo</p>
                                <div class="post-meta d-flex justify-content-between mt-3"> <a
                                        href="http://sumberejo-mranggen.desa.id/layanan/jenis-layanan-dan-kelengkapan-yang-dibutuhkan"
                                        class="text-muted readmore">Read More <i class="mdi mdi-chevron-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-12 mb-4 pb-2">
                <div class="card blog rounded border-0 shadow overflow-hidden">
                    <div class="row align-items-center no-gutters">
                        <div class="col-md-6"> <img
                                src="http://sumberejo-mranggen.desa.id/assets/files/data/website-desa-sumberejo-3321012003/images/3. mini x banner 25x40 cm - pengaduan cetak 3x.jpg"
                                class="img-fluid" alt=""> <img
                                src="http://sumberejo-mranggen.desa.id/assets/files/data/website-desa-sumberejo-3321012003/gallery/kotak_aduan_saran_001.jpg"
                                class="img-fluid" alt="">
                            <div class="overlay bg-dark"></div>
                        </div>
                        <div class="col-md-6">
                            <div class="card-body content">
                                <h5><a href="http://sumberejo-mranggen.desa.id/layanan/layanan-aduan-masyarakat-sumberejo"
                                        class="card-title title text-dark">Layanan Aduan Masyarakat Sumberejo</a></h5>
                                <p class="text-muted mb-0">MENEMUKAN PELANGGARAN OLEH PERANGKAT DESA? JANGAN DIAM, LAPORKAN!
                                    Berdasarkan Keputusan Kepala Desa Sumberejo No 141/12&nbsp;Tahun 2022 tentang Lay…</p>
                                <div class="post-meta d-flex justify-content-between mt-3"> <a
                                        href="http://sumberejo-mranggen.desa.id/layanan/layanan-aduan-masyarakat-sumberejo"
                                        class="text-muted readmore">Read More <i class="mdi mdi-chevron-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-12 mb-4 pb-2">
                <div class="card blog rounded border-0 shadow overflow-hidden">
                    <div class="row align-items-center no-gutters">
                        <div class="col-md-6"> <img
                                src="http://sumberejo-mranggen.desa.id/assets/files/data/website-desa-sumberejo-3321012003/images/Maklumat_Pelayanan2.jpg"
                                class="img-fluid" alt="">
                            <div class="overlay bg-dark"></div>
                        </div>
                        <div class="col-md-6">
                            <div class="card-body content">
                                <h5><a href="http://sumberejo-mranggen.desa.id/layanan/maklumat-pelayanan"
                                        class="card-title title text-dark">Maklumat Pelayanan</a></h5>
                                <p class="text-muted mb-0"></p>
                                <div class="post-meta d-flex justify-content-between mt-3"> <a
                                        href="http://sumberejo-mranggen.desa.id/layanan/maklumat-pelayanan"
                                        class="text-muted readmore">Read More <i class="mdi mdi-chevron-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
