<div class="container mt-4">
    <h3 class="text-center">Zakat Hadiah</h3>
    <form id="hadiahForm">
        <div id="zakatHadiahForm">
            <h4>Form Zakat Hadiah</h4>

            <!-- Jenis Hadiah -->
            <div class="form-group row">
                <label class="col-sm-6 col-form-label">Jenis Hadiah</label>
                <div class="col-sm-6">
                    <select class="form-control" id="jenisHadiah">
                        <option value="2.5">Hadiah Terkait Gaji (2.5%)</option>
                        <option value="10">Komisi Perusahaan (10%)</option>
                        <option value="20">Hibah Tak Terduga (20%)</option>
                        <option value="2.5Hibah">Hibah Diduga (2.5%)</option>
                    </select>
                </div>
            </div>

            <!-- Jumlah Hadiah -->
            <div class="form-group row">
                <label class="col-sm-6 col-form-label">Jumlah Hadiah (dalam Rupiah)</label>
                <div class="col-sm-6 input-group">
                    <span class="input-group-text">Rp</span>
                    <input type="number" class="form-control" id="jumlahHadiah" value="0">
                </div>
            </div>

            <!-- Pajak Hadiah -->
            <div class="form-group row">
                <label class="col-sm-6 col-form-label">Pajak Hadiah (%)</label>
                <div class="col-sm-6 input-group">
                    <input type="number" class="form-control" id="pajakHadiah" value="20">
                    <span class="input-group-text">%</span>
                </div>
            </div>

            <!-- Total yang Diterima -->
            <div class="form-group row">
                <label class="col-sm-6 col-form-label">Total Diterima Setelah Pajak</label>
                <div class="col-sm-6 input-group">
                    <span class="input-group-text">Rp</span>
                    <input type="number" class="form-control" id="totalDiterima" value="0" readonly>
                </div>
            </div>

            <!-- Jumlah Zakat -->
            <div class="form-group row">
                <label class="col-sm-6 col-form-label">Jumlah Zakat</label>
                <div class="col-sm-6 input-group">
                    <span class="input-group-text">Rp</span>
                    <input type="number" name="jumlahZakat" class="form-control" id="jumlahZakat" value="0" readonly>
                    <input type="hidden" name="jenis" class="form-control" id="jenis" value="hadiah">
                </div>
            </div>
        </div>
    </form>
    
    <div class="form-group row">
        <div class="col-sm-6">
            <button type="button" class="btn btn-success w-100 mt-4" onclick="hitungZakatHadiah()">Hitung Zakat</button>
        </div>
        <div class="col-sm-6">
            <button type="button" class="btn btn-outline-primary w-100 mt-4" onclick="bayarZakat(event)"><i class="nav-icon fas fa-calculator"></i> Bayar Zakat</button>
        </div>
    </div>
</div>
