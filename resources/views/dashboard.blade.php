@extends('layouts.app')

@section('title', 'Dashboard')

@section('styles')
{{-- <script src="https://code.highcharts.com/stock/highstock.js"></script>
<script src="https://code.highcharts.com/stock/modules/exporting.js"></script>
<script src="https://code.highcharts.com/stock/modules/accessibility.js"></script> --}}
<link href="{{ asset('/css/style.css') }}" rel="stylesheet">
<link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('content-header')
<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-3 col-md-6 col-sm-6 mb-3">
                <div class="card card-stats shadow h-100">
                    <!-- Card body -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0">Total Struktur Organisasi</h5>
                                <span class="h2 font-weight-bold mb-0">{{$organisasi}}</span>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
                                    <i class="fas fa-users"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 col-sm-6 mb-3">
                <div class="card card-stats shadow h-100">
                    <!-- Card body -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0">Total Perangkat Kelurahan</h5>
                                <span class="h2 font-weight-bold mb-0">{{$pegawai}}</span>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
                                    <i class="fas fa-user"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 col-sm-6 mb-3">
                <div class="card card-stats shadow h-100">
                    <!-- Card body -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0">Total Lembaga Kelurahan</h5>
                                <span class="h2 font-weight-bold mb-0">{{$lembaga}}</span>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
                                    <i class="fas fa-building"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 col-sm-6 mb-3">
                {{-- <div class="card card-stats shadow h-100">
                    <!-- Card body -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0">Total Perempuan</h5>
                                <span class="h2 font-weight-bold mb-0">0</span>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape bg-gradient-pink text-white rounded-circle shadow">
                                    <i class="fas fa-user"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>
            <div class="col-xl-3 col-md-6 col-sm-6 mb-3">
                <div class="card card-stats shadow h-100">
                    <!-- Card body -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0">Total Pages</h5>
                                <span class="h2 font-weight-bold mb-0">{{$page}}</span>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape bg-gradient-success text-white rounded-circle shadow">
                                    <i class="fas fa-atlas"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 col-sm-6 mb-3">
                <div class="card card-stats shadow h-100">
                    <!-- Card body -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0">Total Navigasi</h5>
                                <span class="h2 font-weight-bold mb-0">{{$navbar}}</span>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape bg-gradient-success text-white rounded-circle shadow">
                                    <i class="fas fa-bars"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 col-sm-6 mb-3">
                {{-- <div class="card card-stats shadow h-100">
                    <!-- Card body -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0">Total Berita</h5>
                                <span class="h2 font-weight-bold mb-0">{{ $tahun }}</span>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                                    <i class="fas fa-file-alt"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>
            <div class="col-xl-3 col-md-6 col-sm-6 mb-3">
                {{-- <div class="card card-stats shadow h-100">
                    <!-- Card body -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0">Total Galeri</h5>
                                <span class="h2 font-weight-bold mb-0">{{ $totalCetakSurat }}</span>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
                                    <i class="fas fa-file-alt"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>
            <div class="col-xl-3 col-md-6 col-sm-6 mb-3">
                <div class="card card-stats shadow h-100">
                    <!-- Card body -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0">Total Berita</h5>
                                <span class="h2 font-weight-bold mb-0">{{$berita}}</span>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape bg-gradient-cyan text-white rounded-circle shadow">
                                    <i class="fas fa-newspaper"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 col-sm-6 mb-3">
                <div class="card card-stats shadow h-100">
                    <!-- Card body -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0">Total Galeri</h5>
                                <span class="h2 font-weight-bold mb-0">{{$galeri}}</span>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape bg-gradient-cyan text-white rounded-circle shadow">
                                    <i class="fas fa-image"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 col-sm-6 mb-3">
                <div class="card card-stats shadow h-100">
                    <!-- Card body -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0">Total Pengumuman</h5>
                                <span class="h2 font-weight-bold mb-0">{{$pengumuman}}</span>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape bg-gradient-cyan text-white rounded-circle shadow">
                                    <i class="fas fa-newspaper"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 col-sm-6 mb-3">
                <div class="card card-stats shadow h-100">
                    <!-- Card body -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0">Total Agenda</h5>
                                <span class="h2 font-weight-bold mb-0">{{$agenda}}</span>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape bg-gradient-cyan text-white rounded-circle shadow">
                                    <i class="fas fa-newspaper"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 col-sm-6 mb-3">
                <div class="card card-stats shadow h-100">
                    <!-- Card body -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0">Total Layanan</h5>
                                <span class="h2 font-weight-bold mb-0">{{$layanan}}</span>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape bg-gradient-cyan text-white rounded-circle shadow">
                                    <i class="fas fa-newspaper"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 col-sm-6 mb-3">
                <div class="card card-stats shadow h-100">
                    <!-- Card body -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0">Total Download</h5>
                                <span class="h2 font-weight-bold mb-0">{{$download}}</span>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape bg-gradient-cyan text-white rounded-circle shadow">
                                    <i class="fas fa-file-download"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 col-sm-6 mb-3">
                <div class="card card-stats shadow h-100">
                    <!-- Card body -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0">Total Produk</h5>
                                <span class="h2 font-weight-bold mb-0">{{$produk}}</span>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape bg-gradient-cyan text-white rounded-circle shadow">
                                    <i class="fas fa-newspaper"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 col-sm-6 mb-3">
                <div class="card card-stats shadow h-100">
                    <!-- Card body -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0">Total Potensi</h5>
                                <span class="h2 font-weight-bold mb-0">{{$potensi}}</span>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape bg-gradient-cyan text-white rounded-circle shadow">
                                    <i class="fas fa-newspaper"></i>
                                </div>
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
<div class="row mt-4 justify-content-center">
    <div class="single-service bg-white rounded shadow container">
        <h2>Users Activity</h2>
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead align="center">
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Nama</th>
                        <th>Action</th>
                        <th>Ip Address</th>
                        <th>Browser User-Agent</th>
                    </tr>
                </thead>
                <tbody>
                    @php $no = 1 @endphp
                    @forelse ($log as $index)
                        <tr>
                            <td data-title="No">{{ $no++ }}</td>
                            <td data-title="Tanggal">{{ $index->created_at }}</td>
                            <td data-title="Nama">{{ $index->nama }}</td>
                            <td data-title="Action">{{ $index->action }}</td>
                            <td data-title="Ip Address">{{ $index->ip }}</td>
                            <td data-title="Browser User-Agent">{{ $index->browser_user_agent }}</td>
                        </tr>
                    @empty
                        <tr>
                            Tidak Ada data
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    {{-- <div class="col">
<div class="single-service bg-white rounded shadow">
<h4>Data belum tersedia</h4>
</div>
</div> --}}
</div>
{{-- <div class="row">
    <div class="col-lg-6 mb-4">
        <div class="card shadow h-100">
            <div class="card-header">
                <div
                    class="d-flex flex-column flex-md-row align-items-center justify-content-center justify-content-lg-between text-center text-lg-left">
                    <div class="mb-1">
                        <h2 class="mb-0">Grafik Cetak Surat Harian</h2>
                    </div>
                    <div class="mb-1">
                        <input type="date" name="tanggal" id="tanggal" class="form-control-sm" value="{{ date('Y-m-d') }}">
                        <img id="loading-tanggal-surat" src="{{ asset(Storage::url('loading.gif')) }}" alt="Loading" height="20px" style="display: none">
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div id="chart-harian" style="height: 400px; margin: 0 auto"></div>
            </div>
        </div>
    </div>
    <div class="col-lg-6 mb-4">
        <div class="card shadow h-100">
            <div class="card-header font-weight-bold">
                <div
                    class="d-flex flex-column flex-md-row align-items-center justify-content-center justify-content-lg-between text-center text-lg-left">
                    <div class="mb-1">
                        <h2 class="mb-0">Grafik Cetak Surat Bulanan</h2>
                    </div>
                    <div class="mb-1">
                        <input type="month" name="bulan" id="bulan" class="form-control-sm" value="{{ date('Y-m') }}">
                        <img id="loading-bulan-surat" src="{{ asset(Storage::url('loading.gif')) }}" alt="Loading" height="20px" style="display: none">
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div id="chart-bulanan" style="height: 400px; margin: 0 auto"></div>
            </div>
        </div>
    </div>
    <div class="col-md-12 mb-4">
        <div class="card shadow h-100">
            <div class="card-header font-weight-bold">
                <div
                    class="d-flex flex-column flex-md-row align-items-center justify-content-center justify-content-lg-between text-center text-lg-left">
                    <div class="mb-1">
                        <h2 class="mb-0">Grafik Cetak Surat Tahunan</h2>
                    </div>
                    <div class="mb-1">
                        Tahun : <input type="number" name="tahun" id="tahun" class="form-control-sm" value="{{ date('Y') }}" style="width:80px">
                        <img id="loading-tahun-surat" src="{{ asset(Storage::url('loading.gif')) }}" alt="Loading" height="20px" style="display: none">
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div id="chart-tahunan" style="height: 400px; margin: 0 auto"></div>
            </div>
        </div>
    </div>
    @include('statistik-penduduk.card')
    <div class="col-md-12 mb-4">
        <div class="card shadow h-100">
            <div class="card-header">
                <div class="d-flex flex-column flex-md-row align-items-center justify-content-center justify-content-lg-between text-center text-lg-left">
                    <div class="mb-1">
                        <h2 class="mb-0">Grafik Pelaksanaan APBDes</h2>
                    </div>
                    <div class="mb-1">
                        Tahun : <input type="number" name="tahun-apbdes" id="tahun-apbdes" class="form-control-sm" value="{{ date('Y') }}" style="width:80px">
                        <img id="loading-tahun" src="{{ asset(Storage::url('loading.gif')) }}" alt="Loading" height="20px" style="display: none">
                    </div>
                </div>
            </div>
            <div class="card-body">
                @include('anggaran-realisasi.grafik-apbdes')
            </div>
        </div>
    </div>
</div> --}}
@endsection

@push('scripts')
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable(); 
        })
    </script>
{{--  <script src="{{ asset('js/apbdes.js') }}"></script>
<script src="{{ asset('js/statistik-penduduk.js') }}"></script>
<script>
    let bar = {
        chart: {
            type: 'bar',
        },
        xAxis: {
            type: 'category',
            title: {
                text: null
            },
            min: 0,
            max: 4,
            scrollbar: {
                enabled: true
            },
            tickLength: 0
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Jumlah Cetak',
                align: 'high'
            }
        },
        plotOptions: {
            bar: {
                dataLabels: {
                    enabled: true
                }
            }
        },
        legend: {
            enabled: false
        },
        credits: {
            enabled: false
        },
        series: [{
            name: 'Jumlah Cetak',
            data: []
        }]
    };

    let chart_harian = Highcharts.chart('chart-harian', bar);
    chart_harian.title.textSetter("Grafik Cetak Surat Harian");

    let chart_bulanan = Highcharts.chart('chart-bulanan', bar);
    chart_bulanan.title.textSetter("Grafik Cetak Surat Bulanan");

    let chart_tahunan = Highcharts.chart('chart-tahunan', bar);
    chart_tahunan.title.textSetter("Grafik Cetak Surat Tahunan");

    $(document).ready(function(){
        $("#loading-tanggal-surat").css('display','');
        $("#loading-bulan-surat").css('display','');
        $("#loading-tahun-surat").css('display','');
        $("#tanggal").css('display','none');
        $("#bulan").css('display','none');
        $("#tahun").css('display','none');

        $.get("{{ route('surat-harian') }}", function (response) {
            $("#loading-tanggal-surat").css('display','none');
            $("#tanggal").css('display','');
            chart_harian.series[0].setData(response);
        });

        $.get("{{ route('surat-bulanan') }}", function (response) {
            $("#loading-bulan-surat").css('display','none');
            $("#bulan").css('display','');
            chart_bulanan.series[0].setData(response);
        });

        $.get("{{ route('surat-tahunan') }}", function (response) {
            $("#loading-tahun-surat").css('display','none');
            $("#tahun").css('display','');
            chart_tahunan.series[0].setData(response);
        });

        $("#tanggal").change(function () {
            $("#loading-tanggal-surat").css('display','');
            $("#tanggal").css('display','none');
            $.get("{{ route('surat-harian') }}", {'tanggal': $(this).val()}, function (response) {
                $("#tanggal").css('display','');
                $("#loading-tanggal-surat").css('display','none');
                chart_harian.series[0].setData(response);
            });
        });

        $("#bulan").change(function () {
            $("#loading-bulan-surat").css('display','');
            $("#bulan").css('display','none');
            $.get("{{ route('surat-bulanan') }}", {'bulan': $(this).val()}, function (response) {
                $("#bulan").css('display','');
                $("#loading-bulan-surat").css('display','none');
                chart_bulanan.series[0].setData(response);
            });
        });

        $("#tahun").change(function () {
            $("#loading-tahun-surat").css('display','');
            $("#tahun").css('display','none');
            $.get("{{ route('surat-tahunan') }}", {'tahun': $(this).val()}, function (response) {
                $("#tahun").css('display','');
                $("#loading-tahun-surat").css('display','none');
                chart_tahunan.series[0].setData(response);
            });
        });
    });
</script> --}}
@endpush
