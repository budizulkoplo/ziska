<div class="container">
    <h3>Edit Ranting</h3>

    <!-- Form Edit Ranting -->
    <?= form_open(base_url('admin/ranting/update/' . $ranting['idranting'])); ?>
    <?= csrf_field(); ?>

    <!-- Input Nama Ranting -->
    <div class="form-group row">
        <label for="namaranting" class="col-3 col-form-label">Nama Ranting</label>
        <div class="col-9">
            <input type="text" id="namaranting" name="namaranting" class="form-control" placeholder="Nama Ranting" value="<?= set_value('namaranting', $ranting['namaranting']) ?>" required>
            <!-- Error Validation for namaranting -->
            <?php if (isset($validation) && $validation->hasError('namaranting')): ?>
                <div class="text-danger">
                    <?= $validation->getError('namaranting'); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Button Submit and Back -->
    <div class="form-group row">
        <div class="col-9 offset-3">
            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan Perubahan</button>
            <a href="<?= base_url('admin/ranting') ?>" class="btn btn-secondary"><i class="fa fa-arrow-left"></i> Kembali</a>
        </div>
    </div>

    <?= form_close(); ?>
</div>
