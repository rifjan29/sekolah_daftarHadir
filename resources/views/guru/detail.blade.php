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
                            <strong class="card-title ">Detail {{ ucwords(Request::segment(1)) }}</strong>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="nama" class="control-label mb-1">Nama</label>
                            <input id="nama" name="nama" type="text" class="form-control" value="{{ old('nama', $guru->nama) }}" readonly>
                            @error('nama')
                            <small class="help-block form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group has-success">
                            <label for="nip" class="control-label mb-1">NIP (jika ada)</label>
                            <input id="nip" name="nip" type="text" class="form-control" value="{{ old('nip', $guru->nip) }}" readonly>
                            @error('nip')
                            <small class="help-block form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group has-success">
                            <label for="gender" class="control-label mb-1">Jenis Kelamin</label>
                            <input id="gender" name="gender" type="text" class="form-control" value="{{ old('gender', $guru->gender) }}" readonly>
                            @error('gender')
                            <small class="help-block form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="user" class="control-label mb-1">Ditambahkan oleh</label>
                            <input id="user" name="user" type="text" class="form-control" value="{{ old('user', $guru->name) }}" readonly>
                            @error('user')
                            <small class="help-block form-text text-danger">{{ $message }}</small>
                            @enderror
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