   <!-- page title -->
   <section
      class="page-title-section overlay bg-cover"
      data-background="<?=BASEURL; ?>/images/backgrounds/page-title.jpg"
    >
      <div class="container">
        <div class="row">
          <div class="col-md-8">
            <ul class="list-inline custom-breadcrumb">
              <li class="list-inline-item">
                <a class="h2 text-primary font-secondary" href="<?=BASEURL; ?>/teacher">Home</a>
                  >Guru Kami</a
                >
              </li>
              <!-- configurasi nama guru yang bersangkutan -->
              <li class="list-inline-item text-white h3 font-secondary nasted">
              <?= $data['guru']['nama_guru']; ?>
              </li>
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

    <!-- teacher details -->
    <section class="section">
      <div class="container">
        <div class="row">
          <div class="col-md-5 mb-5">
            <img
              class="img-teach img-fluid w-100"
              src="<?=BASEURL . '/upload/' . $data['guru']['gambar_guru']?>"
              alt="teacher"
            />
          </div>
          <!-- configurasi data guru terkait -->
          <div class="col-md-6 mb-5">
            <!-- configurasi nama guru terkait -->
            <h3><?= $data['guru']['nama_guru']; ?></h3>
            <!-- configurasi NIP guru terkait -->
            <h6 class="text-color mb-3">
              NIP. <span><?= $data['guru']['nip']; ?></span>
            </h6>
            <!-- configurasi info singkat guru -->
            <p class="mb-5">
            <?= $data['guru']['biografi_singkat']; ?>
            </p>
            <div class="row">
              <div class="col-md-6 mb-5 mb-md-0">
                <h4 class="mb-4">Informasi Singkat</h4>
                <ul class="list-unstyled">
                  <!-- configurasi nama jurusan atau program studi dan kampus -->
                  <li class="mb-3"><?= $data['guru']['program_studi']; ?>, <?= $data['guru']['universitas']; ?></li>
                  <li class="mb-3"><?= $data['guru']['no_hp']; ?></li>
                  <li class="mb-3">
                     <?= $data['guru']['alamat']; ?>
                  </li>
                </ul>
              </div>
              <div class="col-md-6">
                <h4 class="mb-4">Prestasi</h4>
                <ul class="list-unstyled">
                  <li class="mb-3">
                  <?= $data['guru']['prestasi1']; ?>
                  </li>
                  <li class="mb-3"><?= $data['guru']['prestasi2']; ?></li>
                  <li class="mb-3"><?= $data['guru']['prestasi3']; ?></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- /teacher details -->