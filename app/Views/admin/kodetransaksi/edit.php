<div class="container">
    <h3>Edit Kode Transaksi</h3>

    <!-- Form Edit Kode Transaksi -->
    <?= form_open(base_url('admin/kodetransaksi/update/' . $kodetransaksi['idkodetransaksi'])); ?>
    <?= csrf_field(); ?>

    <!-- Input Kode Transaksi -->
    <div class="form-group row">
        <label for="kodetransaksi" class="col-3 col-form-label">Kode Transaksi</label>
        <div class="col-9">
            <input type="text" id="kodetransaksi" name="kodetransaksi" class="form-control" placeholder="Kode Transaksi" value="<?= set_value('kodetransaksi', $kodetransaksi['kodetransaksi']) ?>" required>
            <!-- Error Validation for kodetransaksi -->
            <?php if (isset($validation) && $validation->hasError('kodetransaksi')): ?>
                <div class="text-danger">
                    <?= $validation->getError('kodetransaksi'); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Select Cash Flow -->
    <div class="form-group row">
        <label for="cashflow" class="col-3 col-form-label">Cash Flow</label>
        <div class="col-9">
            <select id="cashflow" name="cashflow" class="form-control" required>
                <option value="">Pilih Jenis Cash Flow</option>
                <option value="Pemasukan" <?= set_select('cashflow', 'Pemasukan', $kodetransaksi['cashflow'] == 'Pemasukan') ?>>Pemasukan</option>
                <option value="Pengeluaran" <?= set_select('cashflow', 'Pengeluaran', $kodetransaksi['cashflow'] == 'Pengeluaran') ?>>Pengeluaran</option>
            </select>
            <!-- Error Validation for cashflow -->
            <?php if (isset($validation) && $validation->hasError('cashflow')): ?>
                <div class="text-danger">
                    <?= $validation->getError('cashflow'); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Select Rekening -->
    <div class="form-group row">
        <label for="idrekening" class="col-3 col-form-label">Rekening</label>
        <div class="col-9">
            <select id="idrekening" name="idrekening" class="form-control" required>
                <option value="">Pilih Rekening</option>
                <?php foreach ($rekening as $rek): ?>
                    <option value="<?= $rek['idrek'] ?>" <?= set_select('idrekening', $rek['idrek'], $rek['idrek'] == $kodetransaksi['idrekening']) ?>>
                        <?= esc($rek['namarek']) ?> - <?= esc($rek['norek']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <!-- Error Validation for idrekening -->
            <?php if (isset($validation) && $validation->hasError('idrekening')): ?>
                <div class="text-danger">
                    <?= $validation->getError('idrekening'); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Button Submit and Back -->
    <div class="form-group row">
        <div class="col-9 offset-3">
            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan Perubahan</button>
            <a href="<?= base_url('admin/kodetransaksi') ?>" class="btn btn-secondary"><i class="fa fa-arrow-left"></i> Kembali</a>
        </div>
    </div>

    <?= form_close(); ?>
</div>
