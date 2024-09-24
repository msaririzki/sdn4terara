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
                            <a href="dashboard.php">
                                <i class="fas fa-home"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="data-siswa.php">
                                <i class="fas fa-user-graduate"></i>
                                <p>Data Siswa</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="data-guru.php">
                                <i class="fas fa-users"></i>
                                <p>Data Guru</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="data-berita.php">
                                <i class="fas fa-newspaper"></i>
                                <p>Berita</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="data-fasilitas.php">
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
                            <h3 class="fw-bold mb-3">Edit Buku</h3>
                            <h6 class="op-7 mb-2">Update informasi buku</h6>
                        </div>
                        <div class="ms-md-auto py-2 py-md-0">
                            <a class="btn btn-primary btn-round" href="<?= BASEURL; ?>/admin/dataperpustakaan">Kembali</a>
                        </div>
                    </div>
                    <!-- form data buku -->
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="<?= BASEURL; ?>/admin/updateBuku/<?= $data['buku']['id_buku']; ?>"
                                    method="POST" enctype="multipart/form-data">
                                    <input type="hidden" name="id_buku" value="<?= $data['buku']['id_buku']; ?>">
                                    <div class="form-group">
                                        <label for="judulBuku">Judul Buku</label>
                                        <input type="text" class="form-control" id="judulBuku" name="judulBuku"
                                            placeholder="Masukkan judul buku"
                                            value="<?= $data['buku']['judul_buku']; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="link_buku">Judul Buku</label>
                                        <input type="text" class="form-control" id="linkBuku" name="linkBuku"
                                            placeholder="Masukkan judul buku"
                                            value="<?= $data['buku']['link_buku']; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="gambarBuku">Foto</label>
                                        <input type="file" class="form-control" id="gambarBuku" name="gambarBuku"
                                            accept=".jpg, .jpeg, .png">
                                        <small class="form-text text-muted">Hanya format gambar jpg dan png dengan
                                            ukuran maksimal 2MB.</small>
                                        <?php if ($data['buku']['gambar_buku']): ?>
                                            <img src="<?= BASEURL . '/upload/' . $data['buku']['gambar_buku']; ?>"
                                                alt="Current Image" height="60" width="60">
                                        <?php endif; ?>
                                    </div>
                                    <button type="submit" class="btn btn-primary"
                                        onclick="return confirm('Yakin Ingin Ubah Data Buku ini?');">Ubah Data</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>