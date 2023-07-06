@extends('layouts.app')

@section('title', 'Potensi')

@section('styles')
    <link href="{{ asset('/css/style.css') }}" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
    <style>
        .ikon {
            font-family: fontAwesome;
        }

        .animate-up:hover {
            top: -5px;
        }
    </style>
    <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
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
                                    <h2 class="mb-0">Potensi</h2>
                                    <p class="mb-0 text-sm">Kelola Potensi Kelurahan</p>
                                </div>
                                <div class="mb-3">
                                    <a href="{{ route('potensi.create') }}" class="btn btn-success" title="Tambah"><i
                                            class="fas fa-plus"></i> Tambah Potensi</a>
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
    <div class="row mt-4 justify-content-center">
        <div class="single-service bg-white rounded shadow container">

            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead align="center">
                        <tr>
                            <th>No</th>
                            <th>Gambar</th>
                            <th>Nama Potensi</th>
                            {{-- <th>Deskripsi</th> --}}
                            <th>Aksi</th>

                        </tr>
                    </thead>
                    <tbody>
                        @php $no = 1 @endphp
                        @forelse ($potensi as $index)
                            <tr>
                                <td data-title="No">{{ $no++ }}</td>
                                <td data-title="Gambar">
                                    @if ($index->gambar)
                                        <img src="{{ $index->gambar }}" height="100" width="100">
                                    @else
                                        <img src="{{ url(Storage::url('noimage.jpg')) }}" height="100" width="100">
                                    @endif
                                </td>
                                <td data-title="Nama Potensi">{{ $index->nama }}</td>
                                {{-- <td data-title="Deskripsi">{{ $index->konten }}</td> --}}
                                <td data-title="Aksi" align="center">
                                    <a href="{{ Route('potensi.edit', ['potensi' => $index->id]) }}"><i
                                            class="fas fa-edit"></i></a> |
                                    <a data-action="{{ route('potensi.destroy', $index->id) }}" data-toggle="modal"
                                        href="#modal-hapus" title="Hapus"><i class="fas fa-trash"
                                            style="color: red"></i></a>
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
        {{-- <div class="col">
<div class="single-service bg-white rounded shadow">
    <h4>Data belum tersedia</h4>
</div>
</div> --}}
    </div>

    <div class="modal fade" id="modal-hapus" tabindex="-1" role="dialog" aria-labelledby="modal-hapus" aria-hidden="true">
        <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
            <div class="modal-content bg-gradient-danger">

                <div class="modal-header">
                    <h6 class="modal-title" id="modal-title-delete">Hapus Potensi Kelurahan?</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <div class="modal-body">

                    <div class="py-3 text-center">
                        <i class="ni ni-bell-55 ni-3x"></i>
                        <h4 class="heading mt-4">Perhatian!!</h4>
                        <p>Menghapus Potensi Kelurahan akan menghapus semua data yang dimilikinya</p>
                        <p><strong id="nama-hapus"></strong></p>
                    </div>

                </div>

                <div class="modal-footer">
                    <form id="form-hapus" action="" method="POST">
                        @csrf @method('delete')
                        <button type="submit" class="btn btn-white">Yakin</button>
                    </form>
                    <button type="button" class="btn btn-link text-white ml-auto" data-dismiss="modal">Tidak</button>
                </div>

            </div>
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
            $('a[data-action]').on('click', function() {
                var actionUrl = $(this).data('action'); // Mendapatkan URL aksi dari atribut data-action

                // Mengubah atribut action pada form dengan URL aksi yang diperoleh
                $('#form-hapus').attr('action', actionUrl);
            })
        })
    </script>
@endpush
