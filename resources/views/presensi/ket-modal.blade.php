<div class="modal fade" id="ketmodal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mediumModalLabel">Konfirmasi Keterangan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('presensi.store') }}" method="POST">
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <input type="text" value="{{ $item->id }}" hidden name="guru">
                        <input type="text" value="Absen" hidden name="presensi">
                        <label for="ket" class=" form-control-label">Keterangan</label>
                        <textarea name="ket" id="ket" rows="9" class="form-control"></textarea>
                        @if ($errors->has('keterangan'))
                            <span class="badge badge-danger">{{  $errors->first('nama') }}</span>
                        @endif
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-danger"  data-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>