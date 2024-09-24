<?php 

class Home extends Controller {
       public function index(){
       $data = [
              'berita' => $this->model('Berita_model')->getLimit(3),
              'guru' => $this->model('Guru_model')->getLimit(3),
              ];
        $this->view('templates/header');
        $this->view('home/index',$data);
        $this->view('templates/footer');
       }
       
}