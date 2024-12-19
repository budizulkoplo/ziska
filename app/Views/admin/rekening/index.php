<?php include 'tambah.php'; ?>

<table class="table table-bordered" id="example1">
	<thead>
		<tr>
			<th width="5%">No</th>
			<th width="15%">No. Rekening</th>
			<th width="25%">Nama Rekening</th>
			<th width="15%">Saldo</th>
			<th width="15%">Saldo Akhir</th>
			<th width="10%">Level</th>
			<th width="15%">Aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php $no = 1; foreach ($rekening as $rek) { ?>
		<tr>
			<td><?= $no ?></td>
			<td><?= $rek['norek'] ?></td>
			<td><?= $rek['namarek'] ?></td>
			<td>Rp. <?= number_format($rek['saldo'], 2, ',', '.') ?></td>
			<td>Rp. <?= number_format($rek['saldoakhir'], 2, ',', '.') ?></td>
			<td><?= $rek['level'] ?></td>
			<td>
				<a href="<?= base_url('admin/rekening/edit/' . $rek['idrek']) ?>" class="btn btn-success btn-sm">
					<i class="fa fa-edit"></i>
				</a>
				<a href="<?= base_url('admin/rekening/delete/' . $rek['idrek']) ?>" class="btn btn-dark btn-sm" onclick="confirmation(event)">
					<i class="fa fa-trash"></i>
				</a>
			</td>
		</tr>
		<?php $no++; } ?>
	</tbody>
</table>
