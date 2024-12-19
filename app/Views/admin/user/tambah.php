<p>
	<button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-default">
		<i class="fa fa-plus"></i> Tambah Baru
	</button>
</p>

<?= form_open(base_url('admin/user')); ?>
<?= csrf_field(); ?>
<div class="modal fade" id="modal-default">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Tambah Baru</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">

				<!-- Nama Pengguna -->
				<div class="form-group row">
					<label class="col-3">Nama Pengguna</label>
					<div class="col-9">
						<input type="text" name="nama" class="form-control" placeholder="Nama user" value="<?= set_value('nama') ?>" required>
						<?php if (isset($validation) && $validation->getError('nama')): ?>
							<div class="text-danger"><?= $validation->getError('nama'); ?></div>
						<?php endif; ?>
					</div>
				</div>

				<!-- Email -->
				<div class="form-group row">
					<label class="col-3">Email</label>
					<div class="col-9">
						<input type="email" name="email" class="form-control" placeholder="Email" value="<?= set_value('email') ?>" required>
						<?php if (isset($validation) && $validation->getError('email')): ?>
							<div class="text-danger"><?= $validation->getError('email'); ?></div>
						<?php endif; ?>
					</div>
				</div>

				<!-- Username -->
				<div class="form-group row">
					<label class="col-3">Username</label>
					<div class="col-9">
						<input type="text" name="username" class="form-control" placeholder="Username" value="<?= set_value('username') ?>" required>
						<?php if (isset($validation) && $validation->getError('username')): ?>
							<div class="text-danger"><?= $validation->getError('username'); ?></div>
						<?php endif; ?>
					</div>
				</div>

				<!-- Password -->
				<div class="form-group row">
					<label class="col-3">Password</label>
					<div class="col-9">
						<input type="password" name="password" class="form-control" placeholder="Password" value="<?= set_value('password') ?>" required>
						<small class="text-danger">Minimal 6 karakter dan maksimal 32 karakter</small>
						<?php if (isset($validation) && $validation->getError('password')): ?>
							<div class="text-danger"><?= $validation->getError('password'); ?></div>
						<?php endif; ?>
					</div>
				</div>

				<!-- Nik -->
				<div class="form-group row">
					<label class="col-3">NIK</label>
					<div class="col-9">
						<input type="text" name="nik" class="form-control" placeholder="Nomor Induk Kependudukan" value="<?= set_value('nik') ?>" required>
						<?php if (isset($validation) && $validation->getError('nik')): ?>
							<div class="text-danger"><?= $validation->getError('nik'); ?></div>
						<?php endif; ?>
					</div>
				</div>

				<!-- Alamat -->
				<div class="form-group row">
					<label class="col-3">Alamat</label>
					<div class="col-9">
						<input type="text" name="alamat" class="form-control" placeholder="Alamat" value="<?= set_value('alamat') ?>" required>
						<?php if (isset($validation) && $validation->getError('alamat')): ?>
							<div class="text-danger"><?= $validation->getError('alamat'); ?></div>
						<?php endif; ?>
					</div>
				</div>

				<!-- No HP -->
				<div class="form-group row">
					<label class="col-3">No HP</label>
					<div class="col-9">
						<input type="text" name="nohp" class="form-control" placeholder="Nomor HP" value="<?= set_value('nohp') ?>" required>
						<?php if (isset($validation) && $validation->getError('nohp')): ?>
							<div class="text-danger"><?= $validation->getError('nohp'); ?></div>
						<?php endif; ?>
					</div>
				</div>

				<!-- Keterangan -->
				<div class="form-group row">
					<label class="col-3">Keterangan</label>
					<div class="col-9">
						<textarea name="keterangan" class="form-control" placeholder="Keterangan"><?= set_value('keterangan') ?></textarea>
						<?php if (isset($validation) && $validation->getError('keterangan')): ?>
							<div class="text-danger"><?= $validation->getError('keterangan'); ?></div>
						<?php endif; ?>
					</div>
				</div>

				<!-- Level Akses -->
				<div class="form-group row">
					<label class="col-3">Level</label>
					<div class="col-9">
						<select name="akses_level" class="form-control">
							<option value="Admin" <?= set_value('akses_level') == 'Admin' ? 'selected' : ''; ?>>Admin</option>
							<option value="User" <?= set_value('akses_level') == 'User' ? 'selected' : ''; ?>>User</option>
						</select>
					</div>
				</div>

				<!-- Upload Gambar -->
				<div class="form-group row">
					<label class="col-3">Foto Profil</label>
					<div class="col-9">
						<input type="file" name="gambar" class="form-control" accept="image/*">
						<?php if (isset($validation) && $validation->getError('gambar')): ?>
							<div class="text-danger"><?= $validation->getError('gambar'); ?></div>
						<?php endif; ?>
					</div>
				</div>

			</div>
			<div class="modal-footer justify-content-between">
				<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
				<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
			</div>
		</div>
	</div>
</div>
<?= form_close(); ?>
