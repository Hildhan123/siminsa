@php
use Carbon\Carbon;
    $sambutan = DB::table('template')->where([
            'user_id' => $desa->user_id,
            'key' => 'sambutan',
        ])->first();

    $online = DB::table('pengunjung')->where('updated_at', '>=', Carbon::now()->subMinutes(120))->count();
    $kunjunganHariIni = DB::table('pengunjung')->whereDate('waktu_kunjungan', Carbon::today())->count();
    $kunjunganBulanIni = DB::table('pengunjung')->whereMonth('waktu_kunjungan', Carbon::now()->month)->count();
    $kunjunganTahunIni = DB::table('pengunjung')->whereYear('waktu_kunjungan', Carbon::now()->year)->count();
@endphp
<div class="wow fadeInUp" data-wow-delay="0.3s">
    <div class="team-item p-4 text-center">
        <h5 class="mb-0">Info Geografis</h5><br>
        <div class="overflow-hidden mb-4">
            {!! $desa->iframe !!}
        </div>
        <p class="text-bold">Kelurahan {{$desa->nama_kelurahan}}</p>
        <p>{{$desa->alamat}} {{$desa->kodepos}}</p>
        <p>{{$desa->kontak}}</p>
    </div>
</div>
@if($sambutan->active == 1)
<hr>
<div class="wow fadeInUp" data-wow-delay="0.3s">
    <div class="team-item p-4 text-center">
        <div class="overflow-hidden mb-4">
            <img class="img-fluid" @if($sambutan->photo) src="{{$sambutan->photo}}" @else src="{{ asset('tema1/img/pejabat.png') }}" @endif alt="">
        </div>
        <h5 class="mb-0">{{$sambutan->title}}</h5><br>
        {!! $sambutan->konten !!}
    </div>
</div>
<hr>
<div class="wow fadeInUp" data-wow-delay="0.3s">
    <div class="team-item p-4 ">
        <h2 class="mb-4">Statistik Kunjungan</h2>

        <ul class="list-unstyled">
            <li>
                <i class="fas fa-users text-primary"></i>
                <span>Sedang Online : {{ $online }}</span>
            </li>
            <li>
                <i class="far fa-calendar-check text-primary"></i>
                <span>Kunjungan Hari Ini : {{ $kunjunganHariIni }}</span>
            </li>
            <li>
                <i class="far fa-calendar-alt text-primary"></i>
                <span>Kunjungan Bulan Ini : {{ $kunjunganBulanIni }}</span>
            </li>
            <li>
                <i class="far fa-calendar text-primary"></i>
                <span>Kunjungan Tahun Ini : {{ $kunjunganTahunIni }}</span>
            </li>
        </ul>
    </div>
</div>
@endif