<?= form_open_multipart('admin/programlazis/update/' . $program['idprogram']) ?>

<div class="form-group row">
    <label class="col-3">Judul Program</label>
    <div class="col-9">
        <input type="text" name="judulprogram" class="form-control" placeholder="Judul Program" value="<?= $program['judulprogram'] ?>" required>
    </div>
</div>

<div class="form-group row">
    <label class="col-3">Tanggal Mulai</label>
    <div class="col-9">
        <input type="date" name="tglmulai" class="form-control" value="<?= $program['tglmulai'] ?>" required>
    </div>
</div>

<div class="form-group row">
    <label class="col-3">Tanggal Selesai</label>
    <div class="col-9">
        <input type="date" name="tglselesai" class="form-control" value="<?= $program['tglselesai'] ?>" required>
    </div>
</div>

<div class="form-group row">
    <label class="col-3">Deskripsi</label>
    <div class="col-9">
        <textarea name="deskripsiprogram" class="form-control konten" required><?= $program['deskripsiprogram'] ?></textarea>
    </div>
</div>

<div class="form-group row">
    <label class="col-3">Foto</label>
    <div class="col-9">
        <?php if ($program['fotoprogram']): ?>
            <div>
                <img src="<?= base_url('assets/upload/programlazis/' . $program['fotoprogram']) ?>" class="img img-thumbnail" width="100">
            </div>
        <?php endif; ?>
        <input type="file" name="fotoprogram" class="form-control mt-2">
    </div>
</div>

<div class="form-group row">
    <label class="col-3">Target Donasi</label>
    <div class="col-9">
        <input type="number" name="targetdonasi" class="form-control" placeholder="Target Donasi" value="<?= $program['targetdonasi'] ?>" required>
    </div>
</div>

<div class="form-group row">
    <label class="col-3">Terkumpul</label>
    <div class="col-9">
        <input type="number" name="terkumpul" class="form-control" placeholder="Jumlah Terkumpul" value="<?= $program['terkumpul'] ?>" required>
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
            <tr id="muzaki_<?= $m['id'] ?>">
                <td><?= esc($m['nama']) ?></td>
                <td><?= esc($m['alamat']) ?></td>
                <td><?= esc($m['nohp']) ?></td>
                <td>
                    <button type="button" class="btn btn-warning btn-sm" onclick="addMuzaki('<?= $m['id'] ?>', 'muzaki', '<?= esc($m['nama']) ?>')">Tambah</button>
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
            <tr id="mustahik_<?= $m['idmustahik'] ?>">
                <td><?= esc($m['nama']) ?></td>
                <td><?= esc($m['alamat']) ?></td>
                <td><?= esc($m['nohp']) ?></td>
                <td>
                    <button type="button" class="btn btn-warning btn-sm" onclick="addMustahik('<?= $m['idmustahik'] ?>', 'mustahik', '<?= esc($m['nama']) ?>')">Tambah</button>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

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

<!-- Input tersembunyi untuk menyimpan ID Muzaki dan Mustahik -->
<input type="hidden" name="muzaki_ids" id="muzaki_ids" value="<?= implode(',', array_column($selectedMuzaki, 'id')) ?>">
<input type="hidden" name="mustahik_ids" id="mustahik_ids" value="<?= implode(',', array_column($selectedMustahik, 'idmustahik')) ?>">

<div class="form-group row">
    <div class="col-12">
        <button type="submit" class="btn btn-success">Simpan Perubahan</button>
    </div>
</div>

<?= form_close() ?>

<script>
    // Data awal untuk Muzaki dan Mustahik
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

    // Fungsi untuk merender tabel Muzaki dan Mustahik
    function renderMuzakiMustahikTable() {
        const tableBody = document.getElementById('muzakiMustahikTableBody');
        const muzakiInput = document.getElementById('muzaki_ids');
        const mustahikInput = document.getElementById('mustahik_ids');

        // Kosongkan tabel
        tableBody.innerHTML = '';

        muzakiMustahikList.forEach((item, index) => {
            const row = document.createElement('tr');
            row.id = `${item.type}_${item.id}`;

            row.innerHTML = `
                <td>${item.nama}</td>
                <td>${item.type === 'muzaki' ? 'Muzaki' : 'Mustahik'}</td>
                <td>
                    <button type="button" class="btn btn-danger btn-sm" onclick="removeMuzakiMustahik(${index})">Hapus</button>
                </td>
            `;

            tableBody.appendChild(row);
        });

        // Update input tersembunyi
        const muzakiIds = muzakiMustahikList.filter(item => item.type === 'muzaki').map(item => item.id);
        const mustahikIds = muzakiMustahikList.filter(item => item.type === 'mustahik').map(item => item.id);

        muzakiInput.value = muzakiIds.join(',');
        mustahikInput.value = mustahikIds.join(',');
    }

    // Tambahkan Muzaki ke daftar
    function addMuzaki(id, type, nama) {
        // Cek apakah sudah ada di daftar
        if (muzakiMustahikList.some(item => item.id === id && item.type === type)) {
            alert('Data sudah ada dalam daftar!');
            return;
        }

        muzakiMustahikList.push({ id, type, nama });
        renderMuzakiMustahikTable();
    }

    // Tambahkan Mustahik ke daftar
    function addMustahik(id, type, nama) {
        addMuzaki(id, type, nama); // Fungsi serupa
    }

    // Hapus Muzaki/Mustahik dari daftar
    function removeMuzakiMustahik(index) {
        muzakiMustahikList.splice(index, 1);
        renderMuzakiMustahikTable();
    }

    // Render tabel saat dokumen siap
    document.addEventListener("DOMContentLoaded", function () {
        renderMuzakiMustahikTable();
    });
</script>


