<div class="container mt-4">
    <h3 class="text-center">Kalkulator Zakat</h3>

    <div class="card">
        <div class="card-header bg-success text-white">
            Pilih Jenis Zakat
        </div>
        <div class="card-body">
            <form>
                <div class="form-group row">
                    <label for="jenisZakat" class="col-sm-6 col-form-label">Jenis Zakat</label>
                    <div class="col-sm-6">
                        <select class="form-control" id="jenisZakat" onchange="navigateToZakat()">
                            <option value="">Pilih Jenis Zakat</option>
                            <option value="<?= base_url('admin/kalkulatorzakat/maal') ?>">Zakat Harta (Maal)</option>
                            <option value="<?= base_url('admin/kalkulatorzakat/pertanian') ?>">Zakat Pertanian</option>
                        </select>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function navigateToZakat() {
        const jenisZakat = document.getElementById('jenisZakat').value;
        if (jenisZakat) {
            window.location.href = jenisZakat;
        }
    }
</script>
