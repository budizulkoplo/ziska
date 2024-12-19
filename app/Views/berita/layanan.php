<style>
  #portofolio {
    position: relative;
    width: 100%;
    height: 400px;
    overflow: hidden;
  }

  #portofolio img {
    position: absolute;
    top: 0;
    left: 0;

    object-fit: cover;
    opacity: 0;
    transition: opacity 1s;
  }

  #portofolio img.active {
    opacity: 1;
  }
</style>

<main id="main">
  <!-- ======= Breadcrumbs Section ======= -->
  <section class="breadcrumbs">
    <div class="container">
      <div class="d-flex justify-content-between align-items-center">
        <h2>PORTOFOLIO</h2>
        <ol>
          <li><a href="<?php echo base_url() ?>">Home</a></li>
          <li><?php echo $title ?></li>
        </ol>
      </div>
    </div>
  </section><!-- End Breadcrumbs Section -->

  <!-- ======= Contact Section ======= -->
  <section id="contact" class="contact">
    <div class="container">
      <div class="row mt-2">


        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h3><?php echo $title ?></h3>
            </div>
            <div class="card-body">
              <?php if ($berita['keywords'] <> "soon") { ?>
                <div id="portofolio">
                  <?php foreach ($slider as $slider) {  ?>
                    <img class="portofolio" src="<?php echo base_url('assets/upload/image/' . $slider['gambar']) ?>" height="400px" width="100%" alt="Image 1">
                  <?php } ?>

                </div>
                <a class="portofolio-prev" id="prev-button" role="button" data-bs-slide="prev">
                  <span class="portofolio-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
                </a>

                <a class="portofolio-next" id="next-button" role="button" data-bs-slide="next">
                  <span class="portofolio-next-icon bi bi-chevron-right" aria-hidden="true"></span>
                </a>
                <hr>
              <?php } ?>
              <?php echo $berita['isi'] ?>
            </div>
            <div class="card-footer">
              Updated by: <?php echo $berita['nama'] ?> | Tanggal: <?php echo tanggal_bulan_menit($berita['tanggal']) ?>
            </div>
          </div>

        </div>

      </div>
    </div>
  </section><!-- End Contact Section -->
</main><!-- End #main -->

<script>
  var slideIndex = 0;
  var slideLimit = 2;
  showSlides();

  function showSlides() {
    var i;
    var slides = document.getElementsByClassName("portofolio");
    for (i = 0; i < slides.length; i++) {
      slides[i].className = slides[i].className.replace(" active", "");
    }
    slideIndex++;
    if (slideIndex > slides.length) {
      slideIndex = 1
    }
    slides[slideIndex - 1].className += " active";
    setTimeout(showSlides, 5000); // Change image every 5 seconds
  }

  document.getElementById("next-button").onclick = function() {
    clearTimeout();
    slideIndex++;
    var slides = document.getElementsByClassName("portofolio");
    if (slideIndex > slides.length) {
      slideIndex = 1
    }
    for (i = 0; i < slides.length; i++) {
      slides[i].className = slides[i].className.replace(" active", "");
    }
    slides[slideIndex - 1].className += " active";
    setTimeout(showSlides, 5000);

    document.getElementById("prev-button").onclick = function() {
      clearTimeout();
      slideIndex--;
      var slides = document.getElementsByClassName("portofolio");
      if (slideIndex < 1) {
        slideIndex = slides.length;
      }
      for (i = 0; i < slides.length; i++) {
        slides[i].className = slides[i].className.replace(" active", "");
      }
      slides[slideIndex - 1].className += " active";
      setTimeout(showSlides, 5000);
    }

  };
</script>