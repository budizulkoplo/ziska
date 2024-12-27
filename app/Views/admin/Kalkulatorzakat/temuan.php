<div class="container mt-4">
    <h3 class="text-center">Zakat Temuan (Rikaz)</h3>
    <form id="zakatForm">
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
                    <input type="number" name="jumlahZakat" class="form-control" id="jumlahZakat" value="0" readonly>
                    <input type="hidden" name="jenis" class="form-control" id="jenis" value="Temuan">
                </div>
            </div>
        </div>
    </form>
    
    <div class="form-group row">
        <div class="col-sm-6">
            <button type="button" class="btn btn-success w-100 mt-4" onclick="hitungZakatTemuan()">Hitung Zakat</button>
        </div>
        <div class="col-sm-6">
            <button type="button" class="btn btn-outline-primary w-100 mt-4" id="bayarZakatButton" onclick="bayarZakat(event)" disabled><i class="nav-icon fas fa-calculator"></i> Bayar Zakat</button>
        </div>
    </div>
</div>
