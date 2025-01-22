<style>
  .popup-content {
    background-color: rgba(255, 255, 255, 0.5); /* Putih dengan transparansi 80% */
    padding: 10px;
    border-radius: 5px;
  }
  .popup-content a {
    background-color: rgba(255, 165, 0, 0.8); /* Warna tombol dengan transparansi */
    color: white;
  }
</style>

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

  <!-- ======= Map Section ======= -->
  <section id="map" class="map">
    <div class="container">
      <div id="mapContainer" style="height: 600px;"></div>
    </div>
  </section>
  <!-- End Map Section -->
</main>

<!-- Include Leaflet CSS and JS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>

<script>
  // Inisialisasi map
  const map = L.map('mapContainer').setView([-6.963346, 110.247848], 14);

  // Tambahkan tile layer dari OpenStreetMap
  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
  }).addTo(map);

  // Data lokasi dari PHP
  const wakafData = <?= json_encode($wakaf) ?>;

  // Tambahkan marker untuk setiap lokasi wakaf
  wakafData.forEach(item => {
    if (item.koordinat) {
      const [lat, lng] = item.koordinat.split(',').map(coord => parseFloat(coord.trim()));

      // Tambahkan marker ke map
      const marker = L.marker([lat, lng]).addTo(map);

      // Tambahkan elemen custom idobject di bawah marker
      const customLabel = L.divIcon({
        className: 'custom-label',
        html: `<div style="text-align:center;font-size:12px;color:black;margin-top:8px;">
                 ${item.namawakaf}
               </div>`,
        iconSize: [0, 0], // Ukuran icon div kosong
      });

      // Tambahkan label ke posisi marker
      L.marker([lat, lng], { icon: customLabel }).addTo(map);

      // Tambahkan popup untuk marker
      marker.bindPopup(`
        <div class="popup-content">
          <h5>Detail Wakaf</h5>
          <p><b>Nama Wakaf:</b> ${item.namawakaf}</p>
          <p><b>idobject:</b> ${item.idobject}</p>
          <p><b>No Sertifikat:</b> ${item.nosertifikat}</p>
          <p><b>Alamat:</b> ${item.alamat}</p>
          <p><b>Pewakaf:</b> ${item.pewakaf}</p>
          <p><b>Status:</b> ${item.status}</p>
          <a href="<?= base_url('wakaf/detail') ?>/${item.idwakaf}" class="btn btn-warning">
            <i class="fa fa-eye"></i> Detail
          </a>
        </div>
      `);
    }
  });
</script>

<!-- Tambahkan style custom untuk label -->
<style>
  .custom-label {
    position: relative;
  }
</style>
