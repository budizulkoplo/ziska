<?= form_open('admin/wakaf/update/' . $wakaf['idwakaf'], ['enctype' => 'multipart/form-data']) ?>

<div class="form-group row">
    <label class="col-3">ID Object</label>
    <div class="col-9">
        <input type="text" name="idobject" class="form-control" placeholder="ID Object" value="<?= $wakaf['idobject'] ?>" required>
    </div>
</div>

<div class="form-group row">
    <label class="col-3">No Sertifikat</label>
    <div class="col-9">
        <input type="text" name="nosertifikat" class="form-control" placeholder="Nomor Sertifikat" value="<?= $wakaf['nosertifikat'] ?>" required>
    </div>
</div>

<div class="form-group row">
    <label class="col-3">Alamat</label>
    <div class="col-9">
        <input type="text" name="alamat" class="form-control" placeholder="Alamat Wakaf" value="<?= $wakaf['alamat'] ?>" required>
    </div>
</div>

<div class="form-group row">
    <label class="col-3">Koordinat</label>
    <div class="col-9">
        <input type="text" name="koordinat" class="form-control" placeholder="Koordinat (opsional)" value="<?= $wakaf['koordinat'] ?>">
    </div>
</div>

<div class="form-group row">
    <label class="col-3">Pewakaf</label>
    <div class="col-9">
        <input type="text" name="pewakaf" class="form-control" placeholder="Nama Pewakaf" value="<?= $wakaf['pewakaf'] ?>" required>
    </div>
</div>

<div class="form-group row">
    <label class="col-3">Keterangan</label>
    <div class="col-9">
        <textarea name="keterangan" class="form-control" placeholder="Keterangan Wakaf (opsional)"><?= $wakaf['keterangan'] ?></textarea>
    </div>
</div>

<div class="form-group row">
    <label class="col-3">URL Google Maps</label>
    <div class="col-9">
        <input type="url" name="urlmaps" id="urlmaps" class="form-control" value="<?= $wakaf['urlmaps'] ?>" required>
        <?php if (!empty($wakaf['urlmaps'])): ?>
            <div class="mt-2">
                <iframe 
                    src="<?= $wakaf['urlmaps'] ?>" 
                    width="100%" 
                    height="300" 
                    style="border:0;" 
                    allowfullscreen="" 
                    loading="lazy">
                </iframe>
            </div>
        <?php endif; ?>
    </div>
</div>

<div class="form-group row">
    <label class="col-3">Status</label>
    <div class="col-9">
        <select name="status" class="form-control" required>
            <option value="aktif" <?= $wakaf['status'] == 'aktif' ? 'selected' : '' ?>>Aktif</option>
            <option value="non-aktif" <?= $wakaf['status'] == 'non-aktif' ? 'selected' : '' ?>>Non-Aktif</option>
        </select>
    </div>
</div>

<div class="form-group row">
    <label class="col-3">Foto Surat</label>
    <div class="col-9">
        <?php if (!empty($surat)): ?>
            <div class="mb-2">
                <p>Foto Surat yang Tersedia:</p>
                <?php foreach ($surat as $file): ?>
                    <?php if (pathinfo($file['filefoto'], PATHINFO_EXTENSION) == 'pdf'): ?>
                        <a href="<?= base_url('uploads/wakaf/' . $file['filefoto']) ?>" target="_blank" class="btn btn-sm btn-outline-primary mr-2 mb-2">Lihat PDF</a>
                    <?php else: ?>
                        <img src="<?= base_url('uploads/wakaf/' . $file['filefoto']) ?>" alt="Surat" class="img-thumbnail" style="max-width: 150px; margin-right: 10px;">
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        <input type="file" name="surat[]" class="form-control" accept="image/*,application/pdf" multiple id="inputSurat">
        <small class="form-text text-muted">Unggah lebih dari satu file dengan menekan CTRL (atau CMD di Mac). Kosongkan jika tidak ingin mengganti.</small>
        <div id="previewSurat" class="mt-2"></div>
    </div>
</div>

<div class="form-group row">
    <label class="col-3">Foto Objek</label>
    <div class="col-9">
        <?php if (!empty($objek)): ?>
            <div class="mb-2">
                <p>Foto Objek yang Tersedia:</p>
                <?php foreach ($objek as $file): ?>
                    <img src="<?= base_url('uploads/wakaf/' . $file['filefoto']) ?>" alt="Objek" class="img-thumbnail" style="max-width: 150px; margin-right: 10px;">
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        <input type="file" name="objek[]" class="form-control" accept="image/*" multiple id="inputObjek">
        <small class="form-text text-muted">Unggah lebih dari satu file dengan menekan CTRL (atau CMD di Mac). Kosongkan jika tidak ingin mengganti.</small>
        <div id="previewObjek" class="mt-2"></div>
    </div>
</div>

<div class="form-group row">
    <div class="col-9 offset-3">
        <button type="submit" class="btn btn-success">Simpan Perubahan</button>
    </div>
</div>

<?= form_close() ?>

<script>
    function previewImages(input, previewContainerId) {
        const previewContainer = document.getElementById(previewContainerId);
        previewContainer.innerHTML = '';
        if (input.files) {
            Array.from(input.files).forEach(file => {
                if (file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.classList.add('img-thumbnail', 'mr-2', 'mb-2');
                        img.style.maxWidth = '150px';
                        previewContainer.appendChild(img);
                    };
                    reader.readAsDataURL(file);
                }
            });
        }
    }

    document.getElementById('inputSurat').addEventListener('change', function() {
        previewImages(this, 'previewSurat');
    });

    document.getElementById('inputObjek').addEventListener('change', function() {
        previewImages(this, 'previewObjek');
    });
</script>
