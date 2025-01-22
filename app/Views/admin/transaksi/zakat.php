<?php
$session = \Config\Services::session();
$jumlah = isset($_GET['jumlah']) ? htmlspecialchars($_GET['jumlah']) : ''; 
$jenis = isset($_GET['jenis']) ? htmlspecialchars($_GET['jenis']) : ''; 
$muzaki = $session->get('nama');
?>

<div class="container">
    <h3>Tambah Transaksi</h3>

    <?= form_open(base_url('admin/transaksi/bayarzakat')); ?>
    <?= csrf_field(); ?>
    <div class="form-group row">
        <label for="tipetransaksi" class="col-3 col-form-label">Transaksi</label>
        <div class="col-9">
            <input type="text" id="tipetransaksi" name="tipetransaksi" class="form-control" value="Zakat" readonly>
        </div>
    </div>
    <div class="form-group row">
        <label for="tipetransaksi" class="col-3 col-form-label">Zakat</label>
        <div class="col-9">
            <input type="text" id="jeniszakat" name="jeniszakat" class="form-control" value="<?= $jenis ?>" readonly>
        </div>
    </div>
    <div class="form-group row">
        <label for="tgltransaksi" class="col-3 col-form-label">Tanggal Transaksi</label>
        <div class="col-9">
            <input type="date" id="tgltransaksi" name="tgltransaksi" class="form-control" value="<?= set_value('tgltransaksi') ?>" required>
        </div>
    </div>
    <div class="form-group row">
        <label for="muzaki" class="col-3 col-form-label">Muzaki</label>
        <div class="col-9">
            <input type="text" id="muzaki" name="muzaki" class="form-control" placeholder="Nama Muzaki" value="<?= $muzaki ?>" readonly>
        </div>
    </div>
    <div class="form-group row">
        <label for="nominal" class="col-3 col-form-label">Nominal</label>
        <div class="col-sm-9 input-group">
            <span class="input-group-text">Rp</span>
            
            <input type="number" class="form-control" id="nominal" name="nominal" value="<?= $jumlah ?>" readonly>

        </div>
    </div>
    <div class="form-group row">
    <label for="idrek" class="col-3 col-form-label">Rekening</label>
    <div class="col-9">
        <select id="idrek" name="idrek" class="form-control" required>
            <option value="">-- Pilih Rekening --</option>
            <?php foreach ($rekening as $rek): ?>
                <option value="<?= $rek['idrek'] ?>"><?= $rek['namarek'] ?> - <?= $rek['norek'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    </div>
    <div class="form-group row">
        <label for="keterangan" class="col-3 col-form-label">Keterangan</label>
        <div class="col-9">
            <textarea id="keterangan" name="keterangan" class="form-control" placeholder="Keterangan"><?= set_value('keterangan') ?></textarea>
        </div>
    </div>

    <div class="form-group row">
        <div class="col-9 offset-3">
            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Bayar Zakat</button>
            <a href="javascript:void(0)" onclick="window.history.back()" class="btn btn-secondary">
                <i class="fa fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>

    <?= form_close(); ?>
</div>
