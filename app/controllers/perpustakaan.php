<?php


class Perpustakaan extends Controller {
    // public function index() {
    //     $data['perpustakaan'] = $this->model('Perpustakaan_model')->getAll();
    //     $this->view('templates/header');
    //     $this->view('perpustakaan/index', $data);
    //     $this->view('templates/footer');
    // }

    public function index($page = 1) {
        $perPage = 6; // Jumlah berita per halaman
        $totalBerita = $this->model('Perpustakaan_model')->getTotalBooks();
        $totalPages = ceil($totalBerita / $perPage);
        $offset = ($page - 1) * $perPage;

        $data['books'] = $this->model('Perpustakaan_model')->getBooksByPage($perPage, $offset);
        $data['totalPages'] = $totalPages;
        $data['currentPage'] = $page;

        $this->view('templates/header');
        $this->view('perpustakaan/index', $data);
        $this->view('templates/footer');
    }
}