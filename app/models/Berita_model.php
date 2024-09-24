<?php

class Berita_model{

    private $table = 'berita';
    private $db;
    public function __construct(){
        $this->db = new Database();
    }


    public function getAll(){
        $this->db->query("SELECT * FROM " . $this->table);
        return $this->db->resultSet();
    }

    public function getLimit($jml) {
        $query = "SELECT * FROM " . $this->table . " ORDER BY id_berita DESC LIMIT :jml";
        $this->db->query($query);
        $this->db->bind(':jml', $jml, PDO::PARAM_INT);
        return $this->db->resultSet();  // gunakan resultSet() untuk mendapatkan hasil
    }
    
    

    public function getBeritaById($id){
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE id_berita= ' . $id); // Remove extra colon
        // $this->db->bind('id', $id);
        return $this->db->single();
    }
  

    public function tambah_berita($data, $gambar_berita) {
        // Query untuk memasukkan berita
        $this->db->query('INSERT INTO berita (judul_berita, isi_berita, waktu_pembuatan, gambar_berita) VALUES (:judul_berita, :isi_berita, CURDATE(), :gambar_berita)');
        
        // Bind parameter
        $this->db->bind(':judul_berita', $data['judulBerita']);
        $this->db->bind(':isi_berita', $data['isiBerita']);
        $this->db->bind(':gambar_berita', $gambar_berita);
        
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
    

    public function upload(){
        $namaFile = $_FILES["gambarBerita"]["name"];
        $ukuranFile = $_FILES["gambarBerita"]["size"];
        $error = $_FILES["gambarBerita"]["error"];
        $tmpName = $_FILES["gambarBerita"]["tmp_name"];
    
        if( $error == 4 ){
            echo "
                <script>alert('Upload Gambar Terlebih Dahulu')</script>
            ";
            return false;
        }
        $ektensiValid = ["jpg", "jpeg", "png"];
        $ekstensiFile = explode(".", $namaFile);
        $eks = strtolower(end($ekstensiFile));
        if(!in_array($eks, $ektensiValid)){
            echo "
                <script>alert('Yang Anda Upload Bukan Gambar')</script>
            ";
            return false;
        }
    
        if($ukuranFile > 5000000){
            echo "
                <script>alert('Ukuran File Foto Terlalu Besar')</script>
            ";
            return false;
        }
    
        move_uploaded_file($tmpName,  'upload/' . $namaFile);
        return $namaFile;
    
    }

    public function deleteBerita($id){
        $this->db->query('DELETE FROM berita WHERE id_berita = :id');
        $this->db->bind(':id', $id);

        $this->db->execute();

        // if($this->db->execute()){
        //     return true;
        // } else {
        //     return false;
        // }
    }
    public function ubahBerita($id, $data, $gambar_berita = null) {
        // Jika tidak ada gambar yang diupload, kita tidak akan mengubah kolom gambar_berita
        if ($gambar_berita) {
            $query = 'UPDATE berita SET judul_berita = :judul_berita, isi_berita = :isi_berita, gambar_berita = :gambar_berita WHERE id_berita = :id';
        } else {
            $query = 'UPDATE berita SET judul_berita = :judul_berita, isi_berita = :isi_berita WHERE id_berita = :id';
        }
    
        // Query untuk memperbarui berita
        $this->db->query($query);
    
        // Bind parameter
        $this->db->bind(':judul_berita', $data['judulBerita']);
        $this->db->bind(':isi_berita', $data['isiBerita']);
        $this->db->bind(':id', $id);
    
        if ($gambar_berita) {
            $this->db->bind(':gambar_berita', $gambar_berita);
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
    
    public function getTotalBerita() {
        $this->db->query("SELECT COUNT(*) as total FROM {$this->table}");
        return $this->db->single()['total'];
    }

    // Metode untuk mendapatkan berita dengan pagination
    public function getBeritaByPage($limit, $offset) {
        $this->db->query("SELECT * FROM {$this->table} LIMIT :limit OFFSET :offset");
        $this->db->bind(':limit', $limit, PDO::PARAM_INT);
        $this->db->bind(':offset', $offset, PDO::PARAM_INT);
        return $this->db->resultSet();
    }
    public function search($query)
    {
        $this->db->query("SELECT * FROM berita WHERE judul_berita LIKE :query OR isi_berita LIKE :query");
        $this->db->bind(':query', '%' . $query . '%');
        return $this->db->resultSet();
    }
    

    
}