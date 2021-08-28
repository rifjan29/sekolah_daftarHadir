@extends('layouts.template')
@push('extraStyles')
<link rel="stylesheet" href="{{ asset('assets/css/lib/datatable/dataTables.bootstrap.min.css') }}">
@endpush
@section('content')
<div class="content">
    <!-- Animated -->
    <div class="animated fadeIn">
        <!-- Widgets  -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">{{ ucwords(str_replace('-', ' ', Request::segment(1))) }}</strong>
                    </div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="sufee-alert alert with-close alert-primary alert-dismissible fade show">
                                <span class="badge badge-pill badge-primary">Berhasil</span>
                                {{session('status')}}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @elseif (session('error'))
                        <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                            <span class="badge badge-pill badge-danger">Gagal</span>
                            {{session('error')}}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif

                        <a href="{{ route('presensi.index') }}" class="btn btn-primary ml-2 mb-4">
                            <i class="ti-arrow-left"></i>&nbsp;Kembali
                        </a>
                        
                        <table id="data-table" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">NIP</th>
                                    <th class="text-center">Nama</th>
                                    {{-- <th class="text-center">Golongan</th> --}}
                                    <th class="text-center">Jabatan</th>
                                    <th class="text-center">Admin</th>
                                    <th class="text-center">Kehadiran</th>
                                    <th class="text-center">Keterangan</th>
                                    <th class="text-center">Waktu</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td class="text-center">{{ isset($item->nip) ? $item->nip : '-' }}</td>
                                    <td class="text-center">{{ $item->nama }}</td>
                                    {{-- <td class="text-center">{{ $item->gol }}</td> --}}
                                    <td class="text-center">{{ $item->jabatan }}</td>
                                    <td class="text-center">{{ $item->name }}</td>
                                    <td class="text-center">{{ $item->presensi }}</td>
                                    <td class="text-center">{{ isset($item->ket) ? $item->ket : '-' }}</td>
                                    <td class="text-center">{{ $item->created_at }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Widgets -->
    <!-- /#add-category -->
    </div>
    <!-- .animated -->
</div>
@endsection
@section('sidebar')
<aside id="left-panel" class="left-panel">
    <nav class="navbar navbar-expand-sm navbar-default">
        <div id="main-menu" class="main-menu collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="{{ Request::segment(1) == 'dashboard' || Request::segment(1) == '' ? 'active' : '' }}">
                    <a href="{{ route('dashboard') }}"><i class="menu-icon fa fa-dashboard"></i>Dashboard </a>
                </li>
                <li class="{{ Request::segment(1) == 'admin' ? 'active' : '' }}">
                    <a href="{{ route('admin.index') }}"><i class="menu-icon fa fa-key"></i>Data Admin </a>
                </li>
                <li class="{{ Request::segment(1) == 'guru' ? 'active' : '' }}">
                    <a href="{{ route('guru.index') }}"> <i class="menu-icon ti-user"></i>Data Guru </a>
                </li>
                <li class="{{ Request::segment(1) == 'presensi' ? 'active' : '' }}">
                    <a href="{{ route('presensi.index') }}"> <i class="menu-icon ti-check-box"></i>Presensi</a>
                </li>
                <li class="{{ Request::segment(1) == 'buku-tamu' ? 'active' : '' }}">
                    <a href="{{ route('buku-tamu.index') }}"> <i class="menu-icon ti-bookmark-alt"></i>Buku Tamu</a>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </nav>
</aside>
@endsection
@push('extraScripts')
<script src="{{ asset('assets/js/lib/data-table/datatables.min.js') }}"></script>
<script src="{{ asset('assets/js/lib/data-table/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/lib/data-table/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/js/lib/data-table/buttons.bootstrap.min.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function() {
      $('#data-table').DataTable();
  } );
</script>
@endpush