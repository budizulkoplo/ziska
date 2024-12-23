<div class="container mt-4">
    <h3 class="text-center">Zakat Temuan (Rikaz)</h3>
    <form id="temuanForm">
        <div id="zakatTemuanForm">
            <!-- Form Zakat Temuan -->
            <h4>Form Zakat Temuan</h4>

            <div class="form-group row">
                <label class="col-sm-6 col-form-label">Nilai Barang Temuan (dalam Rupiah)</label>
                <div class="col-sm-6 input-group">
                    <span class="input-group-text">Rp</span>
                    <input type="number" class="form-control" id="nilaiBarangTemuan" value="0">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-6 col-form-label">Jumlah Zakat Temuan (20%)</label>
                <div class="col-sm-6 input-group">
                    <span class="input-group-text">Rp</span>
                    <input type="number" class="form-control" id="zakatTemuan" value="0" readonly>
                </div>
            </div>
        </div>
    </form>
    <button type="button" class="btn btn-success w-100 mt-4" onclick="hitungZakatTemuan()">Hitung Zakat</button>
</div>