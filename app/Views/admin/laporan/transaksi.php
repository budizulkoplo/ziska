<!-- File: app/Views/admin/laporan/transaksi.php -->
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
                    <th>Tanggal Transaksi</th>
                    <th>Jenis Transaksi</th>
                    <th>Muzaki</th>
                    <th>Mustahik</th>
                    <th>Nominal</th>
                    <th>Cashflow</th>
                    <th>Judul Program</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($dataLaporanTransaksi)): ?>
                    <?php $no = 1; ?>
                    <?php foreach ($dataLaporanTransaksi as $laporan): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= date('d-m-Y H:i:s', strtotime($laporan['tgltransaksi'])) ?></td>
                            <td><?= htmlspecialchars($laporan['tipetransaksi']) ?></td>
                            <td><?= htmlspecialchars($laporan['muzaki']) ?></td>
                            <td><?= htmlspecialchars($laporan['mustahik']) ?></td>
                            <td>Rp. <?= number_format($laporan['nominal'], 0, ',', '.') ?></td>
                            <td><?= htmlspecialchars($laporan['cashflow']) ?></td>
                            <td><?= htmlspecialchars($laporan['judulprogram']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="8" class="text-center">Tidak ada data transaksi.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
