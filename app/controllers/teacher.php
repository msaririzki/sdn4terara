<?php

class Teacher extends Controller {
    public function index($page=1){
        $perPage = 6; // Jumlah berita per halaman
        $totalGuru = $this->model('Guru_model')->getTotalGuru();
        $totalPages = ceil($totalGuru / $perPage);
        $offset = ($page - 1) * $perPage;

        $data['guru'] = $this->model('Guru_model')->getGuruByPage($perPage, $offset);
        $data['totalPages'] = $totalPages;
        $data['currentPage'] = $page;

        $this->view('templates/header');
        $this->view('teacher/index', $data);
        $this->view('templates/footer');
    }
    public function teachersingle($id){
        // $data['Guru'] = $this->model('Berita_model')->getBeritaById($id);
        $data['guru'] = $this->model('Guru_model')->getGuruById($id);
        $this->view('templates/header');
        $this->view('teacher/teachersingle', $data);
        $this->view('templates/footer');
    }
}