@extends('home.layouts.app')

@section('title', 'Tautan Kelurahan')

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
                    <th>Gambar</th>
                    <th>Title</th>            
                    <th>Url</th>
                </tr>
            </thead>
            <tbody>
                @php $no = 1 @endphp
                @forelse ($produk as $index)
                    <tr>
                        <td data-title="No">{{ $no++ }}</td>
                        <td data-title="Nama File">{{ $index->nama }}</td>
                        <td data-title="Keterangan">{{ $index->keterangan }}</td>
                        <td data-title="File"><a href="{{$index->file}}">Lihat File</a></td>
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