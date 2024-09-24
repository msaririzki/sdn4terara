<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content rounded-0 border-0 p-4">
      <div class="modal-header border-0">
        <h3>Login</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- dibutuhkan configurasi untuk form input login -->
        <form action="#" class="row">
          <div class="col-12">
            <label for="username" class="col-form-label">Username</label>
            <input type="text" class="form-control mb-3" id="username" name="username" placeholder="Enter your username"
              required />
          </div>
          <div class="col-12">
            <label for="password" class="col-form-label">Password</label>
            <input type="password" class="form-control mb-3" id="password" name="password"
              placeholder="Enter your password" required />
          </div>
          <div class="col-12">
            <!-- dibutuhkan configurasi credential user -->
            <button type="submit" class="btn btn-primary">Login</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- page title -->
<section class="page-title-section overlay bg-cover" data-background="<?= BASEURL ?>/images/sd4/tentangkami.jpeg">
  <div class="container">
    <div class="row">
      <div class="col-md-8">
        <ul class="list-inline custom-breadcrumb">
          <li class="list-inline-item">
            <a class="h2 text-primary font-secondary" href="@@page-link">Kontak Kami</a>
          </li>
          <li class="list-inline-item text-white h3 font-secondary @@nasted"></li>
        </ul>
        <p class="text-lighten">
          Tim kami siap memberikan informasi yang Anda butuhkan seputar
          program pendidikan, kegiatan ekstrakurikuler, pendaftaran siswa
          baru, dan lain-lain.
        </p>
      </div>
    </div>
  </div>
</section>
<!-- /page title -->

<!-- contact -->
<section class="section bg-gray">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <h2 class="section-title">Hubungi Kami</h2>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-7 mb-4 mb-lg-0">
        <!-- dibutuhkan configurasi mengirim pesan ke tim humas sekolah -->
        <form action="#">
          <input type="text" class="form-control mb-3" id="name" name="name" placeholder="Nama Lengkap" />
          <input type="email" class="form-control mb-3" id="mail" name="mail" placeholder="Alamat Email" />
          <input type="text" class="form-control mb-3" id="subject" name="subject" placeholder="Subject Pesan" />
          <textarea name="message" id="message" class="form-control mb-3" placeholder="Pesan"></textarea>
          <button type="submit" value="send" class="btn btn-primary">
            Kirim Pesan
          </button>
        </form>
      </div>
      <div class="col-lg-5">
        <p>
          Kami percaya bahwa komunikasi yang baik antara sekolah dan orang
          tua/wali sangat penting untuk mendukung perkembangan anak-anak.
          Oleh karena itu, kami selalu terbuka untuk mendengarkan dan
          berdiskusi demi kebaikan bersama.
        </p>
        <p class="mb-5">
          Hubungi kami sekarang juga dan mari kita bersama-sama menciptakan
          lingkungan pendidikan yang terbaik untuk anak-anak kita.
        </p>
        <!-- change this number with the real telephone number of this school -->
        <a href="tel:+8802057843248" class="text-color d-block">+62 (6272) 383 76</a>
        <a href="mailto:yourmail@email.com" class="mb-5 text-color d-block">sdn4terara@sch.id</a>
        <p>
          Jl. Pendidikan No. 10, Terara, Lombok Timur,<br />
          NTB 83663
        </p>
      </div>
    </div>
  </div>
</section>
<!-- /contact -->

<!-- gmap -->
<!-- dibutuhkan configurasi data google maps yang menunjukkan lokasi sekolah -->
<!-- pastikan menggunakan API Keys Google Maps yang sesuai -->
<section class="section pt-0">
  <!-- Google Map -->
  <!-- -8.639482414194282, 116.4134291120342 -->
  <div id="map_canvas" data-latitude="-8.639482414194282" data-longitude="116.4134291120342"></div>
</section>
<!-- /gmap -->