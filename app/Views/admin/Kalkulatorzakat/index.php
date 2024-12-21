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
                        <select class="form-control" id="jenisZakat" onchange="showZakatForm()">
                            <option value="">Pilih Jenis Zakat</option>
                            <option value="maal">Zakat Harta (Maal)</option>
                            <option value="pertanian">Zakat Pertanian</option>
                            <!-- Tambahkan lebih banyak jenis zakat -->
                        </select>
                    </div>
                </div>
            </form>

            <!-- Kontainer untuk form zakat -->
            <div id="zakatContainer"></div>
        </div>
    </div>
</div>

<script>
    async function showZakatForm() {
        const jenisZakat = document.getElementById('jenisZakat').value;
        const zakatContainer = document.getElementById('zakatContainer');

        if (!jenisZakat) {
            zakatContainer.innerHTML = '';
            return;
        }

        // Load konten form dari server
        try {
            const baseUrl = '<?= base_url() ?>'; // Mengambil base URL dari PHP
            const response = await fetch(`${baseUrl}/admin/kalkulatorzakat/templatezakat/${jenisZakat}`);

            const html = await response.text();
            zakatContainer.innerHTML = html;
        } catch (error) {
            zakatContainer.innerHTML = '<p class="text-danger">Terjadi kesalahan saat memuat form zakat.</p>';
        }
    }
</script>

<script src="<?= $js_file ?>"></script>