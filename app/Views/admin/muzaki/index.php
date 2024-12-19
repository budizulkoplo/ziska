<?php include 'add.php'; ?>

<table class="table table-bordered" id="example1">
    <thead>
        <tr>
            <th width="5%">No</th>
            <th width="15%">No Anggota</th>
            <th width="15%">Nama</th>
            <th width="15%">Username</th>
            <th width="10%">Tipe Anggota</th>
            <th width="15%">No HP</th>
            <th width="15%">Keterangan</th>
            <th width="10%">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1;
        foreach ($muzaki as $m) { ?>
            <tr>
                <td><?= $no ?></td>
                <td><?= $m['noanggota'] ?></td>
                <td><?= $m['nama'] ?></td>
                <td><?= $m['username'] ?></td>
                <td><?= $m['tipeanggota'] ?></td>
                <td><?= $m['nohp'] ?></td>
                <td><?= $m['keterangan'] ?></td>
                <td>
                    <a href="<?= base_url('admin/muzaki/edit/' . $m['id']) ?>" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>
                    <a href="<?= base_url('admin/muzaki/delete/' . $m['id']) ?>" class="btn btn-dark btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');"><i class="fa fa-trash"></i></a>
                </td>
            </tr>
        <?php $no++; } ?>
    </tbody>
</table>
