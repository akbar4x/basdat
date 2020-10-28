<?php
    require_once 'class_kegiatan.php';

    $objkegiatan = new Kegiatan();

    // tangkap request POST
    $_kode = $_POST['kode'];
    $_judul = $_POST['judul'];
    $_narasumber = $_POST['narasumber'];
    $_kategori = $_POST['kategori'];
    $_deksripsi = $_POST['deskripsi'];
    $_proses = $_POST['proses'];

    // buat array data
    $ar_data[] = $_kode; // ? ke-1 kode
    $ar_data[] = $_judul;// ? ke-2 judul
    $ar_data[] = $_narasumber;// ? ke-3 narsum
    $ar_data[] = $_kategori; // ? ke-4 kategori
    $ar_data[] = $_deksripsi;// ? ke-5 deskripsi

    // logik simpan , update atau hapus
    $row = 0 ; // baris eksekusi

    if($_proses == "Simpan"){
        $row = $objkegiatan->simpan($ar_data);
    }elseif ($_proses=="Update"){
        $_idedit = $_POST['idedit'];// tangkap idedit
        $ar_data[]= $_idedit;// ? ke-6 id (WHERE ID=?)
        $row = $objkegiatan->ubah($ar_data);
    }elseif ($_proses=="Hapus"){
        unset($ar_data);//hapus array
        $_idedit = $_POST['idedit'];// tangkap idedit
        $row = $objkegiatan->hapus($_idedit);
    }

    if ($row==0){
        echo "GAGAL PROSES !!";
    }else {
        //echo "PROSES SUKSES !!";
        // redirect page ke daftar_kegiatan.php
        header('Location:daftar_kegiatan.php');
    }
?>