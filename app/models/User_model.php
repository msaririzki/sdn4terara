<?php

class User_model {
    private $table = 'user';
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getAll() {
        $this->db->query("SELECT * FROM " . $this->table);
        return $this->db->resultSet();
    }

    public function getUserById($id) {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE id_user = :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }
    public function getUserByUsername($username) {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE username = :username');
        $this->db->bind(':username', $username);
        return $this->db->single();
    }
    public function getUsersByPage($limit, $offset) {
        $this->db->query("SELECT * FROM {$this->table} LIMIT :limit OFFSET :offset");
        $this->db->bind(':limit', $limit, PDO::PARAM_INT);
        $this->db->bind(':offset', $offset, PDO::PARAM_INT);
        return $this->db->resultSet();
    }

    public function tambahUser($namauser, $username, $password) {
        $this->db->query('INSERT INTO ' . $this->table . ' (username, password, nama_user) 
                          VALUES (:username, :password, :nama_user)');
        
        // Bind parameter
        $this->db->bind(':username', $username);
        $this->db->bind(':password', $password);
        $this->db->bind(':nama_user', $namauser); // Perbaikan di sini
    
        try {
            // Eksekusi query
            if ($this->db->execute()) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            // Menangani exception
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
    

    public function ubahUser($id, $data) {
        // Hash password dengan MD5 jika password diubah
        $query = 'UPDATE ' . $this->table . ' 
                  SET username = :username, nama_user = :nama_user' . 
                  (isset($data['password']) ? ', password = :password' : '') . 
                  ' WHERE id_user = :id';

        // Query untuk memperbarui data user
        $this->db->query($query);

        // Bind parameter
        $this->db->bind(':username', $data['username']);
        $this->db->bind(':nama_user', $data['namauser']);
        if (isset($data['password'])) {
            $this->db->bind(':password', md5($data['password']));
        }
        $this->db->bind(':id', $id);

        try {
            // Eksekusi query
            if ($this->db->execute()) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            // Menangani exception
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function deleteUser($id) {
        $this->db->query('DELETE FROM ' . $this->table . ' WHERE id_user = :id');
        $this->db->bind(':id', $id);
        $this->db->execute();
    }

    public function search($query) {
        $this->db->query("SELECT * FROM " . $this->table . " WHERE username LIKE :query OR nama_user LIKE :query");
        $this->db->bind(':query', '%' . $query . '%');
        return $this->db->resultSet();
    }

    public function getTotalUsers() {
        $this->db->query("SELECT COUNT(*) as total FROM " . $this->table);
        return $this->db->single()['total'];
    }
}
