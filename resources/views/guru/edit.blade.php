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
                            <strong class="card-title ">Edit {{ ucwords(Request::segment(1)) }}</strong>
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
                        <form action="{{ route('guru.update', $guru->id) }}" method="post">
                            @csrf
                            @method('put')
                            <div class="form-group">
                                <label for="nama" class="control-label mb-1">Nama</label>
                                <input id="nama" name="nama" type="text" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama', $guru->nama) }}" required>
                                @error('nama')
                                <small class="help-block form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group has-success">
                                <label for="nip" class="control-label mb-1">NIP (jika ada)</label>
                                <input id="nip" name="nip" type="text" class="form-control @error('nip') is-invalid @enderror" value="{{ old('nip', $guru->nip) }}">
                                @error('nip')
                                <small class="help-block form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="gender" class="control-label mb-1">Jenis Kelamin</label>
                                <select class="form-control @error('gender') is-invalid @enderror" name="gender" id="gender" required>
                                    <option value="0">--Pilih Jenis Kelamin--</option>
                                    <option value="Laki-laki" {{ old('gender', $guru->gender) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="Perempuan" {{ old('gender', $guru->gender) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                    <option value="Lainnya" {{ old('gender', $guru->gender) == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                                </select>
                                @error('gender')
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

@push('extraScripts')
    <script>
        // Restricts input for the given textbox to the given inputFilter.
        function setInputFilter(textbox, inputFilter) {
        ["input", "keydown", "keyup", "mousedown", "mouseup", "select", "contextmenu", "drop"].forEach(function(event) {
            textbox.addEventListener(event, function() {
            if (inputFilter(this.value)) {
                this.oldValue = this.value;
                this.oldSelectionStart = this.selectionStart;
                this.oldSelectionEnd = this.selectionEnd;
            } else if (this.hasOwnProperty("oldValue")) {
                this.value = this.oldValue;
                this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
            } else {
                this.value = "";
            }
            });
        });
        }


        // Install input filters.
        setInputFilter(document.getElementById("nip"), function(value) {
        return /^-?\d*$/.test(value); });
    </script>
@endpush