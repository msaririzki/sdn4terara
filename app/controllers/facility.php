<?php

class Facility extends Controller {
    public function index() {
        $data['fasilitas'] = $this->model('Fasilitas_model')->getAll();
        $this->view('templates/header');
        $this->view('facility/index', $data);
        $this->view('templates/footer');
    }
}