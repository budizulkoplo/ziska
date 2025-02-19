<div class="container">
    <h3>Input Tasaruf</h3>

    <?= form_open(base_url('admin/transaksi/tasarufsave')); ?>
    <?= csrf_field(); ?>

    <!-- Input Nama Program (readonly) -->
    <div class="form-group row">
        <label for="namaprogram" class="col-3 col-form-label">Nama Program</label>
        <div class="col-9">
            <input type="text" id="namaprogram" name="namaprogram" class="form-control" value="<?= esc($program['judulprogram']); ?>" readonly>
            <input type="hidden" id="idprogram" name="idprogram" value="<?= esc($program['idprogram']); ?>">
            <input type="hidden" id="kodetransaksi" name="kodetransaksi" class="form-control" value="Tasaruf" readonly>
        </div>
    </div>

    <!-- Input Tanggal Transaksi -->
    <div class="form-group row">
        <label for="tgltransaksi" class="col-3 col-form-label">Tanggal Transaksi</label>
        <div class="col-9">
            <input type="date" id="tgltransaksi" name="tgltransaksi" class="form-control" value="<?= set_value('tgltransaksi') ?>" required>
        </div>
    </div>

    <!-- Input Mustahik dengan Checkbox -->
    <div class="form-group row">
        <label class="col-3 col-form-label">Mustahik</label>
        <div class="col-9">
            <div class="form-check">
                <input type="checkbox" id="checkAll" class="form-check-input">
                <label for="checkAll" class="form-check-label"><b>Cek Semua</b></label>
            </div>
            <hr>
            <?php foreach ($mustahik as $item): ?>
                <div class="form-check">
                    <input type="checkbox" name="mustahik[]" value="<?= esc($item['nama']); ?>" class="form-check-input mustahik-checkbox"
                        <?= set_checkbox('mustahik[]', esc($item['nama'])); ?>>
                    <label class="form-check-label"><?= esc($item['nama']); ?></label>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Input Nominal -->
    <div class="form-group row">
        <label for="nominal" class="col-3 col-form-label">Nominal</label>
        <div class="col-9">
            <input type="number" step="0.01" id="nominal" name="nominal" class="form-control" placeholder="Nominal" value="<?= set_value('nominal') ?>" required>
        </div>
    </div>

    <!-- Input Keterangan -->
    <div class="form-group row">
        <label for="keterangan" class="col-3 col-form-label">Keterangan</label>
        <div class="col-9">
            <textarea id="keterangan" name="keterangan" class="form-control" placeholder="Keterangan"><?= set_value('keterangan') ?></textarea>
        </div>
    </div>

    <!-- Submit Button -->
    <div class="form-group row">
        <div class="col-9 offset-3">
            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan Transaksi</button>
            <a href="<?= base_url('admin/transaksi') ?>" class="btn btn-secondary"><i class="fa fa-arrow-left"></i> Kembali</a>
        </div>
    </div>

    <?= form_close(); ?>
</div>

<!-- Script untuk Cek Semua -->
<script>
    document.getElementById('checkAll').addEventListener('change', function() {
        let checkboxes = document.querySelectorAll('.mustahik-checkbox');
        checkboxes.forEach(checkbox => checkbox.checked = this.checked);
    });
</script>
