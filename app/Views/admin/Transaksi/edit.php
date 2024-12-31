<div class="container">
    <h3>Edit Transaksi</h3>

    <?= form_open(base_url('admin/transaksi/updateStatusTransaksi/' . $transaksi['idtransaksi'])); ?>
    <?= csrf_field(); ?>

    <!-- Input Tipetransaksi -->
    <div class="form-group row">
        <label for="tipetransaksi" class="col-3 col-form-label">Tipe Transaksi</label>
        <div class="col-9">
            <select id="tipetransaksi" name="tipetransaksi" class="form-control" required>
                <option value="">Pilih Tipe Transaksi</option>
                <?php foreach ($kodetransaksi as $kode): ?>
                    <option value="<?= esc($kode['kodetransaksi']); ?>" <?= set_select('tipetransaksi', $transaksi['tipetransaksi'], $transaksi['tipetransaksi'] === $kode['kodetransaksi']); ?>>
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
        <input 
            type="date" 
            id="tgltransaksi" 
            name="tgltransaksi" 
            class="form-control" 
            value="<?= set_value('tgltransaksi', date('Y-m-d', strtotime($transaksi['tgltransaksi']))) ?>" 
            required>
    </div>
</div>


    <!-- Input Muzaki -->
    <div class="form-group row">
    <label class="col-3 col-form-label">Nama Muzaki</label>
    <div class="col-9">
        <input type="text" class="form-control" value="<?= esc($transaksi['nama_muzaki'] ?? $transaksi['muzaki']) ?>" disabled>
    </div>
</div>


    <!-- Input Nominal -->
    <div class="form-group row">
        <label for="nominal" class="col-3 col-form-label">Nominal</label>
        <div class="col-9">
            <input type="number" step="0.01" id="nominal" name="nominal" class="form-control" placeholder="Nominal" value="<?= set_value('nominal', $transaksi['nominal']) ?>" required>
        </div>
    </div>

    <!-- Input Keterangan -->
    <div class="form-group row">
        <label for="keterangan" class="col-3 col-form-label">Keterangan</label>
        <div class="col-9">
            <textarea id="keterangan" name="keterangan" class="form-control" placeholder="Keterangan"><?= set_value('keterangan', $transaksi['keterangan']) ?></textarea>
        </div>
    </div>
    <!-- Bagian untuk menampilkan bukti bayar yang sudah diupload -->
    <div class="form-group row">
        <label for="buktibayar" class="col-3 col-form-label">Bukti Pembayaran</label>
        <div class="col-9">
            <!-- Menampilkan gambar bukti bayar jika sudah ada -->
            <?php if (!empty($transaksi['buktibayar'])): ?>
                <div>
                    <img src="<?= base_url('public/uploads/buktibayar/' . $transaksi['buktibayar']) ?>" alt="Bukti Pembayaran" class="img-thumbnail" style="max-width: 300px;">
                    <p>File bukti bayar sudah diunggah.</p>
                </div>
            <?php else: ?>
                <input type="file" class="form-control" id="buktibayar" name="buktibayar" accept="image/*" required>
            <?php endif; ?>
        </div>
    </div>

    <!-- Input Status -->
    <div class="form-group row">
        <label for="status" class="col-3 col-form-label">Status</label>
        <div class="col-9">
            <select id="status" name="status" class="form-control" required>
                <option value="pending" <?= set_select('status', 'pending', $transaksi['status'] === 'pending'); ?>>Pending</option>
                <option value="verifikasi" <?= set_select('status', 'verifikasi', $transaksi['status'] === 'verifikasi'); ?>>Verifikasi</option>
                <option value="sukses" <?= set_select('status', 'sukses', $transaksi['status'] === 'sukses'); ?>>Sukses</option>
            </select>
        </div>
    </div>

    <!-- Submit Button -->
    <div class="form-group row">
        <div class="col-9 offset-3">
            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Update Transaksi</button>
            <a href="<?= base_url('admin/transaksi') ?>" class="btn btn-secondary"><i class="fa fa-arrow-left"></i> Kembali</a>
        </div>
    </div>

    <?= form_close(); ?>
</div>
