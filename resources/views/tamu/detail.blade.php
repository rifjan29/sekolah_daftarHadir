@extends('layouts.template')
@section('content')
<div class="content">
    <!-- Animated -->
    <div class="animated fadeIn">
        <!-- Widgets  -->
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="card-header d-flex flex-wrap justify-content-start">
                        <div>
                            <a href="{{ route('buku-tamu.index') }}" class="ml-2 mr-1">
                                <i class="ti-arrow-left"></i>&nbsp;
                            </a>
                        </div>
                        <div>
                            <strong class="card-title ">Detail {{ ucwords(Request::segment(1)) }}</strong>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="nama" class="control-label mb-1">Nama</label>
                            <input id="nama" name="nama" type="text" class="form-control" value="{{ old('nama', $data->nama) }}" readonly>
                        </div>
                        <div class="form-group has-success">
                            <label for="gender" class="control-label mb-1">Jenis Kelamin</label>
                            <input id="gender" name="gender" type="text" class="form-control" value="{{ old('gender', $data->gender) }}" readonly>
                        </div>
                        <div class="form-group has-success">
                            <label for="asal" class="control-label mb-1">Alamat/Instansi</label>
                            <input id="asal" name="asal" type="text" class="form-control" value="{{ old('asal', $data->asal) }}" readonly>
                        </div>
                        <div class="form-group has-success">
                            <label for="nip" class="control-label mb-1">Tujuan</label>
                            <textarea name="tujuan" id="tujuan" rows="9" readonly class="form-control"> {{ old('tujuan', $data->tujuan) }} </textarea>
                        </div>
                        <div class="form-group">
                            <label for="user" class="control-label mb-1">Ditambahkan oleh</label>
                            <input id="user" name="user" type="text" class="form-control" value="{{ old('user', $data->name) }}" readonly>
                        </div>
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