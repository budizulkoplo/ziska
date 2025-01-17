<form action="<?= base_url('admin/programlazis/store') ?>" method="post" enctype="multipart/form-data">

    <div class="form-group row">
        <label class="col-3">Judul Program</label>
        <div class="col-9">
            <input type="text" name="judulprogram" class="form-control" placeholder="Judul Program" required>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-3">Tanggal Mulai</label>
        <div class="col-9">
            <input type="date" name="tglmulai" class="form-control" required>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-3">Tanggal Selesai</label>
        <div class="col-9">
            <input type="date" name="tglselesai" class="form-control" required>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-3">Deskripsi</label>
        <div class="col-9">
            <textarea name="deskripsiprogram" class="form-control konten"></textarea>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-3">Foto</label>
        <div class="col-9">
            <input type="file" name="fotoprogram" class="form-control">
        </div>
    </div>

    <div class="form-group row">
        <label class="col-3">Target Donasi</label>
        <div class="col-9">
            <input type="number" name="targetdonasi" class="form-control" placeholder="Target Donasi" required>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-3">Terkumpul</label>
        <div class="col-9">
            <input type="number" name="terkumpul" class="form-control" placeholder="Jumlah Terkumpul" required>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-3">Ranting</label>
        <div class="col-9">
            <select name="idranting" class="form-control" required>
                <option value="">Pilih Ranting</option>
                <?php foreach ($ranting as $r): ?>
                    <option value="<?= $r['idranting'] ?>"><?= esc($r['namaranting']) ?></option>
                <?php endforeach; ?>
            </select>
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
    <input type="hidden" name="muzaki_ids" id="muzaki_ids">
    <input type="hidden" name="mustahik_ids" id="mustahik_ids">

    <div class="form-group row">
        <div class="col-12">
            <button type="submit" class="btn btn-success">Simpan Program</button>
        </div>
    </div>

</form>

<script>
  var muzakiMustahikList = [];

  // Fungsi untuk menambah muzaki
  function addMuzaki(id, type, nama) {
      // Cek apakah item sudah ada di daftar
      if (!muzakiMustahikList.some(item => item.id === id && item.type === type)) {
          muzakiMustahikList.push({ id: id, type: type, nama: nama });
          renderMuzakiMustahikTable();
          // Hapus baris muzaki dari list untuk menghindari duplikasi
          $(`#muzaki_${id}`).hide();
      } else {
          alert('Muzaki sudah ditambahkan.');
      }
  }

  // Fungsi untuk menambah mustahik
  function addMustahik(id, type, nama) {
      // Cek apakah item sudah ada di daftar
      if (!muzakiMustahikList.some(item => item.id === id && item.type === type)) {
          muzakiMustahikList.push({ id: id, type: type, nama: nama });
          renderMuzakiMustahikTable();
          // Hapus baris mustahik dari list untuk menghindari duplikasi
          $(`#mustahik_${id}`).hide();
      } else {
          alert('Mustahik sudah ditambahkan.');
      }
  }

  // Fungsi untuk merender tabel muzaki dan mustahik yang sudah ditambahkan
  function renderMuzakiMustahikTable() {
      var tableBody = $('#muzakiMustahikTableBody');
      tableBody.empty();

      var muzakiIds = [];
      var mustahikIds = [];

      muzakiMustahikList.forEach((item, index) => {
          tableBody.append(`
              <tr>
                  <td>${item.nama}</td>
                  <td>${item.type === 'muzaki' ? 'Muzaki' : 'Mustahik'}</td>
                  <td>
                      <button type="button" class="btn btn-danger btn-sm" onclick="removeItem(${index})">Hapus</button>
                  </td>
              </tr>
          `);

          if (item.type === 'muzaki') {
              muzakiIds.push(item.id);
          } else {
              mustahikIds.push(item.id);
          }
      });

      // Update input tersembunyi
      $('#muzaki_ids').val(muzakiIds.join(','));
      $('#mustahik_ids').val(mustahikIds.join(','));
  }

  // Fungsi untuk menghapus item dari daftar muzakiMustahikList
  function removeItem(index) {
      var item = muzakiMustahikList.splice(index, 1)[0];
      renderMuzakiMustahikTable();

      // Menampilkan kembali item yang dihapus ke tabel muzaki atau mustahik
      if (item.type === 'muzaki') {
          $(`#muzaki_${item.id}`).show();
      } else {
          $(`#mustahik_${item.id}`).show();
      }
  }
</script>
