<!-- page title -->
<section class="page-title-section overlay bg-cover" data-background="<?= BASEURL ?>/images/sd4/tentangkami.jpeg">
  <div class="container">
    <div class="row">
      <div class="col-md-8">
        <ul class="list-inline custom-breadcrumb">
          <li class="list-inline-item"><a class="h2 text-primary font-secondary" href="<?= BASEURL; ?>/about">Tentang
              Kami</a>
          </li>
          <li class="list-inline-item text-white h3 font-secondary @@nasted"></li>
        </ul>
        <p class="text-lighten">SD Negeri 4 Terara berkomitmen untuk memberikan pendidikan dasar yang berkualitas dan
          holistik bagi siswa kami.</p>
      </div>
    </div>
  </div>
</section>
<!-- /page title -->

<!-- about -->
<section class="section">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <!-- please change this image with your real school vibe or your students photos -->
        <img class="img-fluid w-100 mb-4" src="<?= BASEURL; ?>/images/sd4/tentangkami.jpeg" alt="about image">
        <h2 class="section-title">Sedikit Cerita Perjalanan Kami</h2>
        <!-- please change this story with your real story-->
        <p style="text-align: justify;">Sekolah Dasar yang berdiri pada tanggal 1 April 1984
          sebagai sekolah INPRES semula bernama SDN 3 Terara,
          berada di tengah kota keamatan yang padat penduduk. Seiring perjalanan waktu dan pembangunan yang terus
          melaju, akhirnya terkena relokasi karena pembangunan fasilitas publik pada tahun 2015, yang kala itu sudah
          berganti nama menjadi SDN 7 Terara. Pada lokasi baru yang terletak di kawasan perkantoran dan jarang
          perumahan, SDN 7 Terara menjadi sekolah yang kurang diminati. Namun semuanya bukanlah kendala untuk menjadi
          lembaga pendidikan terpercaya, setelah terjadi perubahan numenklatur karena adanya pemekaran desa, pada tahun
          2019 berganti nama menjadi SDN 4 Terara.
          Sejak COVID-19 melanda, SDN 4 Terara mulai melakukan perubahan dengan menata manajemen yang lebih baik. Mulai
          menjadi sekolah model, dan pada tahun 2022 Terpilih menjadi salah satu sekolah pelaksana Program Sekolah
          Penggerak , yang akhirnya mendongkrak kepercayaan diri dan kepercayaan publik terhadap erkembangan pendidikan
          di SDN 4 Terara yang mengusung Satuan pendidikan Ramah Anak, Kurikulum Merdeka, Merdeka Belajar, dan Proses
          Pembelajaran yang berpusat pada murid.
          Pendidikan harus selaras dengan kodrat alam, kodrat zaman, dan karakteristik lingkungan tempat pendidikan
          berada. Pendidikan adalah salah satu warisan untuk generasi gemilang yang akan meneruskan pembangunan di
          Republik ini.</p>
      </div>
    </div>
  </div>
</section>
<!-- /about -->

<!-- funfacts -->
<?php extract($data) ?>
<section class="section-sm bg-primary">
  <div class="container">
    <div class="row">
      <!-- please replace this number with the actual amount of data displayed -->
      <!-- funfacts item -->
      <div class="col-md-3 col-sm-6 mb-4 mb-md-0">
        <div class="text-center">
          <!-- data total guru -->
          <h2 class="count text-white" data-count="<?= $totalguru; ?>">0</h2>
          <h5 class="text-white">TENAGA PENDIDIK</h5>
        </div>
      </div>
      <!-- funfacts item -->
      <div class="col-md-3 col-sm-6 mb-4 mb-md-0">
        <div class="text-center">
          <!-- data total ruangan -->
          <h2 class="count text-white" data-count="6">0</h2>
          <h5 class="text-white">RUANGAN</h5>
        </div>
      </div>
      <!-- funfacts item -->
      <div class="col-md-3 col-sm-6 mb-4 mb-md-0">
        <div class="text-center">
          <!-- data total siswa -->
          <h2 class="count text-white" data-count="158">0</h2>
          <h5 class="text-white">SISWA AKTIF</h5>
        </div>
      </div>
      <!-- funfacts item -->
      <div class="col-md-3 col-sm-6 mb-4 mb-md-0">
        <div class="text-center">
          <!-- data total komputer -->
          <h2 class="count text-white" data-count="41">0</h2>
          <h5 class="text-white">CHROMEBOOK</h5>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- /funfacts -->

<!-- success story -->
<section class="section bg-cover" data-background="<?= BASEURL ?>/images/sd4/berita2.jpeg">
  <div class="container">
    <div class="col-lg-6 col-sm-8">
      <div class="bg-white p-5">
        <h2 class="section-title">Surat dari Masa Depan</h2>
        <p>Pendidikan adalah jendela dunia, yang membuka cakrawala luas penuh pengetahuan dan pengalaman. Teruslah
          berjuang, meskipun jalan kadang terasa sulit dan penuh rintangan. Ketahuilah bahwa setiap usaha yang kalian
          lakukan, setiap tetes keringat yang kalian keluarkan, akan terbayar dengan hasil yang indah di masa depan.</p>
        <p>Ingatlah, bahwa masa depan kalian ditentukan oleh apa yang kalian lakukan hari ini. Jadilah pribadi yang
          penuh semangat, selalu haus akan pengetahuan, dan tak pernah berhenti berusaha. Dunia membutuhkan kecerdasan,
          kebaikan, dan keberanian kalian untuk membuat perubahan yang positif.</p>
      </div>
    </div>
  </div>
  </div>
</section>
<!-- /success story -->


<!-- teachers -->
<section class="section">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12">
        <div class="d-flex align-items-center section-title justify-content-between">
          <h2 class="mb-0 text-nowrap mr-3">Guru Kami</h2>
          <div class="border-top w-100 border-primary d-none d-sm-block"></div>
          <div>
            <a href="<?= BASEURL; ?>/teacher" class="btn btn-sm btn-primary-outline ml-sm-3 d-none d-sm-block">Lihat
              Semua</a>
          </div>
        </div>
      </div>
      <!-- teacher -->
      <?php foreach ($data['guru'] as $gr): ?>
        <div class="col-lg-4 col-sm-6 mb-5 mb-lg-0">
          <div class="card rounded-0 border-bottom border-primary border-top-0 border-left-0 border-right-0 hover-shadow">
            <img class="card-teach-img-top rounded-0" src="<?= BASEURL . '/upload/' . $gr['gambar_guru']; ?>"
              alt="teacher">
            <div class="card-body">
              <a href="<?= BASEURL ?>/teacher/teachersingle/<?= $gr['id_guru']; ?>">
                <!-- dibutuhkan configurasi nama guru -->
                <h4 class="card-title"><?= $gr['nama_guru']; ?></h4>
              </a>
              <p><?= $gr['jabatan']; ?></p>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
  <!-- /teachers -->

</section>

<!-- /teachers -->
<!-- /teachers -->