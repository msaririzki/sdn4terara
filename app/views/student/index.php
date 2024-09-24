<!-- page title -->
<section class="page-title-section overlay bg-cover" data-background="<?= BASEURL ?>/images/sd4/perjalanan.jpeg">
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
               Halaman ini dirancang untuk memudahkan orang tua, guru, dan staf sekolah dalam mengakses data siswa
               dengan cepat dan efisien.
            </p>
         </div>
      </div>
   </div>
</section>
<!-- /page title -->

<!-- student list -->
<section class="section">
   <div class="container">
      <div class="search-item mb-5">
         <h4>Cari Siswa</h4>
         <!-- konfigurasi search -->
         <div id="add-row_filter" class="dataTables_filter">
            <div class="dataTables_filter">
               <label>
                  <input type="search" id="searchInput" class="form-control form-control-sm" placeholder=""
                     aria-controls="add-row">
               </label>
               <button type="button" id="searchButton" class="btn btn-primary">Cari</button>
            </div>
         </div>


         <!-- daftar siswa -->
         <div class="row">
            <div class="col-md-12 mb-5">
               <h3>Daftar Siswa</h3>
               <table class="table table-striped table-bordered">
                  <thead>
                     <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>NIS Siswa</th>
                        <th>Aksi</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php $i = 0; ?>
                     <?php foreach ($data['siswa'] as $ds): ?>
                        <!-- contoh baris data siswa -->
                        <tr>
                           <td><?= $i + 1 ?></td>
                           <td><?= $ds['nama_siswa'] ?></td>
                           <td><?= $ds['nis_siswa'] ?></td>
                           <td>
                              <a href="<?= BASEURL; ?>/student/detail/<?= $ds['id_siswa'] ?>" class="btn btn-primary">Lihat
                                 Detail Data</a>
                           </td>
                        </tr>
                        <!-- tambahkan baris lain sesuai kebutuhan -->
                        <?php $i++; ?>
                     <?php endforeach; ?>
                  </tbody>
               </table>
            </div>
         </div>
      </div>
      <!-- pagination -->
      <nav class="blog-pagination justify-content-center d-flex">
         <ul class="pagination">
            <?php if ($data['currentPage'] > 1): ?>
               <li class="page-item">
                  <a href="<?= BASEURL ?>/student/index/<?= $data['currentPage'] - 1 ?>" class="page-link"
                     aria-label="Previous">
                     <i class="ti-angle-left pagination-icon"></i>
                  </a>
               </li>
            <?php endif; ?>
            <?php for ($i = 1; $i <= $data['totalPages']; $i++): ?>
               <li class="page-item <?= $i == $data['currentPage'] ? 'active' : '' ?>">
                  <a href="<?= BASEURL ?>/student/index/<?= $i ?>" class="page-link"><?= $i ?></a>
               </li>
            <?php endfor; ?>
            <?php if ($data['currentPage'] < $data['totalPages']): ?>
               <li class="page-item">
                  <a href="<?= BASEURL ?>/student/index/<?= $data['currentPage'] + 1 ?>" class="page-link"
                     aria-label="Next">
                     <i class="ti-angle-right pagination-icon"></i>
                  </a>
               </li>
            <?php endif; ?>
         </ul>
      </nav>
      <!-- end paginate -->
</section>
<script>
   document.getElementById('searchButton').addEventListener('click', function () {
      var query = document.getElementById('searchInput').value;
      if (query) {
         window.location.href = '<?= BASEURL ?>/student/searchSiswa/' + encodeURIComponent(query);
      }
   });
</script>
<!-- /student list -->