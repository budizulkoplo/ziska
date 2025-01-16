<div class="row">
	<div class="col-3">
		<img src="<?php if ($mustahik['foto'] === '') {
			echo icon();
		} else {
			echo base_url('assets/upload/image/' . $mustahik['foto']);
		} ?>" class="img img-thumbnail">
	</div>
	<div class="col-9">
		<form action="<?= base_url('admin/mustahik/edit/' . $mustahik['idmustahik']) ?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">

			<?= csrf_field(); ?>
			<input type="hidden" name="id_mustahik" value="<?= $mustahik['idmustahik'] ?>">

			<div class="form-group row">
				<label class="col-3">Nama</label>
				<div class="col-9">
					<input type="text" name="nama" class="form-control" placeholder="Nama" value="<?= $mustahik['nama'] ?>" required>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-3">NIK</label>
				<div class="col-9">
					<input type="text" name="nik" class="form-control" placeholder="NIK" value="<?= $mustahik['nik'] ?>" required>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-3">Alamat</label>
				<div class="col-9">
					<textarea name="alamat" class="form-control" placeholder="Alamat"><?= $mustahik['alamat'] ?></textarea>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-3">No HP</label>
				<div class="col-9">
					<input type="text" name="nohp" class="form-control" placeholder="No HP" value="<?= $mustahik['nohp'] ?>" required>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-3">Keterangan</label>
				<div class="col-9">
					<textarea name="keterangan" class="form-control" placeholder="Keterangan"><?= $mustahik['keterangan'] ?></textarea>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-3">Foto Profil</label>
				<div class="col-9">
					<input type="file" name="foto" class="form-control">
				</div>
			</div>

			<div class="form-group row">
				<label class="col-3"></label>
				<div class="col-9">
					<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
				</div>
			</div>

			<?= form_close(); ?>
		</form>
	</div>
</div>
