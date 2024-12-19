<?= form_open('admin/wakaf/update/' . $wakaf['idwakaf']) ?>

<div class="form-group row">
    <label class="col-3">No Sertifikat</label>
    <div class="col-9">
        <input type="text" name="nosertifikat" class="form-control" value="<?= $wakaf['nosertifikat'] ?>" placeholder="Nomor Sertifikat" required>
    </div>
</div>

<div class="form-group row">
    <label class="col-3">Alamat</label>
    <div class="col-9">
        <input type="text" name="alamat" class="form-control" value="<?= $wakaf['alamat'] ?>" placeholder="Alamat Wakaf" required>
    </div>
</div>

<div class="form-group row">
    <label class="col-3">Koordinat</label>
    <div class="col-9">
        <input type="text" name="koordinat" class="form-control" value="<?= $wakaf['koordinat'] ?>" placeholder="Koordinat (opsional)">
    </div>
</div>

<div class="form-group row">
    <label class="col-3">Pewakaf</label>
    <div class="col-9">
        <input type="text" name="pewakaf" class="form-control" value="<?= $wakaf['pewakaf'] ?>" placeholder="Nama Pewakaf" required>
    </div>
</div>

<div class="form-group row">
    <label class="col-3">Keterangan</label>
    <div class="col-9">
        <textarea name="keterangan" class="form-control" placeholder="Keterangan Wakaf (opsional)"><?= $wakaf['keterangan'] ?></textarea>
    </div>
</div>

<div class="form-group row">
    <label class="col-3">Status</label>
    <div class="col-9">
        <select name="status" class="form-control" required>
            <option value="aktif" <?= $wakaf['status'] === 'aktif' ? 'selected' : '' ?>>Aktif</option>
            <option value="non-aktif" <?= $wakaf['status'] === 'non-aktif' ? 'selected' : '' ?>>Non-Aktif</option>
        </select>
    </div>
</div>

<div class="form-group row">
    <div class="col-9 offset-3">
        <button type="submit" class="btn btn-success">Update Wakaf</button>
    </div>
</div>

<?= form_close() ?>
