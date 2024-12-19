<p>
    <a href="<?= base_url('admin/programlazis/create') ?>" class="btn btn-success">
        <i class="fa fa-plus"></i> Tambah Program Baru
    </a>
</p>

<table class="table table-bordered" id="example1">
    <thead>
        <tr>
            <th width="5%">No</th>
            <th width="8%">Foto</th>
            <th width="25%">Judul</th>
            <th width="15%">Tanggal Mulai</th>
            <th width="15%">Tanggal Selesai</th>
            <th width="15%">Target Donasi</th>
            <th width="10%">Terkumpul</th>
            <th width="10%">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1; foreach ($program as $item): ?>
        <tr>
            <td><?= $no ?></td>
            <td>
                <?php if ($item['foto'] === ''): ?>
                    -
                <?php else: ?>
                    <img src="<?= base_url('assets/upload/programlazis/' . $item['foto']) ?>" class="img img-thumbnail" width="50">
                <?php endif; ?>
            </td>
            <td>
                <a href="<?= base_url('admin/programlazis/edit/' . $item['idprogram']) ?>">
                    <?= $item['judul'] ?>
                </a>
            </td>
            <td><?= date('d-m-Y', strtotime($item['tglmulai'])) ?></td>
            <td><?= date('d-m-Y', strtotime($item['tglselesai'])) ?></td>
            <td><?= number_format($item['targetdonasi'], 0, ',', '.') ?></td>
            <td><?= number_format($item['terkumpul'], 0, ',', '.') ?></td>
            <td>
                <a href="<?= base_url('admin/programlazis/edit/' . $item['idprogram']) ?>" class="btn btn-success btn-sm">
                    <i class="fa fa-edit"></i> Edit
                </a>
                <a href="<?= base_url('admin/programlazis/delete/' . $item['idprogram']) ?>" class="btn btn-dark btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus program ini?')">
                    <i class="fa fa-trash"></i> Hapus
                </a>
            </td>
        </tr>
        <?php $no++; endforeach; ?>
    </tbody>
</table>
