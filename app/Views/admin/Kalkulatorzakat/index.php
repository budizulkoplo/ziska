<div class="container mt-4">
    <h3 class="text-center">Kalkulator Zakat</h3>

    <div class="card">
        <div class="card-header bg-lazis text-white">
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
                        </select>
                    </div>
                </div>
            </form>

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
        try {
            const baseUrl = '<?= base_url() ?>'; 
            const response = await fetch(`${baseUrl}/admin/kalkulatorzakat/templatezakat/${jenisZakat}`);
            const html = await response.text();
            zakatContainer.innerHTML = html;

            const scriptUrl = `${baseUrl}/public/js/zakat/${jenisZakat}.js`; 

            const script = document.createElement('script');
            script.src = scriptUrl;
            script.type = 'text/javascript';
            document.body.appendChild(script);

            script.onerror = function() {
                zakatContainer.innerHTML = '<p class="text-danger">Terjadi kesalahan saat memuat JavaScript.</p>';
            };

        } catch (error) {
            zakatContainer.innerHTML = '<p class="text-danger">Terjadi kesalahan saat memuat form zakat.</p>';
        }
    }
</script>


