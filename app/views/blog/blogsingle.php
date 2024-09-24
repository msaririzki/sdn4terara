<!-- page title -->
<section class="page-title-section overlay bg-cover" data-background="<?= BASEURL ?>/images/sd4/tentangkami.jpeg">
  <div class="container">
    <div class="row">
      <div class="col-md-8">
        <ul class="list-inline custom-breadcrumb">
          <li class="list-inline-item">
            <a class="h2 text-primary font-secondary" href="<?= BASEURL ?>/blog">Berita Terkini</a>
          </li>
          <li class="list-inline-item text-white h3 font-secondary nasted">
            Detail Berita
          </li>
        </ul>
        <p class="text-lighten">
          Kami bangga untuk berbagi berita-berita positif dan inspiratif
          yang mencerminkan komitmen kami terhadap pendidikan berkualitas
          dan pengembangan holistik siswa.
        </p>
      </div>
    </div>
  </div>
</section>
<!-- /page title -->

<!-- blog details -->
<section class="section-sm bg-gray">
  <div class="container">
    <div class="row">
      <div class="col-12 mb-4">
        <!-- configurasi cover detail berita terkait -->
        <img src="<?= BASEURL . '/upload/' . $data['berita']['gambar_berita'] ?>" alt="blog-thumb"
          class="img-blog img-fluid w-100" />
      </div>
      <div class="col-12">
        <ul class="list-inline">
          <!-- configurasi nama admin yang memposting berita -->
          <li class="list-inline-item mr-4 mb-3 mb-md-0 text-light">
            <!-- <span class="font-weight-bold mr-2">Post:</span>Muhidin -->
          </li>
          <!-- configurasi tanggal postingan -->
          <li class="list-inline-item mr-4 mb-3 mb-md-0 text-light">
            <!-- 23 Agustus 2024 -->
          </li>
          <!-- configurasi jumlah user yang membaca berita -->
          <li class="list-inline-item mr-4 mb-3 mb-md-0 text-light">
            <!-- <i class="ti-book mr-2"></i>Read 289 -->
          </li>
        </ul>
      </div>
      <!-- border -->
      <div class="col-12 mt-4">
        <div class="border-bottom border-primary"></div>
      </div>
      <!-- blog contect -->
      <div class="col-12 mb-5">
        <!-- configurasi judul berita -->
        <h2 class="mb-5">
          <?= $data['berita']['judul_berita']; ?>
        </h2>
        <p style="text-align: justify;">
          <?= $data['berita']['isi_berita']; ?>
        </p>
      </div>
    </div>
  </div>
</section>
<!-- /blog details -->

<!-- recommended post -->
<section class="section">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <!-- dibutuhkan configurasi menampilkan berita yang lain -->
        <div class="d-flex align-items-center section-title justify-content-between">
          <h2 class="mb-0 text-nowrap mr-3">Berita Lainnya</h2>
          <div class="border-top w-100 border-primary d-none d-sm-block"></div>
          <div>
            <a href="<?= BASEURL ?>/blog" class="btn btn-sm btn-primary-outline ml-sm-3 d-none d-sm-block">Lihat
              Semua</a>
          </div>
        </div>
      </div>
    </div>
    <div class="row justify-content-center">
      <!-- blog post -->
      <?php foreach ($data['beritabaru'] as $br): ?>
        <article class="col-lg-4 col-sm-6 mb-5 mb-lg-0">
          <div class="card rounded-0 border-bottom border-primary border-top-0 border-left-0 border-right-0 hover-shadow">
            <img class="card-news-img-top rounded-0" src="<?= BASEURL . '/upload/' . $br['gambar_berita']; ?>"
              alt="Post thumb" />
            <div class="card-body">
              <!-- post meta -->
              <ul class="list-inline mb-3">
                <!-- post date -->
                <!-- dibutuhkan configurasi tanggal postingan -->
                <li class="list-inline-item mr-3 ml-0"><?= $br['waktu_pembuatan']; ?></li>
              </ul>
              <a href="blog-single.php">
                <!-- configurasi judul berita - maksimal 2 baris atau 52 char-->
                <h4 class="card-title">
                  <?= $br['judul_berita']; ?>
                </h4>
              </a>
              <!-- dibutuhkan configurasi isi berita - maksimal 2 baris atau 74 char  -->
              <p class="card-text">
                <?= substr($br['isi_berita'], 0, 52); ?>...
              </p>
              <a href="<?= BASEURL ?>/blog/blogsingle/<?= $br['id_berita']; ?>" class="btn btn-primary btn-sm">Baca
                Berita</a>
            </div>
          </div>
        </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<!-- /recommended post -->