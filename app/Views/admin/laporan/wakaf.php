<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Wakaf</title>
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
                    <th>Nama Wakaf</th>
                    <th>ID Object</th>
                    <th>ID Wakaf</th>
                    <th>No Sertifikat</th>
                    <th>Alamat</th>
                    <th>Pewakaf</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($dataWakaf)): ?>
                    <?php $no = 1; ?>
                    <?php foreach ($dataWakaf as $wakaf): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= htmlspecialchars($wakaf['namawakaf']) ?></td>
                            <td><?= htmlspecialchars($wakaf['idobject']) ?></td>
                            <td><?= htmlspecialchars($wakaf['idwakaf']) ?></td>
                            <td><?= htmlspecialchars($wakaf['nosertifikat']) ?></td>
                            <td><?= htmlspecialchars($wakaf['alamat']) ?></td>
                            <td><?= htmlspecialchars($wakaf['pewakaf']) ?></td>
                            <td><?= htmlspecialchars($wakaf['status']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="8" class="text-center">Tidak ada data wakaf tersedias.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
