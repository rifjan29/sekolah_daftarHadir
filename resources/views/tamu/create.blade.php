@extends('layouts.template')
@section('content')
<div class="content">
    <!-- Animated -->
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        Daftar Tamu <strong>berhasil</strong> ditambahkan
                    </div>
                @elseif(session('eror'))
                    <div class="alert alert-success" role="alert">
                        Daftar Tamu <strong>berhasil</strong> ditambahkan
                    </div>
                @endif
            </div>
        </div>
        <!-- Widgets  -->
        <div class="row">
            <div class="col-lg-12 col-md-6">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Buku Tamu</strong>
                    </div>
                    <div class="card-body card-block">
                        <form action="{{ route('buku-tamu.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="Nama" class=" form-control-label">Nama</label>
                                <input type="text" id="nama" name="nama" placeholder="exp:sinta..." class="form-control" autofocus>
                                @if ($errors->has('nama'))
                                    <span class="badge badge-danger">{{  $errors->first('nama') }}</span>
                                @endif
                            </div>
                            <div class="form-group mt-4">
                                <label for="gender">Jenis Kelamin</label>
                                <select name="gender" id="gender"  class="form-control">
                                    <option value="" selected disabled>Pilih Jenis Kelamin</option>
                                    <option value="Laki-laki">Laki-Laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                    <option value="Lainnya">Lainnya</option>
                                </select>
                                @if ($errors->has('gender'))
                                    <span class="badge badge-danger">{{  $errors->first('gender') }}</span>
                                @endif
                            </div>
                            <div class="form-group mt-4">
                                <label for="asal" class=" form-control-label">Alamat/Instansi</label>
                                <input type="text" id="asal" name="asal" placeholder="exp:bondowoso" class="form-control">
                                @if ($errors->has('asal'))
                                    <span class="badge badge-danger">{{  $errors->first('asal') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="tujuan" class="form-control-label">Tujuan</label>
                                <textarea name="tujuan" id="tujuan" rows="9" placeholder="exp:kunjungan dinas..." class="form-control"></textarea>
                                @if ($errors->has('tujuan'))
                                    <span class="badge badge-danger">{{  $errors->first('tujuan') }}</span>
                                @endif
                            </div>
                            <div class="d-flex justify-content-end">
                                <div class="mr-2">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                                <div class="">
                                    <button type="reset" class="btn btn-outline-danger">Batal</button>
                                </div>
                            </div>
                        </form>
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
        </div><!
    </nav>
</aside>
@endsection

