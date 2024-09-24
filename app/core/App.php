<?php
class App {
    protected $controller = 'Home';
    protected $method = 'index';
    protected $param = [];

    public function __construct() {
        $url = $this->parseURL();

        // Pastikan $url[0] ada dan file controller-nya ada
        if (isset($url[0]) && file_exists('../app/controllers/' . $url[0] . '.php')) {
            $this->controller = $url[0];
            unset($url[0]);
        }

        require_once('../app/controllers/' . $this->controller . '.php');
        $this->controller = new $this->controller;

        // Pastikan $url[1] ada dan method-nya ada di controller
        if (isset($url[1]) && method_exists($this->controller, $url[1])) {
            $this->method = $url[1];
            unset($url[1]);
        }

        // Jika $url tidak kosong, set parameternya
        if (!empty($url)) {
            $this->param = array_values($url);
        }

        // Panggil method yang ditentukan dengan parameter yang ada
        call_user_func_array([$this->controller, $this->method], $this->param);
    }

    public function parseURL() {
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        }
        return []; // Selalu kembalikan array
    }
}
