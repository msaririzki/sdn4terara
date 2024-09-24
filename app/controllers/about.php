<?php

class About extends Controller{
    public function index() {
        $data = [
            'berita' => $this->model('Berita_model')->getLimit(3),
            'guru' => $this->model('Guru_model')->getLimit(3),
            'totalguru' => $this->model('Guru_model')->getTotalGuru()
            ];
        $this->view('templates/header');
        $this->view('about/index',$data);
        $this->view('templates/footer');
 }
}