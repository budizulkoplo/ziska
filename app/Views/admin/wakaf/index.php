<p>
    <a href="<?= base_url('admin/wakaf/create') ?>" class="btn btn-success mb-3">
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
            <td>
                <span class="badge <?= ($item['status'] == 'Aktif') ? 'bg-success' : 'bg-danger' ?>">
                    <?= esc($item['status']) ?>
                </span>
            </td>
            <td>
                <!-- Edit Button -->
                <a href="<?= base_url('admin/wakaf/edit/' . $item['idwakaf']) ?>" class="btn btn-success btn-sm" title="Edit">
                    <i class="fa fa-edit"></i> Edit
                </a>
                
                <!-- Delete Button with Confirmation -->
                <a href="<?= base_url('admin/wakaf/delete/' . $item['idwakaf']) ?>" class="btn btn-dark btn-sm" title="Hapus" onclick="return confirmDelete(event, '<?= esc($item['nosertifikat']) ?>')">
                    <i class="fa fa-trash"></i> Hapus
                </a>
            </td>
        </tr>
        <?php $no++; endforeach; ?>
    </tbody>
</table>

<script>
    // Fungsi konfirmasi untuk menghapus data
    function confirmDelete(event, nosertifikat) {
        if (!confirm('Apakah Anda yakin ingin menghapus data wakaf ini? (' + nosertifikat + ')')) {
            event.preventDefault(); // Cegah penghapusan jika pengguna membatalkan
        }
    }
</script>
