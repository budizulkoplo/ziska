<!-- File: app/Views/admin/laporan/zakat.php -->
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
                    <th>Total Nominal</th>
                    <th>Total Transaksi</th>
                    <th>Total Zakat</th>
                    <th>Total Tasaruf</th>
                    <th>Ranting</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($dataLaporan)): ?>
                    <?php $no = 1; ?>
                    <?php foreach ($dataLaporan as $laporan): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= htmlspecialchars($laporan['judulprogram']) ?></td>
                            <td><?= number_format($laporan['total_nominal'], 0, ',', '.') ?></td>
                            <td><?= $laporan['total_transaksi'] ?></td>
                            <td>Rp. <?= number_format($laporan['total_zakat'], 0, ',', '.') ?></td>
                            <td>Rp. <?= number_format($laporan['total_tasaruf'], 0, ',', '.') ?></td>
                            <td><?= htmlspecialchars($laporan['namaranting']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center">Tidak ada data laporan zakat.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
