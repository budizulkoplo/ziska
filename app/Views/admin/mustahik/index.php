<?php include 'add.php'; ?>

<table class="table table-bordered" id="example1">
    <thead>
        <tr>
            <th width="5%">No</th>
            <th width="15%">Nama</th>
            <th width="15%">Nik</th>
            <th width="10%">Alamat</th>
            <th width="15%">No HP</th>
            <th width="15%">Keterangan</th>
            <th width="10%">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1;
        foreach ($mustahik as $m) { ?>
            <tr>
                <td><?= $no ?></td>
                <td><?= $m['nama'] ?></td>
                <td><?= $m['nik'] ?></td>
                <td><?= $m['alamat'] ?></td>
                <td><?= $m['nohp'] ?></td>
                <td><?= $m['keterangan'] ?></td>
                <td>
                    <a href="<?= base_url('admin/mustahik/edit/' . $m['idmustahik']) ?>" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>
                    <a href="<?= base_url('admin/mustahik/delete/' . $m['idmustahik']) ?>" class="btn btn-dark btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');"><i class="fa fa-trash"></i></a>
                </td>
            </tr>
        <?php $no++; } ?>
    </tbody>
</table>
