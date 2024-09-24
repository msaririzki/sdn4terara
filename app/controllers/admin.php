<?php

class Admin extends Controller
{
    public function __construct()
    {
        $this->checkLogin();
    }
    protected function checkLogin()
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . BASEURL);
            exit;
        }
    }

    public function dashboard($page = 1, $query = '')
    {
        // Pastikan $page adalah integer
        if (!is_numeric($page) || $page < 1) {
            $page = 1;
        }

        $perPage = 5; // Jumlah items per halaman, misalnya untuk users
        $totalUsers = $this->model('User_model')->getTotalUsers();
        $totalPages = ceil($totalUsers / $perPage);
        $offset = ($page - 1) * $perPage;

        // Pastikan $query adalah string
        if (!is_string($query)) {
            $query = '';
        }

        // Periksa apakah ada query pencarian
        if ($query) {
            $users = $this->model('User_model')->search($query);
        } else {
            $users = $this->model('User_model')->getUsersByPage($perPage, $offset);
        }

        // Dapatkan semua data dashboard
        $data = [
            'totalSiswa' => $this->model('Siswa_model')->getTotalSiswa(),
            'totalBerita' => $this->model('Berita_model')->getTotalBerita(),
            'totalGuru' => $this->model('Guru_model')->getTotalGuru(),
            'totalFasilitas' => $this->model('Fasilitas_model')->getTotalFasilitas(),
            'totalBooks' => $this->model('Perpustakaan_model')->getTotalBooks(),
            'totalUsers' => $totalUsers,
            'users' => $users,  // Users hasil pencarian atau pagination
            'totalPages' => $totalPages,
            'currentPage' => $page,
        ];

        $this->view('templates/adminheader');
        $this->view('admin/dashboard', $data);
        $this->view('templates/adminfooter');
    }

    public function searchdashboard($query = '')
    {
        // Jika query tidak diberikan, arahkan kembali ke databerita
        if (!is_string($query) || !$query) {
            header('Location: ' . BASEURL . '/admin/dashboard');
            exit;
        }

        $data['berita'] = $this->model('User_model')->search($query);
        $this->view('templates/adminheader');
        $this->view('admin/dashboard', $data);
        $this->view('templates/adminfooter');
    }


    public function search($query = '')
    {
        // Jika query tidak diberikan, arahkan kembali ke databerita
        if (!is_string($query) || !$query) {
            header('Location: ' . BASEURL . '/admin/databerita');
            exit;
        }

        $data['berita'] = $this->model('Berita_model')->search($query);
        $this->view('templates/adminheader');
        $this->view('admin/databerita', $data);
        $this->view('templates/adminfooter');
    }


    public function databerita($page = 1, $query = '')
    {
        // Pastikan $page adalah integer
        if (!is_numeric($page) || $page < 1) {
            $page = 1;
        }

        $perPage = 5; // Jumlah berita per halaman
        $totalBerita = $this->model('Berita_model')->getTotalBerita();
        $totalPages = ceil($totalBerita / $perPage);
        $offset = ($page - 1) * $perPage;

        // Pastikan $query adalah string
        if (!is_string($query)) {
            $query = '';
        }

        // Periksa apakah ada query pencarian
        if ($query) {
            $data['berita'] = $this->model('Berita_model')->search($query);
        } else {
            $data['berita'] = $this->model('Berita_model')->getBeritaByPage($perPage, $offset);
        }

        $data['totalPages'] = $totalPages;
        $data['currentPage'] = $page;

        $this->view('templates/adminheader');
        Flasher::flash();  // Panggil flasher disini
        $this->view('admin/databerita', $data);
        $this->view('templates/adminfooter');
    }




    public function tambahBerita()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Upload gambar
            $gambar_berita = $this->model('Berita_model')->upload();
            if ($gambar_berita) {
                // Tambah berita ke database
                if ($this->model('Berita_model')->tambah_berita($_POST, $gambar_berita) > 0) {
                    Flasher::setFlash('Berhasil', 'Ditambahkan', 'success');
                    header('Location: ' . BASEURL . '/admin/databerita');
                    exit;

                } else {
                    Flasher::setFlash('Gagal', 'Ditambahkan', 'danger');
                    header('Location: ' . BASEURL . '/admin/databerita');
                    exit;
                }
            } else {
                Flasher::setFlash('Gagal', 'Mengupload Gambar', 'danger');
                header('Location: ' . BASEURL . '/admin/databerita');
                exit;
            }

        } else {
            header('Location: ' . BASEURL . '/admin/databerita');
            exit;
        }
    }
    public function hapusBerita($id)
    {
        if ($this->model('Berita_model')->deleteBerita($id) > 0) {
            Flasher::setFlash('Berhasil', 'Dihapus', 'success');
            header('Location: ' . BASEURL . '/admin/databerita');
            exit;
        } else {
            Flasher::setFlash('Gagal', 'Dihapus', 'danger');
            header('Location: ' . BASEURL . '/admin/databerita');
            exit;
        }
    }

    public function editberita($id)
    {
        $data['berita'] = $this->model('Berita_model')->getBeritaById($id);

        if (empty($data['berita'])) {
            Flasher::setFlash('Data berita tidak ditemukan', '', 'danger');
            header('Location: ' . BASEURL . '/admin/databerita');
            exit;
        }

        $this->view('templates/adminheader');
        $this->view('admin/editberita', $data);
        $this->view('templates/adminfooter');
    }

    public function updateberita($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Mengambil data berita saat ini
            $berita = $this->model('Berita_model')->getBeritaById($id);

            // Memastikan data berita ada
            if (empty($berita)) {
                Flasher::setFlash('Data berita tidak ditemukan', '', 'danger');
                header('Location: ' . BASEURL . '/admin/databerita');
                exit;
            }

            // Menginisialisasi variabel gambar baru dengan gambar lama
            $gambar_berita_baru = $berita['gambar_berita'];

            // Memeriksa jika ada gambar baru yang diunggah
            if (isset($_FILES["gambarBerita"]) && $_FILES["gambarBerita"]["error"] == 0) {
                // Mengunggah gambar baru
                $uploaded_image = $this->model('Berita_model')->upload();
                if ($uploaded_image) {
                    $gambar_berita_baru = $uploaded_image;
                } else {
                    // Menangani kasus jika unggahan gambar gagal
                    Flasher::setFlash('Gagal', 'Mengupload Gambar', 'danger');
                    header('Location: ' . BASEURL . '/admin/databerita');
                    exit;
                }
            }

            // Melakukan update
            if ($this->model('Berita_model')->ubahBerita($id, $_POST, $gambar_berita_baru)) {
                Flasher::setFlash('Berhasil', 'Diubah', 'success');
            } else {
                Flasher::setFlash('Gagal', 'Diubah', 'danger');
            }

            header('Location: ' . BASEURL . '/admin/databerita');
            exit;
        } else {
            header('Location: ' . BASEURL . '/admin/databerita');
            exit;
        }
    }

    // end berita
    // start guru
    // public function dataguru() {
    //     $data['guru'] = $this->model('Guru_model')->getAll();
    //     $this->view('templates/adminheader');
    //     $this->view('admin/dataguru', $data);
    //     $this->view('templates/adminfooter');
    // }
    public function tambahGuru()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Upload gambar
            $gambar_guru = $this->model('Guru_model')->upload();
            var_dump($_POST);
            if ($gambar_guru) {
                // Tambah guru ke database
                if ($this->model('Guru_model')->tambah_guru($_POST, $gambar_guru) > 0) {
                    Flasher::setFlash('Berhasil', 'Ditambahkan', 'success');
                    header('Location: ' . BASEURL . '/admin/dataguru');
                    exit;

                } else {
                    Flasher::setFlash('Gagal', 'Ditambahkan', 'danger');
                    header('Location: ' . BASEURL . '/admin/dataguru');
                    exit;
                }
            } else {
                Flasher::setFlash('Gagal', 'Mengupload Gambar', 'danger');
                header('Location: ' . BASEURL . '/admin/dataguru');
                exit;
            }

        } else {
            header('Location: ' . BASEURL . '/admin/dataguru');
            exit;
        }
    }

    public function hapusGuru($id)
    {
        if ($this->model('Guru_model')->deleteGuru($id) > 0) {
            Flasher::setFlash('Berhasil', 'Dihapus', 'success');
            header('Location: ' . BASEURL . '/admin/dataguru');
            exit;
        } else {
            Flasher::setFlash('Gagal', 'Dihapus', 'danger');
            header('Location: ' . BASEURL . '/admin/dataguru');
            exit;
        }
    }
    public function editguru($id)
    {
        $data['guru'] = $this->model('Guru_model')->getGuruById($id);

        if (empty($data['guru'])) {
            Flasher::setFlash('Data Guru tidak ditemukan', '', 'danger');
            header('Location: ' . BASEURL . '/admin/dataguru');
            exit;
        }

        $this->view('templates/adminheader');
        $this->view('admin/editguru', $data);
        $this->view('templates/adminfooter');
    }
    public function updateguru($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Mengambil data guru saat ini
            $guru = $this->model('Guru_model')->getGuruById($id);

            // Memastikan data guru ada
            if (empty($guru)) {
                Flasher::setFlash('Data guru tidak ditemukan', '', 'danger');
                header('Location: ' . BASEURL . '/admin/dataguru');
                exit;
            }

            // Menginisialisasi variabel gambar baru dengan gambar lama
            $gambar_guru_baru = $guru['gambar_guru'];

            // Memeriksa jika ada gambar baru yang diunggah
            if (isset($_FILES["gambarGuru"]) && $_FILES["gambarGuru"]["error"] == 0) {
                // Mengunggah gambar baru
                $uploaded_image = $this->model('Guru_model')->upload();
                if ($uploaded_image) {
                    $gambar_guru_baru = $uploaded_image;
                } else {
                    // Menangani kasus jika unggahan gambar gagal
                    Flasher::setFlash('Gagal', 'Mengupload Gambar', 'danger');
                    header('Location: ' . BASEURL . '/admin/dataguru');
                    exit;
                }
            }

            // Melakukan update data guru
            if ($this->model('Guru_model')->ubahGuru($id, $_POST, $gambar_guru_baru)) {
                var_dump($_POST);
                Flasher::setFlash('Berhasil', 'Diubah', 'success');
            } else {
                Flasher::setFlash('Gagal', 'Diubah', 'danger');
            }

            header('Location: ' . BASEURL . '/admin/dataguru');
            exit;
        } else {
            header('Location: ' . BASEURL . '/admin/dataguru');
            exit;
        }
    }

    public function searchGuru($query = '')
    {
        // Jika query tidak diberikan, arahkan kembali ke dataguru
        if (!is_string($query) || !$query) {
            header('Location: ' . BASEURL . '/admin/dataguru');
            exit;
        }

        $data['guru'] = $this->model('Guru_model')->search($query);
        $this->view('templates/adminheader');
        $this->view('admin/dataguru', $data);
        $this->view('templates/adminfooter');
    }

    public function dataguru($page = 1, $query = '')
    {
        // Pastikan $page adalah integer
        if (!is_numeric($page) || $page < 1) {
            $page = 1;
        }

        $perPage = 5; // Jumlah guru per halaman
        $totalGuru = $this->model('Guru_model')->getTotalGuru();
        $totalPages = ceil($totalGuru / $perPage);
        $offset = ($page - 1) * $perPage;

        // Pastikan $query adalah string
        if (!is_string($query)) {
            $query = '';
        }

        // Periksa apakah ada query pencarian
        if ($query) {
            $data['guru'] = $this->model('Guru_model')->search($query);
        } else {
            $data['guru'] = $this->model('Guru_model')->getGuruByPage($perPage, $offset);
        }

        $data['totalPages'] = $totalPages;
        $data['currentPage'] = $page;

        $this->view('templates/adminheader');
        Flasher::flash();  // Panggil flasher disini
        $this->view('admin/dataguru', $data);
        $this->view('templates/adminfooter');
    }



    // end guru
    // start siswa
    // public function datasiswa() {
    //     $data['siswa'] = $this->model('Siswa_model')->getAll();
    //     $this->view('templates/adminheader');
    //     $this->view('admin/datasiswa',$data);
    //     $this->view('templates/adminfooter');
    // }
    public function datasiswa($page = 1, $query = '')
    {
        // Ensure $page is an integer
        if (!is_numeric($page) || $page < 1) {
            $page = 1;
        }

        $perPage = 5; // Number of students per page
        $totalSiswa = $this->model('Siswa_model')->getTotalSiswa();
        $totalPages = ceil($totalSiswa / $perPage);
        $offset = ($page - 1) * $perPage;

        // Ensure $query is a string
        if (!is_string($query)) {
            $query = '';
        }

        // Check if there's a search query
        if ($query) {
            $data['siswa'] = $this->model('Siswa_model')->search($query);
        } else {
            $data['siswa'] = $this->model('Siswa_model')->getSiswaByPage($perPage, $offset);
        }

        $data['totalPages'] = $totalPages;
        $data['currentPage'] = $page;

        $this->view('templates/adminheader');
        Flasher::flash();  // Display flash messages
        $this->view('admin/datasiswa', $data);
        $this->view('templates/adminfooter');
    }

    public function tambahSiswa()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Tambah siswa ke database tanpa mengunggah gambar
            if ($this->model('Siswa_model')->tambah_siswa($_POST) > 0) {
                Flasher::setFlash('Berhasil', 'Ditambahkan', 'success');
                header('Location: ' . BASEURL . '/admin/datasiswa');
                exit;
            } else {
                Flasher::setFlash('Gagal', 'Ditambahkan', 'danger');
                header('Location: ' . BASEURL . '/admin/datasiswa');
                exit;
            }
        } else {
            header('Location: ' . BASEURL . '/admin/datasiswa');
            exit;
        }
    }


    public function hapusSiswa($id)
    {
        if ($this->model('Siswa_model')->deleteSiswa($id) > 0) {
            Flasher::setFlash('Berhasil', 'Dihapus', 'success');
            header('Location: ' . BASEURL . '/admin/datasiswa');
            exit;
        } else {
            Flasher::setFlash('Gagal', 'Dihapus', 'danger');
            header('Location: ' . BASEURL . '/admin/datasiswa');
            exit;
        }
    }

    public function editSiswa($id)
    {
        $data['siswa'] = $this->model('Siswa_model')->getSiswaById($id);

        if (empty($data['siswa'])) {
            Flasher::setFlash('Data siswa tidak ditemukan', '', 'danger');
            header('Location: ' . BASEURL . '/admin/datasiswa');
            exit;
        }

        $this->view('templates/adminheader');
        $this->view('admin/editsiswa', $data);
        $this->view('templates/adminfooter');
    }

    public function updateSiswa($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Get current student data
            $siswa = $this->model('Siswa_model')->getSiswaById($id);

            // Ensure student data exists
            if (empty($siswa)) {
                Flasher::setFlash('Data siswa tidak ditemukan', '', 'danger');
                header('Location: ' . BASEURL . '/admin/datasiswa');
                exit;
            }

            // Perform the update
            if ($this->model('Siswa_model')->ubahSiswa($id, $_POST)) {
                Flasher::setFlash('Berhasil', 'Diubah', 'success');
            } else {
                Flasher::setFlash('Gagal', 'Diubah', 'danger');
            }

            header('Location: ' . BASEURL . '/admin/datasiswa');
            exit;
        } else {
            header('Location: ' . BASEURL . '/admin/datasiswa');
            exit;
        }
    }


    public function searchSiswa($query = '')
    {
        if (!is_string($query) || !$query) {
            header('Location: ' . BASEURL . '/admin/datasiswa');
            exit;
        }

        $data['siswa'] = $this->model('Siswa_model')->search($query);
        $this->view('templates/adminheader');
        $this->view('admin/datasiswa', $data);
        $this->view('templates/adminfooter');
    }

    // end siswa
    //start perpustakaan
    public function dataperpustakaan($page = 1, $query = '')
    {
        // Ensure $page is an integer
        if (!is_numeric($page) || $page < 1) {
            $page = 1;
        }

        $perPage = 5; // Number of library records per page
        $totalPerpustakaan = $this->model('Perpustakaan_model')->getTotalBooks();
        $totalPages = ceil($totalPerpustakaan / $perPage);
        $offset = ($page - 1) * $perPage;

        // Ensure $query is a string
        if (!is_string($query)) {
            $query = '';
        }

        // Check if there's a search query
        if ($query) {
            $data['buku'] = $this->model('Perpustakaan_model')->search($query);
        } else {
            $data['buku'] = $this->model('Perpustakaan_model')->getBooksByPage($perPage, $offset);
        }

        $data['totalPages'] = $totalPages;
        $data['currentPage'] = $page;

        $this->view('templates/adminheader');
        Flasher::flash();  // Display flash messages
        $this->view('admin/dataperpustakaan', $data);
        $this->view('templates/adminfooter');
    }

    // public function dataperpustakaan() {
    //     $data['buku'] = $this->model('Perpustakaan_model')->getAll();
    //     $this->view('templates/adminheader');
    //     $this->view('admin/dataperpustakaan', $data);
    //     $this->view('templates/adminfooter');
    // }
    public function searchBuku($query = '')
    {
        if (!is_string($query) || !$query) {
            header('Location: ' . BASEURL . '/admin/dataperpustakaan');
            exit;
        }

        $data['buku'] = $this->model('Perpustakaan_model')->search($query);
        $this->view('templates/adminheader');
        $this->view('admin/dataperpustakaan', $data);
        $this->view('templates/adminfooter');
    }
    public function tambahBuku()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Upload gambar
            $gambar_buku = $this->model('Perpustakaan_model')->upload();
            var_dump($_POST);
            if ($gambar_buku) {
                // Tambah guru ke database
                if ($this->model('Perpustakaan_model')->tambah_buku($_POST, $gambar_buku) > 0) {
                    Flasher::setFlash('Berhasil', 'Ditambahkan', 'success');
                    header('Location: ' . BASEURL . '/admin/dataperpustakaan');
                    exit;

                } else {
                    Flasher::setFlash('Gagal', 'Ditambahkan', 'danger');
                    header('Location: ' . BASEURL . '/admin/dataperpustakaan');
                    exit;
                }
            } else {
                Flasher::setFlash('Gagal', 'Mengupload Gambar', 'danger');
                header('Location: ' . BASEURL . '/admin/dataperpustakaan');
                exit;
            }

        } else {
            header('Location: ' . BASEURL . '/admin/datapeprustakaan');
            exit;
        }
    }

    public function editperpustakaan($id)
    {
        $data['buku'] = $this->model('Perpustakaan_model')->getBukuById($id);

        if (empty($data['buku'])) {
            Flasher::setFlash('Data Guru tidak ditemukan', '', 'danger');
            header('Location: ' . BASEURL . '/admin/dataguru');
            exit;
        }

        $this->view('templates/adminheader');
        $this->view('admin/editperpustakaan', $data);
        $this->view('templates/adminfooter');
    }

    public function updateBuku($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Get current book data
            $buku = $this->model('Perpustakaan_model')->getBukuById($id);

            // Ensure book data exists
            if (empty($buku)) {
                Flasher::setFlash('Data buku tidak ditemukan', '', 'danger');
                header('Location: ' . BASEURL . '/admin/dataperpustakaan');
                exit;
            }

            // Initialize new image variable with the old image
            $gambar_buku_baru = $buku['gambar_buku'];

            // Check if a new image is uploaded
            if (isset($_FILES["gambarBuku"]) && $_FILES["gambarBuku"]["error"] == 0) {
                // Upload new image
                $uploaded_image = $this->model('Perpustakaan_model')->upload();
                if ($uploaded_image) {
                    $gambar_buku_baru = $uploaded_image;
                } else {
                    // Handle case where image upload fails
                    Flasher::setFlash('Gagal', 'Mengupload Gambar', 'danger');
                    header('Location: ' . BASEURL . '/admin/dataperpustakaan');
                    exit;
                }
            }

            // Perform the update
            if ($this->model('Perpustakaan_model')->updateBook($id, $_POST, $gambar_buku_baru)) {
                Flasher::setFlash('Berhasil', 'Diubah', 'success');
            } else {
                Flasher::setFlash('Gagal', 'Diubah', 'danger');
            }

            header('Location: ' . BASEURL . '/admin/dataperpustakaan');
            exit;
        } else {
            header('Location: ' . BASEURL . '/admin/dataperpustakaan');
            exit;
        }
    }

    public function hapusBuku($id)
    {
        if ($this->model('Perpustakaan_model')->deleteBuku($id) > 0) {
            Flasher::setFlash('Berhasil', 'Dihapus', 'success');
            header('Location: ' . BASEURL . '/admin/dataperpustakaan');
            exit;
        } else {
            Flasher::setFlash('Gagal', 'Dihapus', 'danger');
            header('Location: ' . BASEURL . '/admin/dataperpustakaan');
            exit;
        }
    }


    //end perpustakaan 

    //   start fasilitas
    public function searchfasilitas($query = '')
    {
        // Jika query tidak diberikan, arahkan kembali ke databerita
        if (!is_string($query) || !$query) {
            header('Location: ' . BASEURL . '/admin/datafasilitas');
            exit;
        }

        $data['berita'] = $this->model('Fasilitas_model')->search($query);
        $this->view('templates/adminheader');
        $this->view('admin/datafasilitas', $data);
        $this->view('templates/adminfooter');
    }
    public function datafasilitas($page = 1, $query = '')
    {
        // Pastikan $page adalah integer
        if (!is_numeric($page) || $page < 1) {
            $page = 1;
        }

        $perPage = 5; // Jumlah berita per halaman
        $totalFasilitas = $this->model('Fasilitas_model')->getTotalFasilitas();
        $totalPages = ceil($totalFasilitas / $perPage);
        $offset = ($page - 1) * $perPage;

        // Pastikan $query adalah string
        if (!is_string($query)) {
            $query = '';
        }

        // Periksa apakah ada query pencarian
        if ($query) {
            $data['fasilitas'] = $this->model('Fasilitas_model')->search($query);
        } else {
            $data['fasilitas'] = $this->model('Fasilitas_model')->getFasilitasByPage($perPage, $offset);
        }

        $data['totalPages'] = $totalPages;
        $data['currentPage'] = $page;

        $this->view('templates/adminheader');
        Flasher::flash();  // Panggil flasher disini
        $this->view('admin/datafasilitas', $data);
        $this->view('templates/adminfooter');
    }

    // public function datafasilitas() {
    //     $data['fasilitas'] = $this->model('Fasilitas_model')->getAll();
    //     $this->view('templates/adminheader');
    //     $this->view('admin/datafasilitas', $data);
    //     $this->view('templates/adminfooter');
    // }
    public function tambahFasilitas()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Upload gambar
            $gambar_fasilitas = $this->model('Fasilitas_model')->upload();
            if ($gambar_fasilitas) {
                // Tambah berita ke database
                if ($this->model('Fasilitas_model')->tambah_fasilitas($_POST, $gambar_fasilitas) > 0) {
                    Flasher::setFlash('Berhasil', 'Ditambahkan', 'success');
                    header('Location: ' . BASEURL . '/admin/datafasilitas');
                    exit;

                } else {
                    Flasher::setFlash('Gagal', 'Ditambahkan', 'danger');
                    header('Location: ' . BASEURL . '/admin/datafasilitas');
                    exit;
                }
            } else {
                Flasher::setFlash('Gagal', 'Mengupload Gambar', 'danger');
                header('Location: ' . BASEURL . '/admin/datafasilitas');
                exit;
            }

        } else {
            header('Location: ' . BASEURL . '/admin/datafasilitas');
            exit;
        }
    }

    public function editfasilitas($id)
    {
        $data['fasilitas'] = $this->model('Fasilitas_model')->getFasilitasById($id);

        if (empty($data['fasilitas'])) {
            Flasher::setFlash('Data Fasilitas tidak ditemukan', '', 'danger');
            header('Location: ' . BASEURL . '/admin/datafasilitas');
            exit;
        }

        $this->view('templates/adminheader');
        $this->view('admin/editfasilitas', $data);
        $this->view('templates/adminfooter');
    }
    public function updatefasilitas($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Mengambil data fasilitas saat ini
            $fasilitas = $this->model('Fasilitas_model')->getFasilitasById($id);

            // Memastikan data fasilitas ada
            if (empty($fasilitas)) {
                Flasher::setFlash('Data fasilitas tidak ditemukan', '', 'danger');
                header('Location: ' . BASEURL . '/admin/datafasilitas');
                exit;
            }

            // Menginisialisasi variabel gambar baru dengan gambar lama
            $gambar_fasilitas_baru = $fasilitas['gambar_fasilitas'];

            // Memeriksa jika ada gambar baru yang diunggah
            if (isset($_FILES["gambarFasilitas"]) && $_FILES["gambarFasilitas"]["error"] == 0) {
                // Mengunggah gambar baru
                $uploaded_image = $this->model('Fasilitas_model')->upload();
                if ($uploaded_image) {
                    $gambar_fasilitas_baru = $uploaded_image;
                } else {
                    // Menangani kasus jika unggahan gambar gagal
                    Flasher::setFlash('Gagal', 'Mengupload Gambar', 'danger');
                    header('Location: ' . BASEURL . '/admin/datafasilitas');
                    exit;
                }
            }

            // Melakukan update data fasilitas
            if ($this->model('Fasilitas_model')->ubahFasilitas($id, $_POST, $gambar_fasilitas_baru)) {
                Flasher::setFlash('Berhasil', 'Diubah', 'success');
            } else {
                Flasher::setFlash('Gagal', 'Diubah', 'danger');
            }

            header('Location: ' . BASEURL . '/admin/datafasilitas');
            exit;
        } else {
            header('Location: ' . BASEURL . '/admin/datafasilitas');
            exit;
        }
    }

    // end fasilitas

    // login

    public function tambahUser()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $namauser = $_POST['namauser'];
            $username = $_POST['username'];
            $password = $_POST['password'];

            // Pastikan password di-hash sebelum disimpan
            $hashedPassword = md5($password);

            // Panggil fungsi tambahUser di User_model
            if ($this->model('User_model')->tambahUser($namauser, $username, $hashedPassword)) {
                // Redirect atau berikan pesan sukses
                header('Location: ' . BASEURL . '/admin/dashboard');
                exit;
            } else {
                // Berikan pesan error jika gagal
                echo "Gagal menambahkan user baru.";
            }
        }
    }

    public function hapusUser($id)
    {
        if ($this->model('User_model')->deleteUser($id) > 0) {
            Flasher::setFlash('Berhasil', 'Dihapus', 'success');
            header('Location: ' . BASEURL . '/admin/dashboard');
            exit;
        } else {
            Flasher::setFlash('Gagal', 'Dihapus', 'danger');
            header('Location: ' . BASEURL . '/admin/dashboard');
            exit;
        }
    }

    public function updateUser($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $namauser = $_POST['namauser'];
            $username = $_POST['username'];
            $password = $_POST['password'];

            // Periksa apakah password perlu diubah
            if (!empty($password)) {
                $hashedPassword = md5($password);
                $data = [
                    'nama_user' => $namauser,
                    'username' => $username,
                    'password' => $hashedPassword
                ];
            } else {
                $data = [
                    'nama_user' => $namauser,
                    'username' => $username
                    // Password tidak diubah
                ];
            }

            // Panggil fungsi ubahUser di User_model
            if ($this->model('User_model')->ubahUser($id, $data)) {
                // Redirect atau berikan pesan sukses
                header('Location: ' . BASEURL . '/admin/dashboard');
                exit;
            } else {
                // Berikan pesan error jika gagal
                echo "Gagal mengupdate user.";
            }
        } else {
            // Jika tidak menggunakan metode POST, tampilkan form update
            $data['user'] = $this->model('User_model')->getUserById($id);

            $this->view('templates/adminheader');
            $this->view('admin/updateuser', $data);
            $this->view('templates/adminfooter');
        }
    }


    public function login()
    {
        // Jika form di-submit dengan metode POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'];
            $password = md5($_POST['password']); // Menggunakan MD5 untuk hashing password

            // Memanggil model untuk mendapatkan user berdasarkan username
            $user = $this->model('User_model')->getUserByUsername($username);

            if ($user) {
                // Memeriksa apakah password cocok
                if ($password === $user['password']) {
                    // Login berhasil, simpan informasi user ke session
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['username'] = $user['username'];

                    // Redirect ke dashboard admin
                    header('Location: ' . BASEURL . '/admin/dashboard');
                    exit;
                } else {
                    // Password salah, set flash message
                    Flasher::setFlash('Login gagal', 'Password salah', 'danger');
                }
            } else {
                // User tidak ditemukan, set flash message
                Flasher::setFlash('Login gagal', 'Username tidak ditemukan', 'danger');
            }

            // Redirect kembali ke halaman login
            header('Location: ' . BASEURL . '');
            exit;
        }

        // Menampilkan halaman login
        $this->view('admin/login');
    }

    public function logout()
    {
        // Menghapus semua data session
        session_unset();
        session_destroy();

        // Redirect ke halaman login
        header('Location: ' . BASEURL . '/admin/login');
        exit;
    }
    // end login

}



