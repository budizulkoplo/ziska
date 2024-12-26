
<form action="<?= base_url('admin/programlazis/store') ?>" method="post" enctype="multipart/form-data">

<div class="form-group row">
    <label class="col-3">Judul Program</label>
    <div class="col-9">
        <input type="text" name="judul" class="form-control" placeholder="Judul Program" required>
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
        <textarea name="deskripsi" class="form-control konten"></textarea>
    </div>
</div>

<div class="form-group row">
    <label class="col-3">Foto</label>
    <div class="col-9">
        <input type="file" name="foto" class="form-control">
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
    <div class="col-9 offset-3">
        <button type="submit" class="btn btn-success">Simpan Program</button>
    </div>
</div>

<?= form_close() ?>
