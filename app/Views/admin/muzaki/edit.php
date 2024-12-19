<div class="row">
	<div class="col-3">
		<img src="<?php if ($muzaki['foto'] === '') {
			echo icon();
		} else {
			echo base_url('public/assets/upload/muzaki/' . $muzaki['foto']);
		} ?>" class="img img-thumbnail">
	</div>
	<div class="col-9">
		<form action="<?= base_url('admin/muzaki/edit/' . $muzaki['id']) ?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">

			<?= csrf_field(); ?>
			<input type="hidden" name="id_muzaki" value="<?= $muzaki['id'] ?>">
			
			<div class="form-group row">
				<label class="col-3">No Anggota</label>
				<div class="col-9">
					<input type="text" name="noanggota" class="form-control" placeholder="No Anggota" value="<?= $muzaki['noanggota'] ?>" required>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-3">Username</label>
				<div class="col-9">
					<input type="text" name="username" class="form-control" placeholder="Username" value="<?= $muzaki['username'] ?>" required>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-3">Password</label>
				<div class="col-9">
					<input type="text" name="password" class="form-control" placeholder="Password" value="">
					<small class="text-danger">Minimal 6 karakter dan maksimal 32 karakter atau biarkan kosong</small>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-3">Tipe Anggota</label>
				<div class="col-9">
					<input type="text" name="tipeanggota" class="form-control" placeholder="Tipe Anggota" value="<?= $muzaki['tipeanggota'] ?>" required>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-3">Nama</label>
				<div class="col-9">
					<input type="text" name="nama" class="form-control" placeholder="Nama" value="<?= $muzaki['nama'] ?>" required>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-3">NIK</label>
				<div class="col-9">
					<input type="text" name="nik" class="form-control" placeholder="NIK" value="<?= $muzaki['nik'] ?>" required>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-3">Alamat</label>
				<div class="col-9">
					<textarea name="alamat" class="form-control" placeholder="Alamat"><?= $muzaki['alamat'] ?></textarea>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-3">No HP</label>
				<div class="col-9">
					<input type="text" name="nohp" class="form-control" placeholder="No HP" value="<?= $muzaki['nohp'] ?>" required>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-3">Keterangan</label>
				<div class="col-9">
					<textarea name="keterangan" class="form-control" placeholder="Keterangan"><?= $muzaki['keterangan'] ?></textarea>
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
