<div class="container">
    <h3>Edit Rekening</h3>

    <?= form_open(base_url('admin/rekening/update/' . $rekening['idrek'])); ?>
    <?= csrf_field(); ?>

    <div class="form-group row">
        <label for="norek" class="col-3 col-form-label">No. Rekening</label>
        <div class="col-9">
            <input type="text" id="norek" name="norek" class="form-control" placeholder="Nomor Rekening" value="<?= set_value('norek', $rekening['norek']) ?>" required>
        </div>
    </div>

    <div class="form-group row">
        <label for="namarek" class="col-3 col-form-label">Nama Rekening</label>
        <div class="col-9">
            <input type="text" id="namarek" name="namarek" class="form-control" placeholder="Nama Rekening" value="<?= set_value('namarek', $rekening['namarek']) ?>" required>
        </div>
    </div>

    <div class="form-group row">
        <label for="saldo" class="col-3 col-form-label">Saldo</label>
        <div class="col-9">
            <input type="number" id="saldo" name="saldo" class="form-control" placeholder="Saldo Awal" value="<?= set_value('saldo', $rekening['saldo']) ?>" required>
        </div>
    </div>

    <div class="form-group row">
        <label for="level" class="col-3 col-form-label">Level</label>
        <div class="col-9">
            <select id="level" name="level" class="form-control" required>
                <option value="">Pilih Level</option>
                <?php foreach ($levels as $level) : ?>
                    <option value="<?= $level->name ?>" <?= set_select('level', $level->name, $rekening['level'] == $level->name) ?>>
                        <?= $level->name ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>

    <div class="form-group row">
        <div class="col-9 offset-3">
            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan Perubahan</button>
            <a href="<?= base_url('admin/rekening') ?>" class="btn btn-secondary"><i class="fa fa-arrow-left"></i> Kembali</a>
        </div>
    </div>

    <?= form_close(); ?>
</div>
