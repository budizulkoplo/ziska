<p>
    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-default">
        <i class="fa fa-plus"></i> Tambah Baru
    </button>
</p>

<?= form_open(base_url('admin/muzaki/add'), ['enctype' => 'multipart/form-data']);
echo csrf_field();
?>

<div class="modal fade" id="modal-default">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Data Muzaki</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="form-group row">
                    <label class="col-3">No Anggota</label>
                    <div class="col-9">
                        <input type="text" name="noanggota" class="form-control" placeholder="No Anggota" value="<?= set_value('noanggota') ?>" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-3">Username</label>
                    <div class="col-9">
                        <input type="text" name="username" class="form-control" placeholder="Username" value="<?= set_value('username') ?>" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-3">Password</label>
                    <div class="col-9">
                        <input type="password" name="password" class="form-control" placeholder="Password" value="<?= set_value('password') ?>" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-3">Tipe Anggota</label>
                    <div class="col-9">
                        <select name="tipeanggota" class="form-control" required>
                            <option value="">Pilih Tipe Anggota</option>
                            <option value="Perorangan" <?= set_value('tipeanggota') == 'Perorangan' ? 'selected' : '' ?>>Perorangan</option>
                            <option value="Lembaga" <?= set_value('tipeanggota') == 'Lembaga' ? 'selected' : '' ?>>Lembaga</option>
                            <option value="Korporat" <?= set_value('tipeanggota') == 'Korporat' ? 'selected' : '' ?>>Korporat</option>
                        </select>
                    </div>
                </div>


                <div class="form-group row">
                    <label class="col-3">Nama Lengkap</label>
                    <div class="col-9">
                        <input type="text" name="nama" class="form-control" placeholder="Nama Lengkap" value="<?= set_value('nama') ?>" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-3">NIK</label>
                    <div class="col-9">
                        <input type="text" name="nik" class="form-control" placeholder="NIK" value="<?= set_value('nik') ?>" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-3">Alamat</label>
                    <div class="col-9">
                        <textarea name="alamat" class="form-control" placeholder="Alamat"><?= set_value('alamat') ?></textarea>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-3">No HP</label>
                    <div class="col-9">
                        <input type="text" name="nohp" class="form-control" placeholder="No HP" value="<?= set_value('nohp') ?>" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-3">Keterangan</label>
                    <div class="col-9">
                        <textarea name="keterangan" class="form-control" placeholder="Keterangan"><?= set_value('keterangan') ?></textarea>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-3">Foto</label>
                    <div class="col-9">
                        <input type="file" name="foto" class="form-control" accept="image/*">
                    </div>
                </div>

            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<?= form_close(); ?>
