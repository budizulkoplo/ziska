<?= form_open_multipart('admin/programlazis/update/' . $program['idprogram']) ?>

<div class="form-group row">
    <label class="col-3">Judul Program</label>
    <div class="col-9">
        <input type="text" name="judulprogram" class="form-control" placeholder="Judul Program" value="<?= $program['judulprogram'] ?>" required>
    </div>
</div>

<div class="form-group row">
    <label class="col-3">Tanggal Mulai</label>
    <div class="col-9">
        <input type="date" name="tglmulai" class="form-control" value="<?= $program['tglmulai'] ?>" required>
    </div>
</div>

<div class="form-group row">
    <label class="col-3">Tanggal Selesai</label>
    <div class="col-9">
        <input type="date" name="tglselesai" class="form-control" value="<?= $program['tglselesai'] ?>" required>
    </div>
</div>

<div class="form-group row">
    <label class="col-3">Deskripsi</label>
    <div class="col-9">
        <textarea name="deskripsiprogram" class="form-control konten" required><?= $program['deskripsiprogram'] ?></textarea>
    </div>
</div>

<div class="form-group row">
    <label class="col-3">Foto</label>
    <div class="col-9">
        <?php if ($program['fotoprogram']): ?>
            <div>
                <img src="<?= base_url('assets/upload/programlazis/' . $program['fotoprogram']) ?>" class="img img-thumbnail" width="100">
            </div>
        <?php endif; ?>
        <input type="file" name="fotoprogram" class="form-control mt-2">
    </div>
</div>

<div class="form-group row">
    <label class="col-3">Target Donasi</label>
    <div class="col-9">
        <input type="number" name="targetdonasi" class="form-control" placeholder="Target Donasi" value="<?= $program['targetdonasi'] ?>" required>
    </div>
</div>

<div class="form-group row">
    <label class="col-3">Terkumpul</label>
    <div class="col-9">
        <input type="number" name="terkumpul" class="form-control" placeholder="Jumlah Terkumpul" value="<?= $program['terkumpul'] ?>" required>
    </div>
</div>

<div class="form-group row">
    <div class="col-9 offset-3">
        <button type="submit" class="btn btn-success">Simpan Perubahan</button>
    </div>
</div>

<?= form_close() ?>
