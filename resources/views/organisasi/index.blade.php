@extends('layouts.app')

@section('title', 'Struktur Organisasi')

@section('styles')
    <link href="{{ asset('/css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/jquery.fancybox.css') }}">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
    <style>
        .ikon {
            font-family: fontAwesome;
        }

        .animate-up:hover {
            top: -5px;
        }
    </style>
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
                                    <h2 class="mb-0">Struktur Organisasi</h2>
                                    <p class="mb-0 text-sm">Kelola struktur organisasi</p>
                                </div>
                                <div class="mb-3">
                                    <a href="{{ route('organisasi.create') }}" class="btn btn-success" title="Tambah"><i
                                            class="fas fa-plus"></i> Tambah Data</a>
                                    <a href="#tambah-gambar" data-toggle="modal" class="btn btn-success"><i
                                            class="fas fa-image mr-2"></i> Tambah Gambar</a>
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
                            <th>Order Index</th>
                            <th>Title</th>
                            {{-- <th>Deskripsi</th> --}}
                            <th>Pegawai</th>
                            <th>Aksi</th>

                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($organisasi as $index)
                            <tr>
                                <td data-title="Order Index">{{ $index->order }}</td>
                                <td data-title="Title">{{ $index->title }}</td>
                                {{-- <td data-title="Deskripsi">{!! $index->deskripsi !!}</td> --}}
                                <td data-title="Pegawai">{{ $index->nama }}</td>
                                <td data-title="Aksi" align="center">
                                    <a href="{{ Route('organisasi.edit', ['organisasi' => $index->id]) }}"><i
                                            class="fas fa-edit"></i></a> |
                                    <a data-action="{{ route('organisasi.destroy', $index->id) }}" data-toggle="modal"
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
    <div class="row mt-4 justify-content-center">
        @forelse ($gallery as $item)
        <div class="col-lg-4 col-md-6 mb-3 img-scale-up">
            <a href="{{$item->gallery }}" data-caption="{{ $item->caption }}" data-fancybox>
                <img class="mw-100" src="{{$item->gallery }}" alt="">
            </a>
            <a href="#modal-hapus" data-toggle="modal" data-action="{{ route('gallery.destroy',$item) }}" class="mb-0 btn btn-sm btn-danger hapus-data" style="position: absolute; top: 0; left: 0; z-index: 1; left:15px">
                <i class="fas fa-trash" title="Hapus" data-toggle="tooltip"></i>
            </a>
        </div>
    @empty
        <div class="col">
            <div class="single-service bg-white rounded shadow">
                <h4>Data belum tersedia</h4>
            </div>
        </div>
    @endforelse
    </div>

    <div class="modal fade" id="tambah-gambar" tabindex="-1" role="dialog" aria-labelledby="tambah-gambar"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="modal-title-delete">Tambah gambar struktur organisasi</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <div class="modal-body">
                    <form action="{{ route('gallery.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="organisasi" value="1">
                        <div class="form-group">
                            <label class="form-control-label">Gambar</label>
                            <div class="text-center">
                                <img onclick="$(this).siblings('.images').click()" class="mw-100 upload-image"
                                    style="max-height: 300px" src="{{ asset('storage/upload.jpg') }}" alt="">
                                <input accept="image/*" onchange="uploadImage(this)" type="file" name="gambar"
                                    class="images" style="display: none">
                                <span class="invalid-feedback font-weight-bold"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-control-label">Caption</label>
                            <textarea class="form-control" name="caption"></textarea>
                        </div>
                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-white" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-hapus" tabindex="-1" role="dialog" aria-labelledby="modal-hapus"
        aria-hidden="true">
        <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
            <div class="modal-content bg-gradient-danger">

                <div class="modal-header">
                    <h6 class="modal-title" id="modal-title-delete">Hapus Data?</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <div class="modal-body">

                    <div class="py-3 text-center">
                        <i class="ni ni-bell-55 ni-3x"></i>
                        <h4 class="heading mt-4">Perhatian!!</h4>
                        <p>Menghapus data akan menghapus semua data yang dimilikinya</p>
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
    <script src="{{ asset('js/jquery.fancybox.js') }}"></script>
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/datatables-demo.js') }}"></script>
    <script>
        function uploadImage(inputFile) {
            if (inputFile.files && inputFile.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $(inputFile).siblings('img').attr("src", e.target.result);
                }
                reader.readAsDataURL(inputFile.files[0]);
            }
        }
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
