<!-- page title -->
<section
      class="page-title-section overlay bg-cover"
      data-background="images/backgrounds/page-title.jpg"
    >
      <div class="container">
        <div class="row">
          <div class="col-md-8">
            <ul class="list-inline custom-breadcrumb">
              <li class="list-inline-item">
                <a class="h2 text-primary font-secondary" href="teacher.php"
                  >Guru Kami</a
                >
              </li>
              <!-- configurasi nama guru yang bersangkutan -->
              <li
                class="list-inline-item text-white h3 font-secondary @@nasted"
              ></li>
            </ul>
            <p class="text-lighten">
              Kenali lebih dekat tim pengajar hebat kami yang siap membimbing
              anak-anak menuju masa depan yang cerah.
            </p>
          </div>
        </div>
      </div>
    </section>
    <!-- /page title -->

    <!-- teachers -->
    <section class="section">
      <div class="container">
        <!-- dibutuhkan configurasi menampilkan guru maksimal 9 per page -->
        <div class="row justify-content-center">
          <!-- teacher -->
           <?php foreach($data['guru'] as $gr): ?>
          <div class="col-lg-4 col-sm-6 mb-5 mb-lg">
            <div
              class="card rounded-0 border-bottom border-primary border-top-0 border-left-0 border-right-0 hover-shadow"
            >
              <img
                class="card-teach-img-top rounded-0"
                src="<?=BASEURL . '/upload/' . $gr['gambar_guru'];?>"
                alt="teacher"
              />
              <div class="card-body">
                <a href="<?=BASEURL; ?>/teacher/teachersingle/<?= $gr['id_guru']; ?>">
                  <!-- dibutuhkan configurasi nama guru -->
                  <h4 class="card-title"><?= $gr['nama_guru']; ?></h4>
                </a>
                <!-- jabatan fungsional -->
                <p><?= $gr['jabatan']; ?></p>
              </div>
            </div>
          </div>
          <?php endforeach;?>
            <!-- end teacher -->
        </div>
      </div>
      <!-- dibutuhkan configurasi untuk pagination -->
      <div>
    <nav class="blog-pagination justify-content-center d-flex">
        <ul class="pagination">
            <!-- Jika halaman saat ini lebih besar dari 1, tampilkan tombol "Previous" -->
            <?php if ($data['currentPage'] > 1): ?>
            <li class="page-item">
                <a href="<?= BASEURL ?>/teacher/index/<?= $data['currentPage'] - 1 ?>" class="page-link" aria-label="Previous">
                    <i class="ti-angle-left pagination-icon"></i>
                </a>
            </li>
            <?php endif; ?>

            <!-- Loop untuk menampilkan nomor halaman -->
            <?php for ($i = 1; $i <= $data['totalPages']; $i++): ?>
            <li class="page-item <?= $i == $data['currentPage'] ? 'active' : '' ?>">
                <a href="<?= BASEURL ?>/teacher/index/<?= $i ?>" class="page-link"><?= $i ?></a>
            </li>
            <?php endfor; ?>

            <!-- Jika halaman saat ini kurang dari total halaman, tampilkan tombol "Next" -->
            <?php if ($data['currentPage'] < $data['totalPages']): ?>
            <li class="page-item">
                <a href="<?= BASEURL ?>/teacher/index/<?= $data['currentPage'] + 1 ?>" class="page-link" aria-label="Next">
                    <i class="ti-angle-right pagination-icon"></i>
                </a>
            </li>
            <?php endif; ?>
        </ul>
    </nav>
</div>

    </section>
    <!-- /teachers -->