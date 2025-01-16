<div class="container mt-4">
    <h3 class="text-center">Zakat Pertanian</h3>
    <form id="zakatForm">
        <div id="zakatPertanianForm">
                    <!-- Form Zakat Pertanian -->
                    <h4>Zakat Pertanian</h4>
                    <p>Zakat pertanian adalah salah satu jenis zakat yang dikeluarkan dari hasil panen atau produksi pertanian. Zakat pertanian harus dikeluarkan oleh setiap individu atau kelompok yang memiliki lahan pertanian atau hasil panen yang mencukupi nisab (batas minimal untuk wajib zakat)

Nisab untuk zakat pertanian adalah sebanyak 5 wasaq atau sekitar 653 kg beras. Jika hasil panen mencapai nisab tersebut. Kadar zakat pertanian adalah sebesar 5% atau 1/20 dari hasil panen atau produksi pertanian setelah dipotong biaya produksi. Kadar ini sesuai dengan ketentuan yang terdapat dalam hadis dari Nabi Muhammad SAW yang menyebutkan bahwa zakat pertanian sebesar 1/10 (10%) untuk tanah yang diasuransikan atau diirigasi dan sebesar 1/20 (5%) untuk tanah yang tidak diasuransikan atau diirigasi secara teratur.</p>
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
                            <input type="number" name="jumlahZakat" class="form-control" id="jumlahZakat" value="0" readonly>
                            <input type="hidden" name="jenis" class="form-control" id="jenis" value="Pertanian">
                        </div>
                    </div>
                </div>
                </form>
    
    <div class="form-group row">
        <div class="col-sm-6">
            <button type="button" class="btn btn-success w-100 mt-4" onclick="hitungZakatPertanian()">Hitung Zakat</button>
        </div>
        <div class="col-sm-6">
            <button type="button" class="btn btn-outline-primary w-100 mt-4" id="bayarZakatButton" onclick="bayarZakat(event)" disabled><i class="nav-icon fas fa-calculator"></i> Bayar Zakat</button>
        </div>
    </div>
</div>