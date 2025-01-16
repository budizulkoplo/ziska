<div class="container mt-4">
    <h3 class="text-center">Zakat Harta (Maal)</h3>
    <form id="zakatForm">
    <div id="zakatMaalForm">
                    <!-- Form Zakat Maal -->
                    <h4>Zakat Harta (Maal)</h4>
                    <p>Maal berasal dari kata bahasa Arab artinya harta atau kekayaan (al-amwal, jamak dari kata maal) adalah “segala hal yang diinginkan manusia untuk disimpan dan dimiliki” (Lisan ul-Arab). Menurut Islam sendiri, harta merupakan sesuatu yang boleh atau dapat dimiliki dan digunakan (dimanfaatkan) sesuai kebutuhannya.</p>
                    <div class="form-group row">
                        <label class="col-sm-6 col-form-label">Harga Emas (gram)</label>
                        <div class="col-sm-6 input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" class="form-control" id="hargaEmas" value="1466658" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-6 col-form-label">Jumlah Nisab (85 x Harga Emas)</label>
                        <div class="col-sm-6 input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" class="form-control" id="jumlahNisab" value="124665930" readonly>
                        </div>
                    </div>

                    <hr>

                    <div class="form-group row">
                        <label class="col-sm-6 col-form-label">a. Uang Tunai, Tabungan, Deposito atau sejenisnya</label>
                        <div class="col-sm-6 input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" class="form-control" id="uangTunai" value="0">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-6 col-form-label">b. Saham atau surat-surat berharga lainnya</label>
                        <div class="col-sm-6 input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" class="form-control" id="saham" value="0">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-6 col-form-label">c. Real Estate (tidak termasuk rumah tinggal yang dipakai sekarang)</label>
                        <div class="col-sm-6 input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" class="form-control" id="realEstate" value="0">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-6 col-form-label">d. Emas, Perak, Permata atau sejenisnya</label>
                        <div class="col-sm-6 input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" class="form-control" id="emasPerak" value="0">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-6 col-form-label">e. Mobil (lebih dari keperluan pekerjaan anggota keluarga)</label>
                        <div class="col-sm-6 input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" class="form-control" id="mobil" value="0">
                        </div>
                    </div>

                    <hr>

                    <div class="form-group row">
                        <label class="col-sm-6 col-form-label">f. Jumlah Harta Simpanan (a + b + c + d + e)</label>
                        <div class="col-sm-6 input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" class="form-control" id="jumlahHarta" value="0" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-6 col-form-label">g. Hutang Pribadi yang jatuh tempo dalam tahun ini</label>
                        <div class="col-sm-6 input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" class="form-control" id="hutang" value="0">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-6 col-form-label">h. Harta simpanan kena zakat (f - g)</label>
                        <div class="col-sm-6 input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" class="form-control" id="hartaKenaZakat" value="0" readonly>
                        </div>
                    </div>

                    <p id="statusNisab" class="text-danger">Belum Mencapai Nisab</p>

                    <div class="form-group row">
                        <label class="col-sm-6 col-form-label">i. Jumlah Zakat atas Simpanan yang Wajib Dibayarkan Per Tahun (2.5% x h)</label>
                        <div class="col-sm-6 input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" name="jumlahZakat" class="form-control" id="jumlahZakat" value="0" readonly>
                            <input type="hidden" name="jenis" class="form-control" id="jenis" value="Maal">
                        </div>
                    </div>
                </div>
    </form>
    <div class="form-group row">
        <div class="col-sm-6">
            <button type="button" class="btn btn-success w-100 mt-4" onclick="hitungZakatMaal()">Hitung Zakat</button>
        </div>
        <div class="col-sm-6">
            <button type="button" class="btn btn-outline-primary w-100 mt-4" id="bayarZakatButton" onclick="bayarZakat(event)" disabled><i class="nav-icon fas fa-calculator"></i> Bayar Zakat</button>
        </div>
    </div>
</div>

