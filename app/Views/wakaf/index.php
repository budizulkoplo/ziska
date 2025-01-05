<main id="main">
  <!-- ======= Breadcrumbs Section ======= -->
  <section class="breadcrumbs">
    <div class="container">
      <div class="d-flex justify-content-between align-items-center">
        <h2><?= $title ?></h2>
        <ol>
          <li><a href="<?= base_url() ?>">Home</a></li>
          <li><?= $title ?></li>
        </ol>
      </div>
    </div>
  </section>
  <!-- End Breadcrumbs Section -->

  <!-- ======= Wakaf Section ======= -->
  <section id="wakaf" class="wakaf">
    <div class="container">
        <table class="table table-bordered" id="example1">
          <thead>
            <tr>
              <th width="5%">No</th>
              <th width="20%">No Sertifikat</th>
              <th width="25%">Alamat</th>
              <th width="15%">Pewakaf</th>
              <th width="10%">Status</th>
              <th width="15%">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php $no = 1; foreach ($wakaf as $row): ?>
            <tr>
              <td class="text-center"><?= $no ?></td>
              <td><?= $row['nosertifikat'] ?></td>
              <td><?= $row['alamat'] ?></td>
              <td><?= $row['pewakaf'] ?></td>
              <td><?= $row['status'] ?></td>
              <td class="text-center">
                <a href="<?= base_url('wakaf/detail/' . $row['idwakaf']) ?>" class="btn btn-info btn-sm btn-block">
                  <i class="fa fa-eye"></i> Detail
                </a>
              </td>
            </tr>
            <?php $no++; endforeach; ?>
          </tbody>
        </table>


    </div>
  </section>
  <!-- End Wakaf Section -->
</main>
