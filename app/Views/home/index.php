<!-- ======= Hero Section ======= -->
<section id="hero">
  <div id="heroCarousel" data-bs-interval="5000" class="carousel slide carousel-fade" data-bs-ride="carousel">

    <ol class="carousel-indicators" id="hero-carousel-indicators"></ol>

    <div class="carousel-inner" role="listbox">
      <?php $noslide = 1; ?>
      <?php foreach ($slider as $program) : ?>
        <!-- Slide -->
        <div class="carousel-item<?php if ($noslide == 1) {
                                    echo ' active';
                                  } ?>" style="background-image: url(<?php echo base_url('assets/upload/programlazis/' . $program['fotoprogram']) ?>)">
          <br><br><br><br><br><br>
          <span style="background-color: rgba(255, 255, 255, 0.5);">
            <div class="container" style="max-width: 90%; text-align: left; padding-left: 2%; padding-right: 2%; text-shadow: 8px 8px 8px rgba(0,0,0,0.3);">

              <h2><?php echo $program['judulprogram']; ?></h2>
              
              <p>Target: Rp<?php echo number_format($program['targetdonasi'], 0, ',', '.'); ?><br>
              Terkumpul: Rp<?php echo number_format($program['terkumpul'], 0, ',', '.'); ?></p>
              
              <a href="<?php echo base_url('program/detail/' . $program['idprogram']); ?>" class="btn-get-started scrollto">Selengkapnya</a>

            </div>
          </span>
        </div>
      <?php $noslide++; ?>
      <?php endforeach; ?>
    </div>

    <a class="carousel-control-prev" href="#heroCarousel" role="button" data-bs-slide="prev">
      <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
    </a>

    <a class="carousel-control-next" href="#heroCarousel" role="button" data-bs-slide="next">
      <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
    </a>

  </div>
</section><!-- End Hero -->


<main id="main">



  <!-- ======= Services Section ======= -->
  <section id="services" class="services services">
    <div class="container" data-aos="fade-up">

      <div class="section-title">
        <h2>Masih Bingung Untuk Berzakat?</h2>
        <p> <?php echo tagline() ?> <a href="<?php echo base_url() ?>/berita/profil/about-us">Read More..</a></p>
      </div>



    </div>
  </section><!-- End Services Section -->

</main><!-- End #main -->
