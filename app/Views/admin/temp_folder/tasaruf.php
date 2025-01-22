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
    
    <div class="form-group row">
        <label for="tgltransaksi" class="col-3 col-form-label">Tanggal Transaksi</label>
        <div class="col-9">
            <input type="date" id="tgltransaksi" name="tgltransaksi" class="form-control" value="<?= set_value('tgltransaksi') ?>" required>
        </div>
    </div>
    <!-- Input mustahik (tergantung pada program yang dipilih) -->
    <div class="form-group row">
        <label for="mustahik" class="col-3 col-form-label">Mustahik</label>
        <div class="col-9">
            <select id="mustahik" name="mustahik" class="form-control" required>
                <option value="">Pilih Mustahik</option>
                <?php foreach ($mustahik as $item): ?>
                    <option value="<?= esc($item['nama']); ?>" <?= set_select('nama', esc($item['nama'])); ?>>
                        <?= esc($item['nama']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
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
