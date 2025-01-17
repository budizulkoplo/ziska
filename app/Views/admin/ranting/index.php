<?php include 'tambah.php'; ?>

<table class="table table-bordered" id="example1">
    <thead>
        <tr>
            <th width="5%">No</th>
            <th width="75%">Nama Ranting</th>
            <th width="20%">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1; foreach ($ranting as $r): ?>
        <tr>
            <td><?= $no ?></td>
            <td><?= esc($r['namaranting']) ?></td>
            <td>
                <a href="<?= base_url('admin/ranting/edit/' . $r['idranting']) ?>" class="btn btn-success btn-sm" title="Edit">
                    <i class="fa fa-edit"></i> Edit
                </a>
                <a href="<?= base_url('admin/ranting/delete/' . $r['idranting']) ?>" class="btn btn-dark btn-sm" title="Hapus" onclick="confirmation(event)">
                    <i class="fa fa-trash"></i> Hapus
                </a>
            </td>
        </tr>
        <?php $no++; endforeach; ?>
    </tbody>
</table>

