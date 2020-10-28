<?php
    include_once 'dbkoneksi.php';

    $sql = "SELECT * FROM kegiatan";
    $rs = $dbh->query($sql);

?>

<table border="1" cellspacing="2" cellpadding="2">
    <thead>
        <tr>
            <th>No</th>
            <th>Judul</th>
            <th>Narasumber</th>
            <th>Biaya</th>
            <th>Tanggal Mulai</th>
            <th>Tanggal Akhir</th>
            <th>Tempat</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $nomor = 1;
            foreach($rs as $row)
            {
                echo '<tr>';
                echo '<td>'.$nomor.'</td>';
                echo '<td>'.$row['judul'].'</td>';
                echo '<td>'.$row['narasumber'].'</td>';
                echo '<td>'.$row['biaya'].'</td>';
                echo '<td>'.$row['tgl_mulai'].'</td>';
                echo '<td>'.$row['tgl_akhir'].'</td>';
                echo '<td>'.$row['tempat'].'</td>';
                echo '</tr>';
                $nomor++;
            }
        ?>
    </tbody>
</table>