<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h3 class="text-center mb-4">Donasi Program</h3>
            <div class="card">
                <div class="card-body">
                    <!-- Informasi Program -->
                    <h3><?= $program['judulprogram'] ?></h3><br>
                    <p><strong>Target:</strong> Rp<?= number_format($program['targetdonasi'], 0, ',', '.') ?></p>
                    <p><strong>Periode:</strong> 
                        <?= date('d M Y', strtotime($program['tglmulai'])) ?> - <?= date('d M Y', strtotime($program['tglselesai'])) ?>
                    </p>
                    <p><strong>Terkumpul:</strong> Rp<?= number_format($program['terkumpul'], 0, ',', '.') ?></p>
                    <p><strong>Deskripsi Program:</strong></p>
                    <p class="text-muted"><?= nl2br($program['deskripsiprogram']) ?></p>

                    <hr>

                    <!-- Form Donasi -->
                    <form action="<?= base_url('admin/programlazis/storeDonation') ?>" method="post">
                        <?= csrf_field() ?>
                        <input type="hidden" name="idprogram" value="<?= $program['idprogram'] ?>">
                        <input type="hidden" name="namaprogram" value="<?= $program['judulprogram'] ?>">

                        <div class="mb-3">
                            <label for="jumlah" class="form-label">Jumlah Donasi</label>
                            <input type="number" class="form-control" id="jumlah" name="jumlah" required>
                        </div>

                        <div class="mb-3">
                            <label for="keterangan" class="form-label">Keterangan</label>
                            <textarea class="form-control" id="keterangan" name="keterangan" rows="3" placeholder="Opsional"></textarea>
                        </div>

                        <button type="submit" class="btn btn-success w-100">Donasi Sekarang</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
