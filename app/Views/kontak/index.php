<style>
  .testimonial {
    border: 2px solid #ccc;
    background-color: #eee;
    border-radius: 5px;
    padding: 16px;
    margin: 16px 0;
  }

  /* Clear floats after containers */
  .testimonial::after {
    content: "";
    clear: both;
    display: table;
  }

  /* Float images inside the container to the left. Add a right margin, and style the image as a circle */
  .testimonial img {
    float: left;
    margin-right: 20px;
    border-radius: 50%;
  }

  /* Increase the font-size of a span element */
  .testimonial span {
    font-size: 12pt;
    margin-right: 15px;
  }

  .testimonial email {
    font-size: 12pt;
    color: cornflowerblue;
    margin-right: 15px;
  }

  /* Add media queries for responsiveness. This will center both the text and the image inside the container */
  @media (max-width: 500px) {
    .testimonial {
      text-align: center;
    }

    .testimonial img {
      margin: auto;
      float: none;
      display: block;
    }
  }
</style>

<main id="main">

  <!-- ======= Breadcrumbs Section ======= -->
  <section class="breadcrumbs">
    <div class="container">

      <div class="d-flex justify-content-between align-items-center">
        <h2><?php echo $title ?></h2>
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

      <div class="section-title">
        <h2><?php echo $title ?></h2>

      </div>

    </div>



    <div class="container">

      <div class="row mt-5">

        <div class="col-lg-12">

          <div class="row">
            <div class="col-md-12">
              <div class="info-box">
                <i class="bx bx-map"></i>
                <h3>Alamat Kami:</h3>
                <p><?php echo nl2br($konfigurasi['alamat']) ?></p>
              </div>
            </div>
            <div class="col-md-6">
              <div class="info-box mt-4">
                <i class="bx bx-envelope"></i>
                <h3>Email Kami:</h3>
                <p><?php echo nl2br($konfigurasi['email']) ?></p>
              </div>
            </div>
            <div class="col-md-6">
              <div class="info-box mt-4">
                <i class="bx bx-phone-call"></i>
                <h3>Telepon Kami:</h3>
                <p><?php echo nl2br($konfigurasi['telepon']) ?></p>
              </div>
            </div>
          </div>

        </div>

      </div>

    </div>
    </div>

  </section><!-- End Contact Section -->

</main><!-- End #main -->