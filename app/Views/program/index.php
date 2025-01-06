<?php
function custom_word_limiter($text, $limit = 20) {
    $words = explode(' ', $text);
    if (count($words) > $limit) {
        $words = array_slice($words, 0, $limit);
        $text = implode(' ', $words) . '...';
    }
    return $text;
}
?>

<main id="main">
  <!-- ======= Breadcrumbs Section ======= -->
  <section class="breadcrumbs">
    <div class="container">
      <div class="d-flex justify-content-between align-items-center">
        <h2><?php echo $title; ?></h2>
        <ol>
          <li><a href="<?php echo base_url(); ?>">Home</a></li>
          <li><?php echo $title; ?></li>
        </ol>
      </div>
    </div>
  </section><!-- End Breadcrumbs Section -->

  <!-- ======= Program List Section ======= -->
  <section id="program-list" class="program-list">
    <div class="container">
      <div class="row">
        <?php foreach ($programs as $program): ?>
          <div class="col-lg-4">
            <div class="card mb-4">
              <div class="card-img-container" style="display: flex; justify-content: center; align-items: center;">
                <img src="<?php echo base_url('assets/upload/programlazis/' . $program['fotoprogram']); ?>" 
                     class="card-img-top" 
                     alt="<?php echo $program['judulprogram']; ?>"
                     style="width: 300px; height: 200px; object-fit: cover;">
              </div>
              <div class="card-body">
                <h5 class="card-title"><?php echo $program['judulprogram']; ?></h5>
                <p class="card-text"><?php echo custom_word_limiter($program['deskripsiprogram'], 20); ?></p>
                <a href="<?php echo base_url('program/detail/' . $program['idprogram']); ?>" class="btn btn-success">Detail Program</a>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section><!-- End Program List Section -->
</main><!-- End #main -->
