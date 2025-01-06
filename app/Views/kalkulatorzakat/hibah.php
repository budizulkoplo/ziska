<div class="container mt-3">
    <h4>Zakat Hibah</h4>
    <form id="formHibah">
        <div class="form-group">
            <label for="totalHibah">Total Nilai Hibah (Rp)</label>
            <input type="number" id="totalHibah" name="totalHibah" class="form-control" placeholder="Masukkan nilai hibah" required>
        </div>
        <div class="form-group">
            <label for="nisabHibah">Nisab Zakat (Rp)</label>
            <input type="number" id="nisabHibah" name="nisabHibah" class="form-control" value="8500000" readonly>
        </div>
        <button type="button" class="btn btn-success" onclick="calculateZakatHibah()">Hitung Zakat</button>
    </form>
    <div id="resultHibah" class="mt-3"></div>
</div>
