    <!-- page title -->
    <section
      class="page-title-section overlay bg-cover"
      data-background="<?= BASEURL?>/images/covermtk.jpg"
    >
      <div class="container">
        <div class="row">
          <div class="col-md-8">
            <ul class="list-inline custom-breadcrumb">
              <li class="list-inline-item">
                <a class="h2 text-primary font-secondary" href="perpustakaan.php"
                  >Perpustakaan</a
                >
              </li>
              
              <li
                class="list-inline-item text-white h3 font-secondary @@nasted"
              ></li>
            </ul>
            <p class="text-lighten">
              Baca buku pembelajaran dari mana saja dan kapan saja. Kamu dapat mendownload ataupun membaca langsung melalui smartphone.
            </p>
          </div>
        </div>
      </div>
    </section>
    <!-- /page title -->

    <!-- list book -->
    <section class="section">
      <div class="container">
        <!-- dibutuhkan configurasi menampilkan buku maksimal 9 per page -->
        <div class="row justify-content-center">
          <!-- item -->
           <?php foreach ($data['books'] as $pr ) : ?>
          <div class="col-lg-4 col-sm-6 mb-5 mb-lg">
            <div
              class="card rounded-0 border-bottom border-primary border-top-0 border-left-0 border-right-0 hover-shadow"
            >
              <img
                class="card-teach-img-top rounded-0"
                src="<?=BASEURL . '/upload/' . $pr['gambar_buku'];?>"
                alt="item"
              />
              <div class="card-body">
                <!-- configurasi ke link buku -->
                <a href="#">
                  <!-- dibutuhkan configurasi nama buku -->
                  <h4 class="card-title"><?= $pr['judul_buku'] ?></h4>
                </a>
                <!-- configurasi ke link buku -->
                <a href="<?= $pr['link_buku'] ?>" class="btn btn-primary btn-sm" target="_blank">
                  Baca Buku
                </a>
              </div>
            </div>
          </div>
          <?php endforeach;?>
          <!-- end item -->
        </div>
      </div>
      <!-- dibutuhkan configurasi untuk pagination -->
    <!-- pagination -->
    <nav class="blog-pagination justify-content-center d-flex">
      <ul class="pagination">
        <?php if ($data['currentPage'] > 1): ?>
        <li class="page-item">
          <a href="<?= BASEURL ?>/perpustakaan/index/<?= $data['currentPage'] - 1 ?>" class="page-link" aria-label="Previous">
            <i class="ti-angle-left pagination-icon"></i>
          </a>
        </li>
        <?php endif; ?>
        <?php for ($i = 1; $i <= $data['totalPages']; $i++): ?>
        <li class="page-item <?= $i == $data['currentPage'] ? 'active' : '' ?>">
          <a href="<?= BASEURL ?>/perpustakaan/index/<?= $i ?>" class="page-link"><?= $i ?></a>
        </li>
        <?php endfor; ?>
        <?php if ($data['currentPage'] < $data['totalPages']): ?>
        <li class="page-item">
          <a href="<?= BASEURL ?>/perpustakaan/index/<?= $data['currentPage'] + 1 ?>" class="page-link" aria-label="Next">
            <i class="ti-angle-right pagination-icon"></i>
          </a>
        </li>
        <?php endif; ?>
      </ul>
    </nav>
    <!-- end paginate -->
    </section>
    <!-- /teachers -->
