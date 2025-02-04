<!DOCTYPE html>
<html lang="en">
<head>
    
    <script>
        function printPage() {
            window.print();
        }
    </script>
</head>
<body>
<div class="container mt-4">
    <h2 class="mb-3">Laporan Transaksi</h2>

    <!-- Tombol Filter Tanggal -->
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#filterModal">
        Filter Tanggal
    </button>
    <button class="btn btn-secondary mb-3" onclick="window.location.href='<?= base_url('admin/laporan/transaksi') ?>'">
        Reset
    </button>

    <!-- Modal Bootstrap -->
    <div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="filterModalLabel">Filter Periode Tanggal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="get">
                        <div class="mb-3">
                            <label for="start_date" class="form-label">Tanggal Mulai:</label>
                            <input type="date" class="form-control" id="start_date" name="start_date" value="<?= esc($start_date) ?>">
                        </div>
                        <div class="mb-3">
                            <label for="end_date" class="form-label">Tanggal Akhir:</label>
                            <input type="date" class="form-control" id="end_date" name="end_date" value="<?= esc($end_date) ?>">
                        </div>
                        <button type="submit" class="btn btn-primary">Terapkan Filter</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabel Data -->
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
                        <td colspan="8" class="text-center">Tidak ada data transaksi pada periode ini.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
