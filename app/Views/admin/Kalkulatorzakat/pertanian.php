<div class="container mt-4">
    <h3 class="text-center">Zakat Pertanian</h3>
    <form id="pertanianForm">
        <div id="zakatPertanianForm">
                    <!-- Form Zakat Pertanian -->
                    <h4>Zakat Pertanian</h4>
                    <div class="form-group row">
                        <label class="col-sm-6 col-form-label">Jenis Irigasi</label>
                        <div class="col-sm-6">
                            <select class="form-control" id="jenisIrigasi">
                                <option value="5">Irigasi Berbayar (5%)</option>
                                <option value="10">Irigasi Tadah Hujan (10%)</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-6 col-form-label">Jumlah Hasil Panen (dalam Rupiah)</label>
                        <div class="col-sm-6 input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" class="form-control" id="hasilPanen" value="0">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-6 col-form-label">Biaya Produksi (dalam Rupiah)</label>
                        <div class="col-sm-6 input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" class="form-control" id="biayaProduksi" value="0">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-6 col-form-label">Jumlah Zakat Pertanian</label>
                        <div class="col-sm-6 input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" class="form-control" id="zakatPertanian" value="0" readonly>
                        </div>
                    </div>
                </div>
                </form>
    
    <div class="form-group row">
        <div class="col-sm-6">
            <button type="button" class="btn btn-success w-100 mt-4" onclick="hitungZakatPertanian()">Hitung Zakat</button>
        </div>
        <div class="col-sm-6">
            <button type="button" class="btn btn-outline-primary w-100 mt-4" onclick="bayarZakatMaal()"><i class="nav-icon fas fa-calculator"></i> Bayar Zakat</button>
        </div>
    </div>
</div>