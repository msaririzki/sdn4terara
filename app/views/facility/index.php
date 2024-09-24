<!-- page title -->
<section class="page-title-section overlay bg-cover" data-background="<?= BASEURL ?>/images/sd4/tentangkami.jpeg">
  <div class="container">
    <div class="row">
      <div class="col-md-8">
        <ul class="list-inline custom-breadcrumb">
          <li class="list-inline-item">
            <a class="h2 text-primary font-secondary" href="facility.php">Fasilitas Kami</a>
          </li>
          <li class="list-inline-item text-white h3 font-secondary @@nasted"></li>
        </ul>
        <p class="text-lighten">
          Dengan berbagai fasilitas modern dan lengkap, kami memastikan
          setiap siswa mendapatkan pengalaman belajar terbaik.
        </p>
      </div>
    </div>
  </div>
</section>
<!-- /page title -->

<!-- facility -->
<section class="section">
  <div class="container">
    <div class="row justify-content-center">
      <?php foreach ($data['fasilitas'] as $fs): ?>
        <!-- facility item -->
        <div class="col-lg-4 col-sm-6 mb-4 mb-lg-0">
          <div class="card rounded-0 hover-shadow border-top-0 border-left-0 border-right-0">
            <img class="card-facility-img-top rounded-0" src="<?= BASEURL . '/upload/' . $fs['gambar_fasilitas']; ?>"
              alt="facility-thumb" />
            <div class="card-body">
              <!-- configurasi nama barang - jadikan capital -->
              <h4 class="card-title mb-3 text-uppercase"><?= $fs['nama_fasilitas']; ?></h4>
              <ul class="list-styled">
                <!-- configurasi detail barang -->
                <li>Jumlah <?= $fs['jumlah']; ?> unit</li>
                <li>kondisi <?= $fs['kondisi']; ?></li>
                <li>Tahun beli <?= $fs['tahun_beli']; ?></li>
              </ul>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<!-- /facility -->