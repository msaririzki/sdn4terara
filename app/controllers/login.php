<?php

class Login extends Controller {
    public function authenticate() {
        $username = $_POST['username'];
        $password = md5($_POST['password']); // Pastikan hashing password sesuai

        $userModel = $this->model('User_model');
        $user = $userModel->getUserByUsername($username);

        if ($user && $user['password'] === $password) {
            // Set session data
            $_SESSION['user_id'] = $user['id_user']; // Sesuaikan dengan nama field ID di tabel user
            $_SESSION['username'] = $user['username'];

            // Redirect to the dashboard
            header('Location: ' . BASEURL . '/admin/dashboard');
            exit;
        } else {
            // Handle login failure
            echo "<script>alert('invalid cred')</script>";
        }
    }

    public function logout() {
        echo "<script>alert('Logout')</script>";
        // Clear session data
        session_start();
        session_unset();
        session_destroy();
        header('Location: ' . BASEURL);
        exit;
    }
}
