<?php

class Student extends Controller {
    // public function index() {
    //     $data['siswa'] = $this->model('Siswa_model')->getAll();
    //     $this->view('templates/header');
    //     $this->view('student/index', $data);
    //     $this->view('templates/footer');
    // }
    public function index($page = 1) {
        $perPage = 20; // Jumlah berita per halaman
        $totalBerita = $this->model('Siswa_model')->getTotalSiswa();
        $totalPages = ceil($totalBerita / $perPage);
        $offset = ($page - 1) * $perPage;

        $data['siswa'] = $this->model('Siswa_model')->getSiswaByPage($perPage, $offset);
        $data['totalPages'] = $totalPages;
        $data['currentPage'] = $page;

        $this->view('templates/header');
        $this->view('student/index', $data);
        $this->view('templates/footer');
    }
    public function detail($id){
        $data['siswa'] = $this->model('Siswa_model')->getSiswaById($id);
        $this->view('templates/header');
        $this->view('student/detail', $data);
        $this->view('templates/footer');
    }
    public function searchSiswa($query = '') {
        if (!is_string($query) || !$query) {
            // Return to the student index page if no query is provided
            header('Location: ' . BASEURL . '/student/index');
            exit;
        }
    
        $data['siswa'] = $this->model('Siswa_model')->search($query);
        $this->view('templates/header');
        $this->view('student/index', $data);
        $this->view('templates/footer');
    }
    
}