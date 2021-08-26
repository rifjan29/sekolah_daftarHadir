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
          <div class="col-lg-12 ">
            <div class="card">
                <div class="card-header">
                    <strong class="card-title">{{ ucwords(Request::segment(1)) }}</strong>
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

                    <table id="data-table" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">NIP</th>
                                <th class="text-center">Nama</th>
                                <th class="text-center">Golongan</th>
                                <th class="text-center">Jabatan</th>
                                <th class="text-center">Jenis Kelamin</th>
                                <th class="text-center">Presensi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-center">{{ isset($item->nip) ? $item->nip : '-' }}</td>
                                <td class="text-center">{{ $item->nama }}</td>
                                <td class="text-center">{{ $item->gol }}</td>
                                <td class="text-center">{{ $item->jabatan }}</td>
                                <td class="text-center">{{ $item->gender }}</td>
                                <td class="d-flex justify-content-center">
                                    @php
                                        $kehadiranHariIni = \App\Models\Presensi::where('guru_id', $item->id)->whereDate('created_at', date('Y-m-d'))->count();
                                    @endphp
                                    @if ($kehadiranHariIni > 0)
                                        <!-- Sudah melakukan presensi -->
                                        <span>Sudah melakukan presensi.</span>
                                    @else
                                        <!-- Belum melakukan presensi -->
                                        <div class="d-flex content-justify-center">
                                            <div class="mx-2">
                                                    <form action="{{ route('presensi.store') }}" method="POST">
                                                        @csrf
                                                        <input type="text" value="Hadir" hidden name="presensi">
                                                        <input type="text" value="{{ $item->id }}" hidden name="guru">
                                                        <button type="submit"  class="btn btn-success">
                                                            Hadir
                                                        </button>
                                                    </form>
                                                </div>
                                                <div class="mx-2">
                                                    <a href="#" class="btn btn-info" data-toggle="modal" data-target="#ketmodal">
                                                        Absen
                                                    </a>
                                                </div>
                                                <div class="mx-2">
                                                    <form action="{{ route('presensi.store') }}" method="POST">
                                                    @csrf
                                                        <input type="text" value="{{ $item->id }}" hidden name="guru">
                                                        <input type="text" value="Alpha" hidden name="presensi">
                                                        <button type="submit"  class="btn btn-danger">
                                                            Aplha
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                    @endif
                                </td>
                            </tr>
                            @include('presensi.ket-modal')
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
        </div>
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

