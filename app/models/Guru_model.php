<?php

class Guru_model
{

    private $table = 'data_guru';
    private $db;
    public function __construct()
    {
        $this->db = new Database();
    }

    public function getLimit($jml)
    {
        $query = "SELECT * FROM " . $this->table . " ORDER BY id_guru DESC LIMIT :jml";
        $this->db->query($query);
        $this->db->bind(':jml', $jml, PDO::PARAM_INT);
        return $this->db->resultSet();  // gunakan resultSet() untuk mendapatkan hasil
    }

    public function getAll()
    {
        $this->db->query("SELECT * FROM " . $this->table);
        return $this->db->resultSet();
    }

    public function getGuruById($id)
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE id_guru= ' . $id); // Remove extra colon
        // $this->db->bind('id', $id);
        return $this->db->single();
    }


    public function tambah_guru($data, $gambar_guru)
    {
        // Query untuk memasukkan data guru
        $this->db->query('INSERT INTO data_guru (nama_guru, biografi_singkat, nip, jabatan, program_studi, universitas, alamat, no_hp, prestasi1, prestasi2, prestasi3, gambar_guru) VALUES (:nama_guru, :biografi_singkat, :nip, :jabatan, :program_studi, :universitas, :alamat, :no_hp, :prestasi1, :prestasi2, :prestasi3, :gambar_guru)');

        // Bind parameter
        $this->db->bind(':nama_guru', $data['namaGuru']);
        $this->db->bind(':biografi_singkat', $data['biografiSingkat']);
        $this->db->bind(':nip', $data['nip']);
        $this->db->bind(':jabatan', $data['jabatan']);
        $this->db->bind(':program_studi', $data['programStudi']);
        $this->db->bind(':universitas', $data['universitas']);
        $this->db->bind(':alamat', $data['alamat']);
        $this->db->bind(':no_hp', $data['noHp']);
        $this->db->bind(':prestasi1', $data['prestasi1']);
        $this->db->bind(':prestasi2', $data['prestasi2']);
        $this->db->bind(':prestasi3', $data['prestasi3']);
        $this->db->bind(':gambar_guru', $gambar_guru);

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




    public function upload()
    {
        $namaFile = $_FILES["gambarGuru"]["name"];
        $ukuranFile = $_FILES["gambarGuru"]["size"];
        $error = $_FILES["gambarGuru"]["error"];
        $tmpName = $_FILES["gambarGuru"]["tmp_name"];

        if ($error == 4) {
            echo "
                <script>alert('Upload Gambar Terlebih Dahulu')</script>
            ";
            return false;
        }
        $ektensiValid = ["jpg", "jpeg", "png"];
        $ekstensiFile = explode(".", $namaFile);
        $eks = strtolower(end($ekstensiFile));
        if (!in_array($eks, $ektensiValid)) {
            echo "
                <script>alert('Yang Anda Upload Bukan Gambar')</script>
            ";
            return false;
        }

        if ($ukuranFile > 5000000) {
            echo "
                <script>alert('Ukuran File Foto Terlalu Besar')</script>
            ";
            return false;
        }

        move_uploaded_file($tmpName, 'upload/' . $namaFile);
        return $namaFile;

    }

    public function deleteGuru($id)
    {
        $this->db->query('DELETE FROM data_guru WHERE id_guru = :id');
        $this->db->bind(':id', $id);

        $this->db->execute();
    }
    public function ubahGuru($id, $data, $gambar_guru = null)
    {
        // Jika tidak ada gambar yang diupload, kita tidak akan mengubah kolom gambar_guru
        if ($gambar_guru) {
            $query = 'UPDATE data_guru 
                      SET nama_guru = :nama_guru, biografi_singkat = :biografi_singkat, nip = :nip, 
                          jabatan = :jabatan, program_studi = :program_studi, universitas = :universitas, 
                          alamat = :alamat, no_hp = :no_hp, prestasi1 = :prestasi1, prestasi2 = :prestasi2, 
                          prestasi3 = :prestasi3, gambar_guru = :gambar_guru 
                      WHERE id_guru = :id';
        } else {
            $query = 'UPDATE data_guru 
                      SET nama_guru = :nama_guru, biografi_singkat = :biografi_singkat, nip = :nip, 
                          jabatan = :jabatan, program_studi = :program_studi, universitas = :universitas, 
                          alamat = :alamat, no_hp = :no_hp, prestasi1 = :prestasi1, prestasi2 = :prestasi2, 
                          prestasi3 = :prestasi3 
                      WHERE id_guru = :id';
        }

        // Query untuk memperbarui data guru
        $this->db->query($query);

        // Bind parameter
        $this->db->bind(':nama_guru', $data['namaGuru']);
        $this->db->bind(':biografi_singkat', $data['biografiSingkat']);
        $this->db->bind(':nip', $data['nip']);
        $this->db->bind(':jabatan', $data['jabatan']);
        $this->db->bind(':program_studi', $data['programStudi']);
        $this->db->bind(':universitas', $data['universitas']);
        $this->db->bind(':alamat', $data['alamat']);
        $this->db->bind(':no_hp', $data['noHp']);
        $this->db->bind(':prestasi1', $data['prestasi1']);
        $this->db->bind(':prestasi2', $data['prestasi2']);
        $this->db->bind(':prestasi3', $data['prestasi3']);
        $this->db->bind(':id', $id);

        if ($gambar_guru) {
            $this->db->bind(':gambar_guru', $gambar_guru);
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


    public function getTotalGuru()
    {
        $this->db->query("SELECT COUNT(*) as total FROM {$this->table}");
        return $this->db->single()['total'];
    }

    // Metode untuk mendapatkan berita dengan pagination
    public function getGuruByPage($limit, $offset)
    {
        $this->db->query("SELECT * FROM {$this->table} LIMIT :limit OFFSET :offset");
        $this->db->bind(':limit', $limit, PDO::PARAM_INT);
        $this->db->bind(':offset', $offset, PDO::PARAM_INT);
        return $this->db->resultSet();
    }
    public function search($query)
    {
        $this->db->query("SELECT * FROM data_guru WHERE nama_guru LIKE :query OR nip LIKE :query OR jabatan LIKE :query");
        $this->db->bind(':query', '%' . $query . '%');
        return $this->db->resultSet();
    }





}