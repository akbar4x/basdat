<?php
    require_once "class_dbkoneksi.php";
    
    class Kegiatan 
    {
        private $tableName = "kegiatan";
        private $koneksi = null ;
        
        public function __construct()
        {
            $database = new DBKoneksi();
            $this->koneksi = $database->getKoneksi();
        }
        
        public function getAll()
        {
            $sql = "SELECT * FROM " . $this->tableName;
            $ps = $this->koneksi->prepare($sql);
            $ps->execute();
            return $ps->fetchAll();
        }

        public function simpan($data)
        {
            $sql = "INSERT INTO ".$this->tableName." (id,kode,judul,narasumber,kategori_id,deskripsi) VALUES (default,?,?,?,?,?)";
            $ps = $this->koneksi->prepare($sql);
            $ps->execute($data);
            return $ps->rowCount(); // jika 1 sukses
        }

        public function ubah($data)
        {
            $sql = "UPDATE ".$this->tableName." SET kode=?,judul=?,narasumber=?,kategori_id=?deskripsi=? WHERE ID=?";
            $ps = $this->koneksi->prepare($sql);
            $ps->execute($data);
            return $ps->rowCount(); // jika 1 sukses
        }

        public function hapus($pk)
        {
            $sql = "DELETE FROM kegiatan WHERE id=?";
            $ps = $this->koneksi->prepare($sql);
            $ps->execute([$pk]);
            return $ps->rowCount(); // jika 1 sukses
        }

        public function findByID($pk)
        {
            $sql = "SELECT * FROM " . $this->tableName . " WHERE id=?";
            $ps = $this->koneksi->prepare($sql);
            $ps->execute([$pk]);
            return $ps->fetch();
        }            
    }
?>