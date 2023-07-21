@php
    $sambutan = DB::table('template')->where([
            'user_id' => $desa->user_id,
            'key' => 'sambutan',
        ])->first();
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
@endif