<?= form_open_multipart('admin/programlazis/update/' . $program['idprogram']) ?>

<div class="form-group row">
    <label class="col-3">Judul Program</label>
    <div class="col-9">
        <input type="text" name="judulprogram" class="form-control" placeholder="Judul Program" value="<?= esc($program['judulprogram']) ?>" required>
    </div>
</div>

<div class="form-group row">
				<label class="col-3">Kode Transaksi</label>
				<div class="col-9">
					<select name="kodetransaksi" class="form-control" required>
						<option value="" disabled>Pilih Kode Transaksi</option>
						<?php foreach ($kodetransaksi as $t): ?>
							<option value="<?= $t['kodetransaksi'] ?>" <?= $program['kodetransaksi'] == $t['kodetransaksi'] ? 'selected' : '' ?>>
								<?= $t['kodetransaksi'] ?>
							</option>
						<?php endforeach; ?>
					</select>
				</div>
			</div>

<div class="form-group row">
    <label class="col-3">Tanggal Mulai</label>
    <div class="col-9">
        <input type="date" name="tglmulai" class="form-control" value="<?= esc($program['tglmulai']) ?>" required>
    </div>
</div>

<div class="form-group row">
    <label class="col-3">Tanggal Selesai</label>
    <div class="col-9">
        <input type="date" name="tglselesai" class="form-control" value="<?= esc($program['tglselesai']) ?>" required>
    </div>
</div>

<div class="form-group row">
    <label class="col-3">Deskripsi</label>
    <div class="col-9">
        <textarea name="deskripsiprogram" class="form-control konten" required><?= esc($program['deskripsiprogram']) ?></textarea>
    </div>
</div>

<div class="form-group row">
    <label class="col-3">Foto</label>
    <div class="col-9">
        <?php if ($program['fotoprogram']): ?>
            <div>
                <img src="<?= base_url('assets/upload/programlazis/' . esc($program['fotoprogram'])) ?>" class="img img-thumbnail" width="100">
            </div>
        <?php endif; ?>
        <input type="file" name="fotoprogram" class="form-control mt-2" accept="image/*">
    </div>
</div>

<div class="form-group row">
    <label class="col-3">Target Donasi</label>
    <div class="col-9">
        <input type="number" name="targetdonasi" class="form-control" placeholder="Target Donasi" value="<?= esc($program['targetdonasi']) ?>" min="0" required>
    </div>
</div>

<div class="form-group row">
    <label class="col-3">Terkumpul</label>
    <div class="col-9">
        <input type="number" name="terkumpul" class="form-control" placeholder="Jumlah Terkumpul" value="<?= esc($program['terkumpul']) ?>" min="0" required>
    </div>
</div>

<hr>

<h5>List Muzaki</h5>
<table class="table table-bordered" id="muzakiTable">
    <thead>
        <tr>
            <th>Nama</th>
            <th>Alamat</th>
            <th>No HP</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($muzaki as $m): ?>
            <tr id="muzaki_<?= esc($m['id']) ?>">
                <td><?= esc($m['nama']) ?></td>
                <td><?= esc($m['alamat']) ?></td>
                <td><?= esc($m['nohp']) ?></td>
                <td>
                    <button type="button" class="btn btn-warning btn-sm" onclick="addEntity('<?= esc($m['id']) ?>', 'muzaki', '<?= esc($m['nama']) ?>')">Tambah</button>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<h5>List Mustahik</h5>
<table class="table table-bordered" id="mustahikTable">
    <thead>
        <tr>
            <th>Nama</th>
            <th>Alamat</th>
            <th>No HP</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($mustahik as $m): ?>
            <tr id="mustahik_<?= esc($m['idmustahik']) ?>">
                <td><?= esc($m['nama']) ?></td>
                <td><?= esc($m['alamat']) ?></td>
                <td><?= esc($m['nohp']) ?></td>
                <td>
                    <button type="button" class="btn btn-warning btn-sm" onclick="addEntity('<?= esc($m['idmustahik']) ?>', 'mustahik', '<?= esc($m['nama']) ?>')">Tambah</button>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<h5>Daftar Muzaki dan Mustahik</h5>
<table class="table table-bordered" id="muzakiMustahikTable">
    <thead>
        <tr>
            <th>Nama</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody id="muzakiMustahikTableBody">
        <!-- List Muzaki/Mustahik akan dimasukkan di sini -->
    </tbody>
</table>

<input type="hidden" name="muzaki_ids" id="muzaki_ids" value="<?= implode(',', array_column($selectedMuzaki, 'id')) ?>">
<input type="hidden" name="mustahik_ids" id="mustahik_ids" value="<?= implode(',', array_column($selectedMustahik, 'idmustahik')) ?>">

<div class="form-group row">
    <div class="col-12">
        <button type="submit" class="btn btn-success">Simpan Perubahan</button>
    </div>
</div>

<?= form_close() ?>

<script>
    var muzakiMustahikList = <?= json_encode(
        array_merge(
            array_map(function ($m) {
                return ['id' => $m['id'], 'type' => 'muzaki', 'nama' => $m['nama']];
            }, $selectedMuzaki),
            array_map(function ($m) {
                return ['id' => $m['idmustahik'], 'type' => 'mustahik', 'nama' => $m['nama']];
            }, $selectedMustahik)
        ),
        JSON_HEX_TAG | JSON_HEX_QUOT | JSON_HEX_APOS | JSON_HEX_AMP
    ) ?>;

    function renderMuzakiMustahikTable() {
        const tableBody = document.getElementById('muzakiMustahikTableBody');
        const muzakiInput = document.getElementById('muzaki_ids');
        const mustahikInput = document.getElementById('mustahik_ids');
        tableBody.innerHTML = '';
        muzakiMustahikList.forEach((item, index) => {
            const row = document.createElement('tr');
            row.id = `${item.type}_${item.id}`;
            row.innerHTML = `
                <td>${item.nama}</td>
                <td>${item.type === 'muzaki' ? 'Muzaki' : 'Mustahik'}</td>
                <td>
                    <button type="button" class="btn btn-danger btn-sm" onclick="removeEntity(${index})">Hapus</button>
                </td>
            `;
            tableBody.appendChild(row);
        });
        muzakiInput.value = muzakiMustahikList.filter(item => item.type === 'muzaki').map(item => item.id).join(',');
        mustahikInput.value = muzakiMustahikList.filter(item => item.type === 'mustahik').map(item => item.id).join(',');
    }

    function addEntity(id, type, nama) {
        if (muzakiMustahikList.some(item => item.id === id && item.type === type)) {
            alert('Data sudah ada dalam daftar!');
            return;
        }
        muzakiMustahikList.push({ id, type, nama });
        document.getElementById(`${type}_${id}`).style.display = 'none';
        renderMuzakiMustahikTable();
    }

    function removeEntity(index) {
        const item = muzakiMustahikList[index];
        document.getElementById(`${item.type}_${item.id}`).style.display = '';
        muzakiMustahikList.splice(index, 1);
        renderMuzakiMustahikTable();
    }

    document.addEventListener("DOMContentLoaded", renderMuzakiMustahikTable);
</script>
