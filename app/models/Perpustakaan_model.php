<?php

class Perpustakaan_model
{

    private $table = 'data_perpustakaan';
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAll()
    {
        $this->db->query("SELECT * FROM " . $this->table);
        return $this->db->resultSet();
    }

    public function getBukuById($id)
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE id_buku = :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function tambah_buku($data, $gambar_buku)
    {
        // Query to insert book data
        $this->db->query('INSERT INTO data_perpustakaan (judul_buku, link_buku, gambar_buku) VALUES (:judul_buku, :link_buku, :gambar_buku)');

        // Bind parameters
        $this->db->bind(':judul_buku', $data['judul_buku']);
        $this->db->bind(':link_buku', $data['link_buku']);
        $this->db->bind(':gambar_buku', $gambar_buku);

        try {
            // Execute query
            if ($this->db->execute()) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            // Handle exception
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function upload()
    {
        $namaFile = $_FILES["gambarBuku"]["name"];
        $ukuranFile = $_FILES["gambarBuku"]["size"];
        $error = $_FILES["gambarBuku"]["error"];
        $tmpName = $_FILES["gambarBuku"]["tmp_name"];

        if ($error == 4) {
            echo "<script>alert('Upload Gambar Terlebih Dahulu')</script>";
            return false;
        }

        $ektensiValid = ["jpg", "jpeg", "png"];
        $ekstensiFile = explode(".", $namaFile);
        $eks = strtolower(end($ekstensiFile));
        if (!in_array($eks, $ektensiValid)) {
            echo "<script>alert('Yang Anda Upload Bukan Gambar')</script>";
            return false;
        }

        if ($ukuranFile > 2000000) { // 2MB
            echo "<script>alert('Ukuran File Foto Terlalu Besar')</script>";
            return false;
        }

        move_uploaded_file($tmpName, 'upload/' . $namaFile);
        return $namaFile;
    }

    public function deleteBuku($id)
    {
        $this->db->query('DELETE FROM data_perpustakaan WHERE id_buku = :id');
        $this->db->bind(':id', $id);
        $this->db->execute();
    }

    public function updateBook($id, $data, $gambar_buku = null)
    {
        // If no image is uploaded, don't update the gambar_buku column
        if ($gambar_buku) {
            $query = 'UPDATE data_perpustakaan 
                      SET judul_buku = :judul_buku, link_buku = :link_buku, gambar_buku = :gambar_buku 
                      WHERE id_buku = :id';
        } else {
            $query = 'UPDATE data_perpustakaan 
                      SET judul_buku = :judul_buku, link_buku = :link_buku 
                      WHERE id_buku = :id';
        }

        // Query to update book data
        $this->db->query($query);

        // Bind parameters
        $this->db->bind(':judul_buku', $data['judulBuku']);
        $this->db->bind(':link_buku', $data['linkBuku']);
        $this->db->bind(':id', $id);

        if ($gambar_buku) {
            $this->db->bind(':gambar_buku', $gambar_buku);
        }

        try {
            // Execute query
            if ($this->db->execute()) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            // Handle exception
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function getTotalBooks()
    {
        $this->db->query("SELECT COUNT(*) as total FROM {$this->table}");
        return $this->db->single()['total'];
    }

    public function getBooksByPage($limit, $offset)
    {
        $this->db->query("SELECT * FROM {$this->table} LIMIT :limit OFFSET :offset");
        $this->db->bind(':limit', $limit, PDO::PARAM_INT);
        $this->db->bind(':offset', $offset, PDO::PARAM_INT);
        return $this->db->resultSet();
    }

    public function search($query)
    {
        $this->db->query("SELECT * FROM data_perpustakaan WHERE judul_buku LIKE :query");
        $this->db->bind(':query', '%' . $query . '%');
        return $this->db->resultSet();
    }
}
