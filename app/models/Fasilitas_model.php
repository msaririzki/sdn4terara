<?php

class Fasilitas_model {

    private $table = 'fasilitas';
    private $db;

    public function __construct(){
        $this->db = new Database();
    }

    public function getAll() {
        $this->db->query("SELECT * FROM " . $this->table);
        return $this->db->resultSet();
    }

    public function getFasilitasById($id) {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE id_fasilitas = :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function tambah_fasilitas($data, $gambar_fasilitas) {
        // Query untuk memasukkan data fasilitas
        $this->db->query('INSERT INTO fasilitas (nama_fasilitas, kondisi, tahun_beli, jumlah, gambar_fasilitas) 
                          VALUES (:nama_fasilitas, :kondisi, :tahun_beli, :jumlah, :gambar_fasilitas)');
        
        // Bind parameter
        $this->db->bind(':nama_fasilitas', $data['nama_fasilitas']);
        $this->db->bind(':kondisi', $data['kondisi']);
        $this->db->bind(':tahun_beli', $data['tahun_beli']);
        $this->db->bind(':jumlah', $data['jumlah']);
        $this->db->bind(':gambar_fasilitas', $gambar_fasilitas);

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

    public function upload() {
        $namaFile = $_FILES["gambarFasilitas"]["name"];
        $ukuranFile = $_FILES["gambarFasilitas"]["size"];
        $error = $_FILES["gambarFasilitas"]["error"];
        $tmpName = $_FILES["gambarFasilitas"]["tmp_name"];

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

    public function deleteFasilitas($id) {
        $this->db->query('DELETE FROM data_fasilitas WHERE id_fasilitas = :id');
        $this->db->bind(':id', $id);

        $this->db->execute();
    }

    public function ubahFasilitas($id, $data, $gambar_fasilitas = null) {
        // Jika tidak ada gambar yang diupload, kita tidak akan mengubah kolom gambar_fasilitas
        if ($gambar_fasilitas) {
            $query = 'UPDATE fasilitas 
                      SET nama_fasilitas = :nama_fasilitas, kondisi = :kondisi, tahun_beli = :tahun_beli, 
                          jumlah = :jumlah, gambar_fasilitas = :gambar_fasilitas 
                      WHERE id_fasilitas = :id';
        } else {
            $query = 'UPDATE data_fasilitas 
                      SET nama_fasilitas = :nama_fasilitas, kondisi = :kondisi, tahun_beli = :tahun_beli, 
                          jumlah = :jumlah 
                      WHERE id_fasilitas = :id';
        }

        // Query untuk memperbarui data fasilitas
        $this->db->query($query);

        // Bind parameter
        $this->db->bind(':nama_fasilitas', $data['nama_fasilitas']);
        $this->db->bind(':kondisi', $data['kondisi']);
        $this->db->bind(':tahun_beli', $data['tahun_beli']);
        $this->db->bind(':jumlah', $data['jumlah']);
        $this->db->bind(':id', $id);

        if ($gambar_fasilitas) {
            $this->db->bind(':gambar_fasilitas', $gambar_fasilitas);
        }

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

    public function getTotalFasilitas() {
        $this->db->query("SELECT COUNT(*) as total FROM {$this->table}");
        return $this->db->single()['total'];
    }

    public function getFasilitasByPage($limit, $offset) {
        $this->db->query("SELECT * FROM {$this->table} LIMIT :limit OFFSET :offset");
        $this->db->bind(':limit', $limit, PDO::PARAM_INT);
        $this->db->bind(':offset', $offset, PDO::PARAM_INT);
        return $this->db->resultSet();
    }

    public function search($query) {
        $this->db->query("SELECT * FROM fasilitas WHERE nama_fasilitas LIKE :query OR kondisi LIKE :query OR tahun_beli LIKE :query");
        $this->db->bind(':query', '%' . $query . '%');
        return $this->db->resultSet();
    }
}
