<?php
    include_once 'dbkoneksi.php';

    $sql = "SELECT * FROM vw_peserta";
    $rs = $dbh->query($sql);
?>

<table border="1" cellspacing="2" cellpadding="2">
    <thead>
        <tr>
            <th>No</th>
            <th>No Peserta</th>
            <th>Nama Peserta</th>
            <th>Email</th>
            <th>Kegiatan</th>
            <th>Tanggal Daftar</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $nomor = 1;
            foreach($rs as $row)
            {
                echo '<tr>';
                echo '<td name="no">'.$nomor.'</td>';
                echo '<td>'.$row['nopeserta'].'</td>';
                echo '<td>'.$row['peserta'].'</td>';
                echo '<td>'.$row['email'].'</td>';
                echo '<td>'.$row['kegiatan'].'</td>';
                echo '<td>'.$row['tgl_daftar'].'</td>';
                echo '<td> <a href="view_peserta.php?no='.$row['nopeserta'].'">View</a> </td>';
                echo '<td> <a href="#">Update</a> </td>';
                echo '<td> <a href="#">Delete</a> </td>';
                echo '</tr>';
                $nomor++;
            }
        ?>
    </tbody>
</table>