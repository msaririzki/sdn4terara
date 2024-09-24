<?php

class Blog extends Controller {
    public function index($page = 1) {
        $perPage = 6; // Jumlah berita per halaman
        $totalBerita = $this->model('Berita_model')->getTotalBerita();
        $totalPages = ceil($totalBerita / $perPage);
        $offset = ($page - 1) * $perPage;

        $data['berita'] = $this->model('Berita_model')->getBeritaByPage($perPage, $offset);
        $data['totalPages'] = $totalPages;
        $data['currentPage'] = $page;

        $this->view('templates/header');
        $this->view('blog/index', $data);
        $this->view('templates/footer');
    }
    public function blogsingle($id){
        $data = [
            'beritabaru' => $this->model('Berita_model')->getLimit(3), 
            'berita' =>  $this->model('Berita_model')->getBeritaById($id),
    ];
        $this->view('templates/header');
        $this->view('blog/blogsingle', $data);
        $this->view('templates/footer');
    }
}