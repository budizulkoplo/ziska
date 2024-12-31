<div class="container">
    <h3>Riwayat Transaksi</h3>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID Transaksi</th>
                <th>Tanggal Transaksi</th>
                <th>Tipe Transaksi</th>
                <th>Nominal</th>
                <th>Keterangan</th>
<th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($transaksi)): ?>
                <?php foreach ($transaksi as $row): ?>
                    <tr>
                        <td><?= esc($row['idtransaksi']) ?></td>
                        <td><?= date('d-m-Y', strtotime($row['tgltransaksi'])) ?></td>
                        <td><?= esc($row['tipetransaksi']) ?></td>
                        <td><?= number_format($row['nominal'], 2, ',', '.') ?></td>
                        <td><?= esc($row['keterangan']) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" class="text-center">Belum ada transaksi.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
