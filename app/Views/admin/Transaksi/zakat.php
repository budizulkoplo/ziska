<div class="container">
    <h3>Tambah Transaksi</h3>

    <?= form_open(base_url('admin/transaksi/store')); ?>
    <?= csrf_field(); ?>

    <!-- Input Tipetransaksi -->
    <div class="form-group row">
        <label for="tipetransaksi" class="col-3 col-form-label">Tipe Transaksi</label>
        <div class="col-9">
            <select id="tipetransaksi" name="tipetransaksi" class="form-control" required>
                <option value="">Pilih Tipe Transaksi</option>
                <?php foreach ($kodetransaksi as $kode): ?>
                    <option value="<?= esc($kode['kodetransaksi']); ?>" <?= set_select('tipetransaksi', esc($kode['kodetransaksi'])); ?>>
                        <?= esc($kode['kodetransaksi']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>

    <!-- Input Tanggal Transaksi -->
    <div class="form-group row">
        <label for="tgltransaksi" class="col-3 col-form-label">Tanggal Transaksi</label>
        <div class="col-9">
            <input type="date" id="tgltransaksi" name="tgltransaksi" class="form-control" value="<?= set_value('tgltransaksi') ?>" required>
        </div>
    </div>

    <!-- Input Muzaki -->
    <div class="form-group row">
        <label for="muzaki" class="col-3 col-form-label">Muzaki</label>
        <div class="col-9">
            <input type="text" id="muzaki" name="muzaki" class="form-control" placeholder="Nama Muzaki" value="<?= set_value('muzaki') ?>" required>
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
