<main id="main">
  <!-- ======= Breadcrumbs Section ======= -->
  <section class="breadcrumbs">
    <div class="container">
      <div class="d-flex justify-content-between align-items-center">
        <h2><?php echo $title; ?></h2>
        <ol>
          <li><a href="<?php echo base_url(); ?>">Home</a></li>
          <li><?php echo $title; ?></li>
        </ol>
      </div>
    </div>
  </section><!-- End Breadcrumbs Section -->
  <section id="program-list" class="program-list">
    <div class="container">
    <div class="row">
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
                        <option value="temuan">Zakat Temuan</option>
                        <option value="hadiah">Zakat Hadiah</option>
                    </select>
                    </div>
                </div>
            </form>

            <div id="zakatContainer"></div>
        </div>
    </div>
    </div>
</div>
</section><!-- End Program List Section -->
</main><!-- End #main -->

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

    function bayarZakat(event) {
    event.preventDefault(); 
    const baseUrl = '<?= base_url() ?>';

    const form = document.getElementById('zakatForm');
    const jumlah = form.querySelector('input[name="jumlahZakat"]').value;
    const jenis = form.querySelector('input[name="jenis"]').value;

    const redirectUrl = `${baseUrl}/admin/transaksi/zakat?jumlah=${jumlah}&jenis=${jenis}`;
    window.location.href = redirectUrl;
    }

</script>




