<!-- views/admin/kodetransaksi/index.php -->
<?php include 'tambah.php'; ?>

<div class="table-responsive">
    <table class="table table-bordered table-striped" id="example1">
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="20%">Kode Transaksi</th>
                <th width="15%">Cash Flow</th>
                <th width="25%">Rekening</th>
                <th width="15%">Nomor Rekening</th>
                <th width="20%">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; foreach ($kodetransaksi as $kode): ?>
            <tr>
                <td><?= $no ?></td>
                <td><?= esc($kode['kodetransaksi']) ?></td>
                <td>
                    <span class="badge <?= ($kode['cashflow'] === 'Pemasukan') ? 'bg-success' : 'bg-danger' ?>">
                        <?= esc($kode['cashflow']) ?>
                    </span>
                </td>
                <td><?= esc($kode['namarek']) ?></td>
                <td><?= esc($kode['norek']) ?></td>
                <td>
                    <a href="<?= base_url('admin/kodetransaksi/edit/' . $kode['idkodetransaksi']) ?>" class="btn btn-success btn-sm" title="Edit">
                        <i class="fa fa-edit"></i> Edit
                    </a>
                    <a href="<?= base_url('admin/kodetransaksi/delete/' . $kode['idkodetransaksi']) ?>" class="btn btn-dark btn-sm" title="Hapus" onclick="return confirmDelete(event);">
                        <i class="fa fa-trash"></i> Hapus
                    </a>
                </td>
            </tr>
            <?php $no++; endforeach; ?>
        </tbody>
    </table>
</div>

<script>
    // Konfirmasi sebelum penghapusan
    function confirmDelete(event) {
        if (!confirm('Apakah Anda yakin ingin menghapus data ini?')) {
            event.preventDefault();
        }
    }
</script>
