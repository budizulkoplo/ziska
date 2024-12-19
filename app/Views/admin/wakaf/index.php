<p>
    <a href="<?= base_url('admin/wakaf/create') ?>" class="btn btn-success">
        <i class="fa fa-plus"></i> Tambah Wakaf Baru
    </a>
</p>

<table class="table table-bordered" id="example1">
    <thead>
        <tr>
            <th width="5%">No</th>
            <th width="20%">No Sertifikat</th>
            <th width="20%">Alamat</th>
            <th width="20%">Pewakaf</th>
            <th width="15%">Status</th>
            <th width="20%">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1; foreach ($wakaf as $item): ?>
        <tr>
            <td><?= $no ?></td>
            <td><?= esc($item['nosertifikat']) ?></td>
            <td><?= esc($item['alamat']) ?></td>
            <td><?= esc($item['pewakaf']) ?></td>
            <td><?= esc($item['status']) ?></td>
            <td>
                <a href="<?= base_url('admin/wakaf/edit/' . $item['idwakaf']) ?>" class="btn btn-success btn-sm">
                    <i class="fa fa-edit"></i> Edit
                </a>
                <a href="<?= base_url('admin/wakaf/delete/' . $item['idwakaf']) ?>" class="btn btn-dark btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data wakaf ini?')">
                    <i class="fa fa-trash"></i> Hapus
                </a>
            </td>
        </tr>
        <?php $no++; endforeach; ?>
    </tbody>
</table>
