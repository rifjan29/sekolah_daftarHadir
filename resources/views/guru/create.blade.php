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
                            <a href="{{ route('guru.index') }}" class="ml-2 mr-1">
                                <i class="ti-arrow-left"></i>&nbsp;
                            </a>
                        </div>
                        <div>
                            <strong class="card-title ">Tambah {{ ucwords(Request::segment(1)) }}</strong>
                        </div>
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
                        <form action="{{ route('guru.store') }}" method="post">
                            @csrf
                            <div class="form-group has-success">
                                <label for="nip" class="control-label mb-1">NIP (jika ada)</label>
                                <input id="nip" name="nip" type="text" class="form-control @error('nip') is-invalid @enderror" value="{{ old('nip') }}">
                                @error('nip')
                                <small class="help-block form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="nama" class="control-label mb-1">Nama</label>
                                <input id="nama" name="nama" type="text" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama') }}" required>
                                @error('nama')
                                <small class="help-block form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="gol" class="control-label mb-1">Golongan</label>
                                <input id="gol" name="gol" type="text" class="form-control @error('gol') is-invalid @enderror" value="{{ old('gol') }}" >
                                @error('gol')
                                <small class="help-block form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="gender" class="control-label mb-1">Jenis Kelamin</label>
                                <select class="form-control @error('gender') is-invalid @enderror" name="gender" id="gender" required>
                                    <option value="0">--Pilih Jenis Kelamin--</option>
                                    <option value="Laki-laki" {{ old('gender') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="Perempuan" {{ old('gender') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                    <option value="Lainnya" {{ old('gender') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                                </select>
                                @error('gender')
                                <small class="help-block form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="jabatan" class="control-label mb-1">Jabatan</label>
                                <input id="jabatan" name="jabatan" type="text" class="form-control @error('jabatan') is-invalid @enderror" value="{{ old('jabatan') }}" required>
                                @error('jabatan')
                                <small class="help-block form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div>
                                <button type="reset" class="btn btn-danger">
                                    <i class="ti-reload"></i>&nbsp;
                                    <span id="payment-button-amount">Reset</span>
                                    <span id="payment-button-sending" style="display:none;">Resetting…</span>
                                </button>
                                <button type="submit" class="btn btn-info">
                                    <i class="ti-save"></i>&nbsp;
                                    <span id="payment-button-amount">Simpan</span>
                                    <span id="payment-button-sending" style="display:none;">Sending…</span>
                                </button>
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
        </div><!-- /.navbar-collapse -->
    </nav>
</aside>
@endsection