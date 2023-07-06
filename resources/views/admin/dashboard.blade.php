@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('styles')
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
                                <h5 class="card-title text-uppercase text-muted mb-0">Total User</h5>
                                <span class="h2 font-weight-bold mb-0">{{$users}}</span>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
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
                                <h5 class="card-title text-uppercase text-muted mb-0">Total Kelurahan</h5>
                                <span class="h2 font-weight-bold mb-0">{{$kelurahan}}</span>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
                                    <i class="fas fa-users"></i>
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
@endsection

@push('scripts')
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable(); 
        })
    </script>
@endpush
