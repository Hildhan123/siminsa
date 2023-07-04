@extends('admin.layouts.app')

@section('title', 'Dump Data')

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
                                    <h2 class="mb-0">Dump Data</h2>
                                    {{-- <p class="mb-0 text-sm">Kelola Perangkat Desa</p> --}}
                                </div>
                                <div class="mb-3">

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
    <div class="row">
        <div class="col">
            <div class="card bg-secondary shadow h-100">
                <div class="card-header bg-white border-0">
                    <h3 class="mb-0"></h3>
                </div>
                <div class="card-body">
                    <form autocomplete="off" action="{{ route('admin.dump') }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <h2>User</h2>
                        <div class="form-group">
                            <label class="form-control-label" for="id">Id User</label>
                                <select id="id" name="id" class="form-control selectpicker" data-live-search="true">
                                    <option value="">Pilih Id User</option>
                                    @foreach ($users as $index)
                                        <option value="{{$index->id}}" @if (old('id') == $index->id) selected @endif>
                                            {{ $index->id }} - {{$index->nama}} - Kelurahan {{$index->nama_kelurahan}}</option>
                                    @endforeach
                                </select>
                            @error('id')
                                <span class="invalid-feedback font-weight-bold">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary btn-block" id="simpan">Submit</button>
                    </form>
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
