<?php

class Controller {

    protected function checkLogin() {
        if (!isset($_SESSION['user_id'])) { // Ganti 'id_user' dengan 'user_id'
            header('Location: ' . BASEURL); // Arahkan ke halaman login jika belum login
            exit;
        }
    }
    public function view($view, $data = []) {
        require_once('../app/views/' . $view . '.php');
    }
    public function model($model) {
        require_once('../app/models/'. $model. '.php');
        return new $model();
    }
}
