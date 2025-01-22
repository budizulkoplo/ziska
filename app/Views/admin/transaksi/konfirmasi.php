<?= form_open(base_url("admin/transaksi/simpankonfirmasi/{$transaksi['idtransaksi']}"), ['enctype' => 'multipart/form-data']); ?>
<?= csrf_field(); ?>
<div class="container">
    <h3>Konfirmasi Pembayaran</h3>

    <div class="form-group row">
        <label for="tipetransaksi" class="col-3 col-form-label">Transaksi</label>
        <div class="col-9">
            <input type="text" id="tipetransaksi" name="tipetransaksi" class="form-control" value="<?= $transaksi['tipetransaksi'] ?>" readonly>
        </div>
    </div>
    <div class="form-group row">
        <label for="tgltransaksi" class="col-3 col-form-label">Tanggal Transaksi</label>
        <div class="col-9">
            <input 
                type="date" 
                id="tgltransaksi" 
                name="tgltransaksi" 
                class="form-control" 
                value="<?= set_value('tgltransaksi', date('Y-m-d', strtotime($transaksi['tgltransaksi']))) ?>" 
                readonly>
        </div>
    </div>
    <div class="form-group row">
        <label for="muzaki" class="col-3 col-form-label">Muzaki</label>
        <div class="col-9">
            <input type="text" id="muzaki" name="muzaki" class="form-control" value="<?= $transaksi['nama_muzaki'] ?>" readonly>
        </div>
    </div>
    <div class="form-group row">
        <label for="nominal" class="col-3 col-form-label">Nominal</label>
        <div class="col-sm-9 input-group">
            <span class="input-group-text">Rp</span>
            <input type="number" class="form-control" id="nominal" name="nominal" value="<?= $transaksi['nominal'] ?>" readonly>
        </div>
    </div>
    
    <!-- Bagian untuk menampilkan bukti bayar yang sudah diupload atau upload baru -->
    <div class="form-group row">
        <label for="buktibayar" class="col-3 col-form-label">Bukti Pembayaran</label>
        <div class="col-9">
            <!-- Menampilkan gambar bukti bayar jika sudah ada -->
            <?php if (!empty($transaksi['buktibayar'])): ?>
                <div>
                    <img src="<?= base_url('public/uploads/buktibayar/' . $transaksi['buktibayar']) ?>" alt="Bukti Pembayaran" class="img-thumbnail" style="max-width: 300px;">
                    <p>File bukti bayar sudah diunggah.</p>
                    <small>(Anda dapat mengganti bukti bayar dengan mengunggah file baru.)</small>
                </div>
                <!-- Input file untuk mengubah bukti bayar -->
                <input type="file" class="form-control" id="buktibayar" name="buktibayar" accept="image/*">
            <?php else: ?>
                <!-- Jika bukti bayar belum ada, tampilkan input file -->
                <input type="file" class="form-control" id="buktibayar" name="buktibayar" accept="image/*" required>
            <?php endif; ?>
        </div>
    </div>

    <div class="form-group row">
        <div class="col-9 offset-3">
            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan Konfirmasi</button>
            <a href="javascript:void(0)" onclick="window.history.back()" class="btn btn-secondary">
                <i class="fa fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>

</div>
<?= form_close(); ?>
