<p>
    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-default">
        <i class="fa fa-plus"></i> Tambah Kode Transaksi
    </button>
</p>

<?= form_open(base_url('admin/kodetransaksi')); ?>
<?= csrf_field(); ?>
<div class="modal fade" id="modal-default" tabindex="-1" role="dialog" aria-labelledby="modal-defaultLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Kode Transaksi Baru</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Input Kode Transaksi -->
                <div class="form-group row">
                    <label for="kodetransaksi" class="col-3 col-form-label">Kode Transaksi</label>
                    <div class="col-9">
                        <input type="text" id="kodetransaksi" name="kodetransaksi" class="form-control" placeholder="Kode Transaksi" value="<?= set_value('kodetransaksi') ?>" required>
                    </div>
                </div>

                <!-- Select Cash Flow -->
                <div class="form-group row">
                    <label for="cashflow" class="col-3 col-form-label">Cash Flow</label>
                    <div class="col-9">
                        <select id="cashflow" name="cashflow" class="form-control">
                            <option value="">Pilih Jenis Cash Flow</option>
                            <option value="Pemasukan" <?= set_select('cashflow', 'Pemasukan') ?>>Pemasukan</option>
                            <option value="Pengeluaran" <?= set_select('cashflow', 'Pengeluaran') ?>>Pengeluaran</option>
                        </select>
                    </div>
                </div>

                <!-- Select Rekening -->
                <div class="form-group row">
                    <label for="idrekening" class="col-3 col-form-label">Rekening</label>
                    <div class="col-9">
                        <select id="idrekening" name="idrekening" class="form-control" required>
                            <option value="">Pilih Rekening</option>
                            <?php foreach ($rekening as $rek): ?>
                                <option value="<?= $rek['idrek'] ?>" <?= set_select('idrekening', $rek['idrek']) ?>><?= esc($rek['namarek']) ?> - <?= esc($rek['norek']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

            </div>

            <!-- Modal Footer -->
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Tutup</button>
                <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
            </div>
        </div>
    </div>
</div>
<?= form_close(); ?>
