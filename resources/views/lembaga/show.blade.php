@extends('home.layouts.app')

@section('title', 'Lembaga Kelurahan')

@section('style')
    <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('content')
    @include('home.layouts.header')

    <div class="container">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead align="center">
                    <tr>
                        <th>No</th>
                        <th>Logo</th>
                        <th>Nama</th>
                        <th>Singkatan</th>
                        <th>Dasar Hukum</th>
                        <th>Alamat</th>
                        {{-- <th>Profil</th> --}}
                        <th>Aksi</th>

                    </tr>
                </thead>
                <tbody>
                    @php $no = 1 @endphp
                    @forelse ($lembaga as $index)
                        <tr>
                            <td data-title="No">{{ $no++ }}</td>
                            <td data-title="Logo">
                                @if ($index->logo)
                                    <img src="{{ $index->logo }}" height="100" width="100">
                                @else
                                    <img src="{{ url(Storage::url('noimage.jpg')) }}" height="100" width="100">
                                @endif
                            </td>
                            <td data-title="Nama">{{ $index->nama }}</td>
                            <td data-title="Singkatan">{{ $index->singkatan }}</td>
                            <td data-title="Dasar Hukum">{{ $index->dasar_hukum }}</td>
                            <td data-title="Alamat">{{ $index->alamat }}</td>
                            {{-- <td data-title="Profil">{{ $index->profil }}</td> --}}
                            <td data-title="Aksi" align="center">
                                <a href="{{ Route('lembaga.detail', ['lembaga' => $index->id, 'kelurahan_slug' => $desa->slug, 'slug' => Str::slug($index->nama)]) }}">Detail</a>
                            </td>
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
@endsection
@push('scripts')
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            var table = $('#dataTable').DataTable();
            //$("#modal-hapus").modal() 
        })
    </script>
@endpush