<div class="container">
    <div class="row">
        <?php foreach ($program as $item): ?>
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <img 
                        src="<?= base_url('assets/upload/programlazis/' . $item['fotoprogram']) ?>" 
                        class="card-img-top" 
                        alt="<?= $item['judulprogram'] ?>" 
                        onerror="this.onerror=null;this.src='<?= base_url('assets/upload/default.jpg') ?>';">
                    <div class="card-body">
                        <h5 class="card-title text-center"><?= $item['judulprogram'] ?></h5>
                        
                    </div>
                    <div class="card-footer text-center">
                        <div class="row">
                            <div class="col-md-6">
                                <a href="<?= base_url('admin/transaksi/create/' . $item['idprogram']) ?>" class="btn btn-success w-100 mt-2">
                                    <i class="fa fa-plus"></i> Input
                                </a>
                            </div>
                            <div class="col-md-6">
                            <a href="<?= base_url('admin/transaksi/tasaruf/' . $item['idprogram']) ?>" class="btn btn-primary w-100 mt-2">
                                <i class="fa fa-edit"></i> Tasaruf
                            </a>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<hr>
<h5>Pemasukan</h5>
<table class="table table-bordered datatable" id="pemasukan">
    <thead>
        <tr>
            <th width="5%">No</th>
            <th width="20%">Jenis Transaksi</th>
            <th width="20%">Tanggal Transaksi</th>
            <th width="20%">Muzaki</th>
            <th width="15%">Nominal</th>
            <th width="15%">Status</th>
            <th width="20%">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1; foreach ($transaksi as $item): ?>
        <tr>
            <td><?= $no ?></td>
            <td><?= esc($item['tipetransaksi']) ?></td>
            <td><?= esc($item['tgltransaksi']) ?></td>
            <td><?= esc($item['nama_muzaki'] ?? $item['muzaki']) ?></td> <!-- Jika nama_muzaki ada, tampilkan -->
              
            <td>Rp. <?= number_format($item['nominal'], 2) ?></td>
            <td>
                <span class="badge 
                    <?= ($item['status'] === 'sukses') ? 'bg-success' : (($item['status'] === 'verifikasi') ? 'bg-warning' : 'bg-danger') ?>">
                    <?= esc($item['status']) ?>
                </span>
            </td>
            <td>
                <a href="<?= base_url('admin/transaksi/edit/' . $item['idtransaksi']) ?>" class="btn btn-success btn-sm">
                    <i class="fa fa-edit"></i> Edit
                </a>
                <a href="<?= base_url('admin/transaksi/delete/' . $item['idtransaksi']) ?>" class="btn btn-dark btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus transaksi ini?')">
                    <i class="fa fa-trash"></i> Hapus
                </a>
            </td>
        </tr>
        <?php $no++; endforeach; ?>
    </tbody>
</table>

<hr>
<h5>Tasaruf</h5>
<table class="table table-bordered datatable" id="tasaruf">
    <thead>
        <tr>
            <th width="5%">No</th>
            <th width="20%">Jenis Transaksi</th>
            <th width="20%">Tanggal Transaksi</th>
            <th width="20%">Mustahik</th>
            <th width="15%">Nominal</th>
            <th width="15%">Status</th>
            <th width="20%">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1; foreach ($tasaruf as $item): ?>
        <tr>
            <td><?= $no ?></td>
            <td><?= esc($item['tipetransaksi']) ?></td>
            <td><?= esc($item['tgltransaksi']) ?></td>
            <td><?= esc($item['mustahik'] ?? $item['mustahik']) ?></td> <!-- Jika nama_muzaki ada, tampilkan -->
              
            <td>Rp. <?= number_format($item['nominal'], 2) ?></td>
            <td>
                <span class="badge 
                    <?= ($item['status'] === 'sukses') ? 'bg-success' : (($item['status'] === 'verifikasi') ? 'bg-warning' : 'bg-danger') ?>">
                    <?= esc($item['status']) ?>
                </span>
            </td>
            <td>
                <a href="<?= base_url('admin/transaksi/edit/' . $item['idtransaksi']) ?>" class="btn btn-success btn-sm">
                    <i class="fa fa-edit"></i> Edit
                </a>
                <a href="<?= base_url('admin/transaksi/delete/' . $item['idtransaksi']) ?>" class="btn btn-dark btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus transaksi ini?')">
                    <i class="fa fa-trash"></i> Hapus
                </a>
            </td>
        </tr>
        <?php $no++; endforeach; ?>
    </tbody>
</table>

<script>
    $(function() {
    $('.datatable').DataTable();
    });
</script>

