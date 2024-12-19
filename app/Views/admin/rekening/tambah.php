<p>
	<button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-default">
		<i class="fa fa-plus"></i> Tambah Rekening
	</button>
</p>
<?= form_open(base_url('admin/rekening'));
echo csrf_field();
?>
<div class="modal fade" id="modal-default">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Tambah Rekening Baru</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">

				<div class="form-group row">
					<label class="col-3">No. Rekening</label>
					<div class="col-9">
						<input type="text" name="norek" class="form-control" placeholder="Nomor Rekening" value="<?= set_value('norek') ?>" required>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-3">Nama Rekening</label>
					<div class="col-9">
						<input type="text" name="namarek" class="form-control" placeholder="Nama Rekening" value="<?= set_value('namarek') ?>" required>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-3">Saldo</label>
					<div class="col-9">
						<input type="number" name="saldo" class="form-control" placeholder="Saldo Awal" value="<?= set_value('saldo') ?>" required>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-3">Level</label>
					<div class="col-9">
                    <select name="level" class="form-control">
                        <option value="">Pilih Level</option>
                        <?php foreach ($levels as $level) : ?>
                            <option value="<?= $level->name ?>">
                                <?= $level->name ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
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
