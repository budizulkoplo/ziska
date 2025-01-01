<div id="programCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000">
    <div class="carousel-inner">
        <?php $isActive = true; ?>
        <?php foreach ($program as $item): ?>
            <div class="carousel-item <?= $isActive ? 'active' : '' ?>">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-10">
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
                                    <a href="<?= base_url('admin/programlazis/donate/' . $item['idprogram']) ?>" class="btn btn-success w-100 mt-4">
                                        <i class="fa fa-eye"></i> Lihat Program
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php $isActive = false; ?>
        <?php endforeach; ?>
    </div>

    <!-- Kontrol Next dan Previous -->
    <button class="carousel-control-prev" type="button" data-bs-target="#programCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#programCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
