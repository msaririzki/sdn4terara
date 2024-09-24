<!-- page title -->
<section class="page-title-section overlay bg-cover" data-background="<?= BASEURL ?>/images/sd4/tentangkami.jpeg">
  <div class="container">
    <div class="row">
      <div class="col-md-8">
        <ul class="list-inline custom-breadcrumb">
          <li class="list-inline-item">
            <a class="h2 text-primary font-secondary" href="<?= BASEURL ?>/blog">Berita Terkini</a>
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

<!-- blogs -->
<section class="section">
  <div class="container">
    <div class="row">
      <?php foreach ($data['berita'] as $dt): ?>
        <!-- blog post -->
        <article class="col-lg-4 col-md-6 col-sm-12 mb-4">
          <div class="card rounded-0 border-bottom border-primary border-top-0 border-left-0 border-right-0 hover-shadow">
            <img class="card-news-img-top rounded-0" src="<?= BASEURL . '/upload/' . $dt['gambar_berita']; ?>"
              alt="Post thumb" />
            <div class="card-body">
              <!-- post meta -->
              <ul class="list-inline mb-3">
                <!-- post date -->
                <li class="list-inline-item mr-3 ml-0"><?= $dt['waktu_pembuatan']; ?></li>
              </ul>
              <a href="<?= BASEURL ?>/blog/blogsingle/<?= $dt['id_berita']; ?>">
                <!-- konfigurasi judul berita - maksimal 2 baris atau 52 char -->
                <h4 class="card-title">
                  <?= substr($dt['judul_berita'], 0, 52); ?>
                </h4>
              </a>
              <!-- dibutuhkan konfigurasi isi berita - maksimal 2 baris atau 74 char  -->
              <p class="card-text">
                <?= substr($dt['isi_berita'], 0, 74); ?>...
              </p>
              <a href="<?= BASEURL ?>/blog/blogsingle/<?= $dt['id_berita']; ?>" class="btn btn-primary btn-sm">Baca
                Berita</a>
            </div>
          </div>
        </article>
      <?php endforeach; ?>
    </div>
    <!-- pagination -->
    <nav class="blog-pagination justify-content-center d-flex">
      <ul class="pagination">
        <?php if ($data['currentPage'] > 1): ?>
          <li class="page-item">
            <a href="<?= BASEURL ?>/blog/index/<?= $data['currentPage'] - 1 ?>" class="page-link" aria-label="Previous">
              <i class="ti-angle-left pagination-icon"></i>
            </a>
          </li>
        <?php endif; ?>
        <?php for ($i = 1; $i <= $data['totalPages']; $i++): ?>
          <li class="page-item <?= $i == $data['currentPage'] ? 'active' : '' ?>">
            <a href="<?= BASEURL ?>/blog/index/<?= $i ?>" class="page-link"><?= $i ?></a>
          </li>
        <?php endfor; ?>
        <?php if ($data['currentPage'] < $data['totalPages']): ?>
          <li class="page-item">
            <a href="<?= BASEURL ?>/blog/index/<?= $data['currentPage'] + 1 ?>" class="page-link" aria-label="Next">
              <i class="ti-angle-right pagination-icon"></i>
            </a>
          </li>
        <?php endif; ?>
      </ul>
    </nav>
    <!-- end paginate -->
  </div>
</section>
<!-- /blogs -->