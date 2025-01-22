<!-- File: app/Views/admin/laporan/zakat.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        function printPage() {
            window.print();
        }
    </script>
</head>
<body>
<div class="container mb-4">
    <form method="GET" action="">
        <div class="row align-items-center">
            <div class="col-md-3">
                <label for="tahun_dari">Dari Tahun</label>
                <input type="number" name="tahun_dari" id="tahun_dari" class="form-control"
                    value="<?= $tahun_dari ?>" min="2000" max="<?= date('Y') ?>">
            </div>
            <div class="col-md-3">
                <label for="tahun_ke">Ke Tahun</label>
                <input type="number" name="tahun_ke" id="tahun_ke" class="form-control"
                    value="<?= $tahun_ke ?>" min="2000" max="<?= date('Y') ?>">
            </div>
            <div class="col-md-3">
                <label for="bulan_dari">Dari Bulan</label>
                <select name="bulan_dari" id="bulan_dari" class="form-control">
                    <?php for ($i = 1; $i <= 12; $i++): ?>
                        <option value="<?= $i ?>" <?= $bulan_dari == $i ? 'selected' : '' ?>>
                            <?= DateTime::createFromFormat('!m', $i)->format('F') ?>
                        </option>
                    <?php endfor; ?>
                </select>
            </div>
            <div class="col-md-3">
                <label for="bulan_ke">Ke Bulan</label>
                <select name="bulan_ke" id="bulan_ke" class="form-control">
                    <?php for ($i = 1; $i <= 12; $i++): ?>
                        <option value="<?= $i ?>" <?= $bulan_ke == $i ? 'selected' : '' ?>>
                            <?= DateTime::createFromFormat('!m', $i)->format('F') ?>
                        </option>
                    <?php endfor; ?>
                </select>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-12 text-right">
                <button type="submit" class="btn btn-primary">Filter</button>
            </div>
        </div>
    </form>
</div>

    <!-- Grafik Tahunan -->
    <h4>Grafik Pemasukan dan Pengeluaran Tahunan</h4>
    <canvas id="grafikTahunan"></canvas>

    <!-- Grafik Bulanan -->
    <h4>Grafik Pemasukan dan Pengeluaran Bulanan</h4>
    <canvas id="grafikBulanan"></canvas>

    <!-- Grafik per Ranting -->
    <h4>Grafik Pemasukan dan Pengeluaran per Ranting</h4>
    <canvas id="grafikRanting"></canvas>

    <script>
        // Grafik Tahunan
        const dataTahunan = <?php echo json_encode($dataTahunan); ?>;
        const tahunLabels = dataTahunan.map(item => item.tahun);
        const pemasukanTahunan = dataTahunan.map(item => item.pemasukan);
        const pengeluaranTahunan = dataTahunan.map(item => item.pengeluaran);

        const ctxTahunan = document.getElementById('grafikTahunan').getContext('2d');
        new Chart(ctxTahunan, {
            type: 'bar',
            data: {
                labels: tahunLabels,
                datasets: [
                    {
                        label: 'Pemasukan',
                        data: pemasukanTahunan,
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Tasaruf',
                        data: pengeluaranTahunan,
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1
                    }
                ]
            }
        });

        // Grafik Bulanan
        const dataBulanan = <?php echo json_encode($dataBulanan); ?>;
        const bulanLabels = dataBulanan.map(item => item.tahun + '-' + item.bulan);
        const pemasukanBulanan = dataBulanan.map(item => item.pemasukan);
        const pengeluaranBulanan = dataBulanan.map(item => item.pengeluaran);

        const ctxBulanan = document.getElementById('grafikBulanan').getContext('2d');
        new Chart(ctxBulanan, {
            type: 'bar',
            data: {
                labels: bulanLabels,
                datasets: [
                    {
                        label: 'Pemasukan',
                        data: pemasukanBulanan,
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Tasaruf',
                        data: pengeluaranBulanan,
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1
                    }
                ]
            }
        });

        // Grafik per Ranting
        const dataRanting = <?php echo json_encode($dataRanting); ?>;
        const rantingLabels = dataRanting.map(item => item.namaranting);
        const pemasukanRanting = dataRanting.map(item => item.pemasukan);
        const pengeluaranRanting = dataRanting.map(item => item.pengeluaran);

        const ctxRanting = document.getElementById('grafikRanting').getContext('2d');
        new Chart(ctxRanting, {
            type: 'bar',
            data: {
                labels: rantingLabels,
                datasets: [
                    {
                        label: 'Pemasukan',
                        data: pemasukanRanting,
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Tasaruf',
                        data: pengeluaranRanting,
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1
                    }
                ]
            }
        });

        
    </script>
</div>
</body>
</html>
