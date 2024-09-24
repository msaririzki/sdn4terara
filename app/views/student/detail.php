<!-- page title -->
<section
   class="page-title-section overlay bg-cover"
   data-background="<?=BASEURL;?>/images/backgrounds/page-title.jpg"
>
   <div class="container">
      <div class="row">
         <div class="col-md-8">
            <ul class="list-inline custom-breadcrumb">
               <li class="list-inline-item">
                  <a class="h2 text-primary font-secondary" href="teacher.html">Siswa Kami</a>
               </li>
               <li class="list-inline-item text-white h3 font-secondary @@nasted"></li>
            </ul>
            <p class="text-lighten">
               Halaman ini dirancang untuk memudahkan orang tua, guru, dan staf sekolah dalam mengakses data siswa dengan cepat dan efisien.
            </p>
         </div>
      </div>
   </div>
</section>
<!-- /page title -->

<!-- student details -->
<section class="section">
   <div class="container">
      <!-- konfigurasi dibutuhkan menampilkan data siswa terkait -->
      <div class="row">
         <div class="col-md-12 mb-5">
            <h3><?= $data['siswa']['nama_siswa']; ?></h3>
            <table class="table table-bordered">
               <thead>
                  <tr>
                     <th>Field</th>
                     <th>Detail</th>
                  </tr>
               </thead>
               <tbody>
                  <tr>
                     <td>NIS</td>
                     <td><?= $data['siswa']['nis_siswa']; ?></td>
                  </tr>
                  <tr>
                     <td>Nama</td>
                     <td><?= $data['siswa']['nama_siswa']; ?></td>
                  </tr>
                  <tr>
                     <td>Biografi Singkat</td>
                     <td><?= $data['siswa']['biografi_singkat_siswa']; ?></td>
                  </tr>
                  <tr>
                     <td>Kelas</td>
                     <td>Kelas <?= $data['siswa']['kelas']; ?></td>
                  </tr>
                  <tr>
                     <td>Alamat</td>
                     <td><?= $data['siswa']['alamat']; ?></td>
                  </tr>
                  <tr>
                     <td>Nama Wali</td>
                     <td><?= $data['siswa']['nama_wali']; ?></td>
                  </tr>
                  <tr>
                     <td>No. HP Wali</td>
                     <td><?= $data['siswa']['no_hp_wali']; ?></td>
                  </tr>
               </tbody>
            </table>
         </div>
      </div>
   </div>
</section>
<!-- /student details -->
