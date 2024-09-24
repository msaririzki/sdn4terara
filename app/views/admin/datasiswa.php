<?php
//session_start(); // Pastikan session dimulai
if (!isset($_SESSION['user_id'])) {
    header('Location: ' . BASEURL);
    exit;
}
?>
<body>
    <div class="wrapper">
       <!-- Sidebar -->
       <div class="sidebar" data-background-color="dark">
            <div class="sidebar-logo">
                <!-- Logo Header -->
                <div class="logo-header" data-background-color="dark">
                    <a href="dashboard.php" class="logo">
                        <img src="<?= BASEURL; ?>/images/logo-2.svg" alt="navbar brand" class="navbar-brand" height="20" />
                    </a>
                    <div class="nav-toggle">
                        <button class="btn btn-toggle toggle-sidebar">
                            <i class="gg-menu-right"></i>
                        </button>
                        <button class="btn btn-toggle sidenav-toggler">
                            <i class="gg-menu-left"></i>
                        </button>
                    </div>
                    <button class="topbar-toggler more">
                        <i class="gg-more-vertical-alt"></i>
                    </button>
                </div>
                <!-- End Logo Header -->
            </div>
            <div class="sidebar-wrapper scrollbar scrollbar-inner">
                <div class="sidebar-content">
                    <ul class="nav nav-secondary">
                        <li class="nav-item">
                            <a href="<?= BASEURL; ?>/admin/dashboard">
                                <i class="fas fa-home"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        <li class="nav-item active">
                            <a href="<?= BASEURL; ?>/admin/datasiswa">
                                <i class="fas fa-user-graduate"></i>
                                <p>Data Siswa</p>  
                            </a>
                        </li>
                        <li class="nav-item"> 
                            <a href="<?= BASEURL; ?>/admin/dataguru">
                                <i class="fas fa-users"></i> 
                                <p>Data Guru</p> 
                            </a>
                        </li>
                        <li class="nav-item"> 
                            <a href="<?= BASEURL; ?>/admin/databerita">
                                <i class="fas fa-newspaper"></i>
                                <p>Berita</p> 
                            </a>
                        </li> 
                        <li class="nav-item">
                            <a href="<?= BASEURL; ?>/admin/datafasilitas">
                                <i class="fas fa-chalkboard-teacher"></i>
                                <p>Fasilitas</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= BASEURL; ?>/admin/dataperpustakaan">
                            <i class="fas fa-book"></i>
                            <p>Perpustakaan</p>
                            </a>
                        </li>
                        <li class="nav-item nav-item-logout">
                            <a href="<?= BASEURL; ?>/login/logout">
                                <i class="fas fa-sign-out-alt"></i>
                                <p>Logout</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- End Sidebar -->
      <!-- End Sidebar -->

      <div class="main-panel">
        <!-- add new component in here -->
        <div class="main-header">
          <div class="main-header-logo">
            <!-- Logo Header -->
            <div class="logo-header" data-background-color="dark">
            <a href="dashboard.php" class="logo">
              <img src="../images/logo-2.svg" alt="navbar brand" class="navbar-brand" height="20">
            </a>
            <div class="nav-toggle">
              <button class="btn btn-toggle toggle-sidebar">
                <i class="gg-menu-right"></i>
              </button>
              <button class="btn btn-toggle sidenav-toggler">
                <i class="gg-menu-left"></i>
              </button>
            </div>
            <button class="topbar-toggler more">
              <i class="gg-more-vertical-alt"></i>
            </button>
          </div>
            <!-- End Logo Header -->
          </div>
          <!-- Navbar Header -->
          <nav class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom">
            <div class="container-fluid">
              <nav class="navbar navbar-header-left navbar-expand-lg navbar-form nav-search p-0 d-none d-lg-flex">
              
              </nav>
            </div>
          </nav>
          <!-- End Navbar -->
        </div>
        <!-- end of this component -->
        <div class="container">
          <div class="page-inner">
            <div
              class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4"
            >
              <div>
                <h3 class="fw-bold mb-3">Data Siswa</h3>
                <h6 class="op-7 mb-2">Lihat sekilas statistik penting dan notifikasi terbaru</h6>
              </div>
              <div class="ms-md-auto py-2 py-md-0">
                <a class="btn btn-primary btn-round" href="#" data-bs-toggle="modal" data-bs-target="#addUser">Tambah Data Siswa</a>
              </div>
            </div>
            <!-- tabel data berita --> 
            <div class="col-md-12">
                <div class="card">
                  <div class="card-body">
                    <div class="table-responsive">
                      <div id="add-row_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
                        <div class="row"><div class="col-sm-12 col-md-6">
                          <div class="dataTables_length" id="add-row_length">
                            <!-- <label>Tampilkan 
                              <select name="add-row_length" aria-controls="add-row" class="form-control form-control-sm">
                                <option value="10">10
                                </option>
                              </select>
                            </label> -->
                          </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                        <div id="add-row_filter" class="dataTables_filter">
                          <div class="dataTables_filter">
                            <label>Cari 
                              <input type="search" id="searchInput" class="form-control form-control-sm" placeholder="" aria-controls="add-row">
                            </label>
                            <button type="button" id="searchButton" class="btn btn-primary">Cari</button>
                          </div>
                        </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-12">
                          <table id="add-row" class="display table table-striped table-hover dataTable" role="grid" aria-describedby="add-row_info">
                        <thead>
                          <!-- header tabel data fasilitas -->
                          <tr role="row">
                            <th class="sorting_asc" tabindex="0" aria-controls="add-row" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 204.992px;">
                              Nama Siswa 
                            </th>
                            <th class="sorting" tabindex="0" aria-controls="add-row" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 301.883px;">
                              Nama Wali Murid
                            </th>
                            <th class="sorting" tabindex="0" aria-controls="add-row" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 301.883px;">
                              No. HP Wali Murid 
                            </th>
                            <th class="sorting" tabindex="0" aria-controls="add-row" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 301.883px;">
                              Kelas
                            </th>
                            <th class="sorting" tabindex="0" aria-controls="add-row" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 166.438px;">
                              NIS
                            </th>
                            <th class="sorting" tabindex="0" aria-controls="add-row" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 166.438px;">
                              Alamat 
                            </th>
                            <th style="width: 120.688px;" class="sorting" tabindex="0" aria-controls="add-row" rowspan="1" colspan="1" aria-label="Action: activate to sort column ascending">
                              Action
                            </th>
                          </tr>
                        </thead>
                        <!-- content tabel -->
                        <tbody>
                          <?php foreach ($data['siswa'] as $ds) : ?>
                          <tr role="row" class="odd">
                              <!--  nama  --> 
                              <td class="sorting_1">
                                <?= $ds['nama_siswa']; ?>
                              </td>
                              <!-- Nama wali -->
                              <td>
                              <?= $ds['nama_wali']; ?>
                              </td>
                              <td>
                              <?= $ds['no_hp_wali']; ?>
                              </td>
                              <!-- Kelas -->
                              <td>
                              <?= $ds['kelas']; ?>
                              </td>
                              <!-- NIS-->
                              <td> 
                              <?= $ds['nis_siswa']; ?>
                              </td>
                              <!-- alamat -->
                              <td>
                              <?= $ds['alamat']; ?>
                              </td>
                              <td>
                                <div class="form-button-action">
                                  <!-- memunculkan pop up untuk edit -->
                                  <button type="button"  title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task" data-bs-toggle="modal" data-bs-target="#addUser">
                                    <i class="fa fa-edit">
                                    <a href="<?= BASEURL ?>/admin/editSiswa/<?= $ds['id_siswa'] ?>" onclick="return confirm('Yakin mau mengedit data ini?');">Edit</a>
                                    </i>
                                  </button>
                                  <!-- menghapus content -->
                                  <button type="button" data-bs-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove">
                                    <i class="fa fa-times"><a href="<?= BASEURL ?>/admin/hapusSiswa/<?= $ds['id_siswa'] ?>" onclick="return confirm('Yakin mau menghapus data ini?');">Hapus</a></i>
                                  </button>
                                </div>
                              </td>
                          </tr>
                          <?php endforeach;?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                    <!-- paginate -->
                    <div class="row">
                      <div class="col-sm-12 col-md-5">
                        <div class="dataTables_info" id="add-row_info" role="status" aria-live="polite">
                          Menampilkan halaman <?= $data['currentPage'] ?> dari <?= $data['totalPages'] ?>
                        </div>
                      </div>
                      <div class="col-sm-12 col-md-7">
                        <div class="dataTables_paginate paging_simple_numbers" id="add-row_paginate">
                          <ul class="pagination">
                            <?php if ($data['currentPage'] > 1): ?>
                            <li class="paginate_button page-item previous" id="add-row_previous">
                              <a href="<?= BASEURL ?>/admin/datasiswa/<?= $data['currentPage'] - 1 ?>" aria-controls="add-row" data-dt-idx="0" tabindex="0" class="page-link">Previous</a>
                            </li>
                            <?php endif; ?>
                            <?php for ($i = 1; $i <= $data['totalPages']; $i++): ?>
                            <li class="paginate_button page-item <?= $i == $data['currentPage'] ? 'active' : '' ?>">
                              <a href="<?= BASEURL ?>/admin/datasiswa/<?= $i ?>" aria-controls="add-row" data-dt-idx="<?= $i ?>" tabindex="0" class="page-link"><?= $i ?></a>
                            </li>
                            <?php endfor; ?>
                            <?php if ($data['currentPage'] < $data['totalPages']): ?>
                            <li class="paginate_button page-item next" id="add-row_next">
                              <a href="<?= BASEURL ?>/admin/datasiswa/<?= $data['currentPage'] + 1 ?>" aria-controls="add-row" data-dt-idx="3" tabindex="0" class="page-link">Next</a>
                            </li>
                            <?php endif; ?>
                          </ul>
                        </div>
                      </div>
                    </div>
                    <!-- end paginate -->
                </div>
              </div>
          </div>
        </div>
      </div>
    </div>

<!-- Modal Pop Up -->
<!-- configurasi untuk menambahkan data fasilitas --> 
<div class="modal fade" id="addUser" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content rounded-0 border-0 p-4">
      <div class="modal-header border-0">
        <h3>Tambahkan Data Siswa</h3> 
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- dibutuhkan konfigurasi untuk form input fasilitas -->
      <form action="<?= BASEURL; ?>/admin/tambahSiswa" class="row" method="POST" enctype="multipart/form-data">
        <div class="col-12">
          <label for="namaSiswa" class="col-form-label">Nama Siswa</label>
          <input type="text" class="form-control mb-3" id="namaSiswa" name="namaSiswa" placeholder="Masukkan nama siswa" required>
        </div>
        <div class="col-12">
          <label for="biografiSiswa" class="col-form-label">Biografi Singkat</label>
          <textarea class="form-control mb-3" id="biografiSiswa" name="biografiSiswa" placeholder="Masukkan biografi singkat untuk siswa berprestasi (maksimal 250 karakter)" maxlength="250" required></textarea>
        </div>
        <div class="col-12">
          <label for="nis" class="col-form-label">NIS</label>
          <input type="text" class="form-control mb-3" id="nis" name="nis" placeholder="Masukkan NIS" required>
        </div>
        <div class="col-12">
          <label for="alamatSiswa" class="col-form-label">Alamat</label>
          <input type="text" class="form-control mb-3" id="alamatSiswa" name="alamatSiswa" placeholder="Masukkan alamat" required>
        </div>
        <div class="col-12">
          <label for="noHpWali" class="col-form-label">No. HP Wali Murid</label>
          <input type="tel" class="form-control mb-3" id="noHpWali" name="noHpWali" placeholder="Masukkan no. HP wali murid" required>
        </div>
        <div class="col-12">
            <label for="walimurid" class="col-form-label">Nama walimurid</label>
            <input type="text" class="form-control mb-3" id="walimurid" name="walimurid" placeholder="Masukkan Nama Wali Murid" required>
          </div>
        <div class="col-12">
          <label for="kelasSaatIni" class="col-form-label">Kelas Saat Ini</label>
          <input type="text" class="form-control mb-3" id="kelasSaatIni" name="kelasSaatIni" placeholder="Masukkan kelas saat ini" required>
        </div>
        <div class="col-12">
          <label for="prestasiSiswa1" class="col-form-label">Prestasi (Opsional)</label>
          <input type="text" class="form-control mb-3" id="prestasiSiswa1" name="prestasiSiswa1" placeholder="Masukkan prestasi pertama">
        </div>
        <div class="col-12">
          <input type="text" class="form-control mb-3" id="prestasiSiswa2" name="prestasiSiswa2" placeholder="Masukkan prestasi kedua">
        </div>
        <div class="col-12">
          <input type="text" class="form-control mb-3" id="prestasiSiswa3" name="prestasiSiswa3" placeholder="Masukkan prestasi ketiga">
        </div>
        <!-- <div class="col-12 mb-3"> 
            <label for="fotoUnit" class="col-form-label">Foto Siswa</label>
            <input type="file" class="form-control" id="fotoUnit" name="fotoUnit" accept=".jpg, .jpeg, .png" required>
            <small class="form-text text-muted">Hanya format gambar jpg dan png dengan ukuran maksimal 2MB.</small>
          </div> -->
        <div class="col-12">
          <button type="submit" class="btn btn-primary">Tambahkan</button>
        </div>
      </form>

      </div>
    </div>
  </div>
</div>

<script>
    document.getElementById('searchButton').addEventListener('click', function() {
      var query = document.getElementById('searchInput').value;
      if (query) {
        window.location.href = '<?= BASEURL ?>/admin/datasiswa/search/' + encodeURIComponent(query);
      }
    });
  </script>

</body>