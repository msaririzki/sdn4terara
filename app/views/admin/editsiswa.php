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
                    <a href="<?= BASEURL; ?>/dashboard" class="logo">
                        <img src="<?= BASEURL; ?>/images/logo-2.svg" alt="navbar brand" class="navbar-brand"
                            height="20" />
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
                            <a href="<?= BASEURL; ?>/dashboard">
                                <i class="fas fa-home"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        <li class="nav-item active">
                            <a href="<?= BASEURL; ?>/datasiswa">
                                <i class="fas fa-user-graduate"></i>
                                <p>Data Siswa</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= BASEURL; ?>/dataguru">
                                <i class="fas fa-users"></i>
                                <p>Data Guru</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= BASEURL; ?>/blog">
                                <i class="fas fa-newspaper"></i>
                                <p>Berita</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= BASEURL; ?>/datafasilitas">
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
                        <nav
                            class="navbar navbar-header-left navbar-expand-lg navbar-form nav-search p-0 d-none d-lg-flex">

                        </nav>
                    </div>
                </nav>
                <!-- End Navbar -->
            </div>
            <!-- end of this component -->
            <div class="container">
                <div class="page-inner">
                    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                        <div>
                            <h3 class="fw-bold mb-3">Data Siswa</h3>
                            <h6 class="op-7 mb-2">Lihat dan edit data siswa</h6>
                        </div>
                        <div class="ms-md-auto py-2 py-md-0">
                            <a class="btn btn-primary btn-round" href="#" data-bs-toggle="modal"
                                data-bs-target="#editSiswa">Edit Data Siswa</a>
                        </div>
                    </div>
                    <!-- Form Data Siswa -->
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="<?= BASEURL; ?>/admin/updateSiswa/<?= $data['siswa']['id_siswa']; ?>"
                                    method="POST" enctype="multipart/form-data">
                                    <input type="hidden" name="id_siswa" value="<?= $data['siswa']['id_siswa']; ?>">
                                    <div class="form-group">
                                        <label for="namaSiswa">Nama Siswa</label>
                                        <input type="text" class="form-control" id="namaSiswa" name="namaSiswa"
                                            placeholder="Masukkan nama siswa"
                                            value="<?= $data['siswa']['nama_siswa']; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="nis">NIS</label>
                                        <input type="text" class="form-control" id="nis" name="nis"
                                            placeholder="Masukkan NIS" value="<?= $data['siswa']['nis_siswa']; ?>"
                                            required>
                                    </div>
                                    <div class="form-group">
                                        <label for="kelas">Kelas</label>
                                        <input type="text" class="form-control" id="kelas" name="kelas"
                                            placeholder="Masukkan kelas" value="<?= $data['siswa']['kelas']; ?>"
                                            required>
                                    </div>
                                    <div class="form-group">
                                        <label for="prestasi1">Prestasi 1</label>
                                        <input type="text" class="form-control" id="prestasi1" name="prestasi1"
                                            placeholder="Masukkan prestasi 1"
                                            value="<?= $data['siswa']['prestasi1_siswa']; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="prestasi2">Prestasi 2</label>
                                        <input type="text" class="form-control" id="prestasi2" name="prestasi2"
                                            placeholder="Masukkan prestasi 2"
                                            value="<?= $data['siswa']['prestasi2_siswa']; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="prestasi3">Prestasi 3</label>
                                        <input type="text" class="form-control" id="prestasi3" name="prestasi3"
                                            placeholder="Masukkan prestasi 3"
                                            value="<?= $data['siswa']['prestasi3_siswa']; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="noHpWali">No. HP Wali</label>
                                        <input type="tel" class="form-control" id="noHpWali" name="noHpWali"
                                            placeholder="Masukkan no. HP wali"
                                            value="<?= $data['siswa']['no_hp_wali']; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="namaWali">Nama Wali</label>
                                        <input type="text" class="form-control" id="namaWali" name="namaWali"
                                            placeholder="Masukkan nama wali" value="<?= $data['siswa']['nama_wali']; ?>"
                                            required>
                                    </div>
                                    <div class="form-group">
                                        <label for="biografiSingkat">Biografi Singkat</label>
                                        <textarea class="form-control" id="biografiSingkat" name="biografiSingkat"
                                            placeholder="Masukkan biografi singkat"><?= $data['siswa']['biografi_singkat_siswa']; ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="alamat">Alamat</label>
                                        <input type="text" class="form-control" id="alamat" name="alamat"
                                            placeholder="Masukkan alamat" value="<?= $data['siswa']['alamat']; ?>"
                                            required>
                                    </div>
                                    <button type="submit" class="btn btn-primary"
                                        onclick="return confirm('Yakin Ingin Ubah Data Siswa ini?');">Ubah Data</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>