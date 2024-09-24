<?php

class Siswa_model{

    private $table = 'data_siswa';
    private $db;
    
    public function __construct(){
        $this->db = new Database();
    }

    public function getAll(){
        $this->db->query("SELECT * FROM " . $this->table);
        return $this->db->resultSet();
    }

    public function getSiswaById($id){
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE id_siswa= :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }
    public function tambah_siswa($data) {
        $this->db->query('INSERT INTO data_siswa (nama_siswa, nis_siswa, kelas, prestasi1_siswa, prestasi2_siswa, prestasi3_siswa, no_hp_wali, nama_wali, biografi_singkat_siswa, alamat) VALUES (:nama_siswa, :nis_siswa, :kelas, :prestasi1_siswa, :prestasi2_siswa, :prestasi3_siswa, :no_hp_wali, :nama_wali, :biografi_singkat_siswa, :alamat)');
        
        $this->db->bind(':nama_siswa', $data['namaSiswa']);
        $this->db->bind(':nis_siswa', $data['nis']);
        $this->db->bind(':kelas', $data['kelasSaatIni']);
        $this->db->bind(':prestasi1_siswa', $data['prestasiSiswa1']);
        $this->db->bind(':prestasi2_siswa', $data['prestasiSiswa2']);
        $this->db->bind(':prestasi3_siswa', $data['prestasiSiswa3']);
        $this->db->bind(':no_hp_wali', $data['noHpWali']);
        $this->db->bind(':nama_wali', $data['walimurid']);
        $this->db->bind(':biografi_singkat_siswa', $data['biografiSiswa']);
        $this->db->bind(':alamat', $data['alamatSiswa']);
        
        try {
            if ($this->db->execute()) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
    
    

    public function upload(){
        $namaFile = $_FILES["fotoUnit"]["name"];
        $ukuranFile = $_FILES["fotoUnit"]["size"];
        $error = $_FILES["fotoUnit"]["error"];
        $tmpName = $_FILES["fotoUnit"]["tmp_name"];
    
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
    
        if ($ukuranFile > 5000000) {
            echo "<script>alert('Ukuran File Foto Terlalu Besar')</script>";
            return false;
        }
    
        move_uploaded_file($tmpName, 'upload/' . $namaFile);
        return $namaFile;
    }

    public function deleteSiswa($id){
        $this->db->query('DELETE FROM data_siswa WHERE id_siswa = :id');
        $this->db->bind(':id', $id);
        $this->db->execute();
    }

    public function ubahSiswa($id, $data) {
        $query = 'UPDATE data_siswa 
                  SET nama_siswa = :nama_siswa, nis_siswa = :nis, kelas = :kelas, prestasi1_siswa = :prestasi1, prestasi2_siswa = :prestasi2, prestasi3_siswa = :prestasi3, no_hp_wali = :no_hp_wali, nama_wali = :nama_wali, biografi_singkat_siswa = :biografi_singkat_siswa, alamat = :alamat 
                  WHERE id_siswa = :id';
    
        $this->db->query($query);
        $this->db->bind(':nama_siswa', $data['namaSiswa']);
        $this->db->bind(':nis', $data['nis']);
        $this->db->bind(':kelas', $data['kelas']);
        $this->db->bind(':prestasi1', $data['prestasi1']);
        $this->db->bind(':prestasi2', $data['prestasi2']);
        $this->db->bind(':prestasi3', $data['prestasi3']);
        $this->db->bind(':no_hp_wali', $data['noHpWali']);
        $this->db->bind(':nama_wali', $data['namaWali']);
        $this->db->bind(':biografi_singkat_siswa', $data['biografiSingkat']);
        $this->db->bind(':alamat', $data['alamat']);
        $this->db->bind(':id', $id);
    
        try {
            if ($this->db->execute()) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
    

    public function getTotalSiswa() {
        $this->db->query("SELECT COUNT(*) as total FROM {$this->table}");
        return $this->db->single()['total'];
    }

    public function getSiswaByPage($limit, $offset) {
        $this->db->query("SELECT * FROM {$this->table} LIMIT :limit OFFSET :offset");
        $this->db->bind(':limit', $limit, PDO::PARAM_INT);
        $this->db->bind(':offset', $offset, PDO::PARAM_INT);
        return $this->db->resultSet();
    }

    public function search($query) {
        $this->db->query("SELECT * FROM data_siswa WHERE nama_siswa LIKE :query OR nis_siswa LIKE :query OR nama_wali LIKE :query OR alamat LIKE :query");
        $this->db->bind(':query', '%' . $query . '%');
        return $this->db->resultSet();
    }
}
