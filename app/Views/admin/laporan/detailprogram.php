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
    <h3>Detail Program: <?= htmlspecialchars($namaProgram) ?></h3>
    <hr>
    
    <!-- Tabel Penghimpunan (Muzaki) -->
    <h4>Data Penghimpunan (Muzaki)</h4>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal Transaksi</th>
                    <th>Muzaki</th>
                    
                    <th>Penghimpunan</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $totalPenghimpunan = 0;
                if (!empty($dataMuzaki)): 
                    $no = 1;
                    foreach ($dataMuzaki as $muzaki): 
                        $totalPenghimpunan += $muzaki['nominal'];
                ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $muzaki['tgltransaksi'] ?></td>
                        <td><?= $muzaki['nama_muzaki'] ?></td>
                        
                        <td>Rp. <?= number_format($muzaki['nominal'], 0, ',', '.') ?></td>
                    </tr>
                <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center">Tidak ada data penghimpunan.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="3" class="text-right">Total Penghimpunan:</th>
                    <th>Rp. <?= number_format($totalPenghimpunan, 0, ',', '.') ?></th>
                </tr>
            </tfoot>
        </table>
    </div>
    
    <!-- Tabel Tasaruf (Mustahik) -->
    <h4>Data Tasaruf (Mustahik)</h4>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal Transaksi</th>
                    <th>Mustahik</th>
                    
                    <th>Tasaruf</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $totalTasaruf = 0;
                if (!empty($dataMustahik)): 
                    $no = 1;
                    foreach ($dataMustahik as $mustahik): 
                        $totalTasaruf += $mustahik['nominal'];
                ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $mustahik['tgltransaksi'] ?></td>
                        <td><?= $mustahik['nama_mustahik'] ?></td>
                        
                        <td>Rp. <?= number_format($mustahik['nominal'], 0, ',', '.') ?></td>
                    </tr>
                <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center">Tidak ada data tasaruf.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="3" class="text-right">Total Tasaruf:</th>
                    <th>Rp. <?= number_format($totalTasaruf, 0, ',', '.') ?></th>
                </tr>
            </tfoot>
        </table>
    </div>
    
    <!-- Sisa Dana -->
    <h4>Sisa Dana</h4>
    <table class="table table-bordered">
        <tr>
            <th>Total Penghimpunan</th>
            <td>Rp. <?= number_format($totalPenghimpunan, 0, ',', '.') ?></td>
        </tr>
        <tr>
            <th>Total Tasaruf</th>
            <td>Rp. <?= number_format($totalTasaruf, 0, ',', '.') ?></td>
        </tr>
        <tr>
            <th>Sisa Dana</th>
            <td>Rp. <?= number_format($totalPenghimpunan - $totalTasaruf, 0, ',', '.') ?></td>
        </tr>
    </table>
    
    <!-- Tombol Back -->
    <div class="btn-back">
        <a href="<?= base_url('admin/laporan/program') ?>" class="btn btn-secondary">
            <i class="fa fa-arrow-left"></i> Kembali
        </a>
    </div>
</div>
</body>
</html>
