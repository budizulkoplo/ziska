<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <script>
        function printPage() {
            window.print();
        }
    </script>
</head>
<body>
<div class="container">
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul Program</th>
                    <th>Total Transaksi</th>
                    <th>Total Penghimpunan</th>
                    <th>Total Tasaruf</th>
                    <th>Sisa</th>
                    <th>Ranting</th>
                    <th>Aksi</th> <!-- Tambahkan kolom Aksi -->
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($dataLaporan)): ?>
                    <?php $no = 1; ?>
                    <?php foreach ($dataLaporan as $laporan): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= htmlspecialchars($laporan['judulprogram']) ?></td>
                            <td><?= number_format($laporan['total_transaksi'], 0, ',', '.') ?></td>
                            <td>Rp. <?= number_format($laporan['total_zakat'], 0, ',', '.') ?></td>
                            <td>Rp. <?= number_format($laporan['total_tasaruf'], 0, ',', '.') ?></td>
                            <td>Rp. <?= number_format($laporan['total_zakat'] - $laporan['total_tasaruf'], 0, ',', '.') ?></td>
                            <td><?= htmlspecialchars($laporan['namaranting']) ?></td>
                            <td>
                                <a href="<?= base_url('admin/laporan/detailprogram/' . $laporan['idprogram']) ?>" class="btn btn-info btn-sm">Detail</a>
                            </td> 
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="8" class="text-center">Tidak ada data laporan zakat.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
