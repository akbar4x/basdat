<?php
    include_once 'dbkoneksi.php';
    $_nomor = $_GET['no'];
    $sql = "SELECT * FROM vw_peserta WHERE nopeserta='$_nomor'";
    $st = $dbh->prepare($sql);
    $st->execute( [$_nomor] ) ;
    $row = $st->fetch();
    echo 'No Peserta : ' . $row['nopeserta'];
    echo '<br/>Nama Peserta : ' .$row['peserta'];
    echo '<br/>Email : ' .$row['email'];
    echo '<br/>Tanggal Daftar : ' .$row['tgl_daftar'];
    echo '<br/>Kegiatan : ' .$row['kegiatan'];
?>