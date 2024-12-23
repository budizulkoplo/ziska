<?= form_open('admin/wakaf/store', ['enctype' => 'multipart/form-data']) ?>

<div class="form-group row">
    <label class="col-3">ID Object</label>
    <div class="col-9">
        <input type="text" name="idobject" class="form-control" placeholder="ID Object" required>
    </div>
</div>

<div class="form-group row">
    <label class="col-3">No Sertifikat</label>
    <div class="col-9">
        <input type="text" name="nosertifikat" class="form-control" placeholder="Nomor Sertifikat" required>
    </div>
</div>

<div class="form-group row">
    <label class="col-3">Alamat</label>
    <div class="col-9">
        <input type="text" name="alamat" class="form-control" placeholder="Alamat Wakaf" required>
    </div>
</div>

<div class="form-group row">
    <label class="col-3">Koordinat</label>
    <div class="col-9">
        <input type="text" name="koordinat" class="form-control" placeholder="Koordinat (opsional)">
    </div>
</div>

<div class="form-group row">
    <label class="col-3">Pewakaf</label>
    <div class="col-9">
        <input type="text" name="pewakaf" class="form-control" placeholder="Nama Pewakaf" required>
    </div>
</div>

<div class="form-group row">
    <label class="col-3">Keterangan</label>
    <div class="col-9">
        <textarea name="keterangan" class="form-control" placeholder="Keterangan Wakaf (opsional)"></textarea>
    </div>
</div>

<div class="form-group row">
    <label class="col-3">Status</label>
    <div class="col-9">
        <select name="status" class="form-control" required>
            <option value="aktif">Aktif</option>
            <option value="non-aktif">Non-Aktif</option>
        </select>
    </div>
</div>

<div class="form-group row">
    <label class="col-3">Upload Foto Surat</label>
    <div class="col-9">
        <input type="file" name="surat[]" class="form-control" accept="image/*,application/pdf" multiple>
        <small class="form-text text-muted">Unggah lebih dari satu file dengan menekan CTRL (atau CMD di Mac).</small>
    </div>
</div>

<div class="form-group row">
    <label class="col-3">Upload Foto Objek</label>
    <div class="col-9">
        <input type="file" name="objek[]" class="form-control" accept="image/*" multiple>
        <small class="form-text text-muted">Unggah lebih dari satu file dengan menekan CTRL (atau CMD di Mac).</small>
    </div>
</div>



<div class="form-group row">
    <div class="col-9 offset-3">
        <button type="submit" class="btn btn-success">Simpan Wakaf</button>
    </div>
</div>

<?= form_close() ?>
