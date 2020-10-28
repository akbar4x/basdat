<?php require_once 'class_kegiatan.php'; ?>

<h2>Daftar Kegiatan</h2>

<?php
    $obj_kegiatan = new Kegiatan();
    $rows = $obj_kegiatan->getAll();
?>

<table class="table">
    <thead>
        <tr class="active">
        <th>No</th><th>Kode</th><th>Judul Kegiatan</th>
        <th>Narasumber</th>
        <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $nomor = 1;
            foreach($rows as $row)
            {
                echo '<tr><td>'.$nomor.'</td>';
                echo '<td>'.$row['kode'].'</td>';
                echo '<td>'.$row['judul'].'</td>';
                echo '<td>'.$row['narasumber'].'</td>';
                echo '<td><a href="view_kegiatan.php?id='.$row['id']. '">View</a> |';
                echo '<a href="form_kegiatan.php?id='.$row['id']. '">Update</a></td>';
                echo '</tr>';
                $nomor++;
            }
        ?>
    </tbody>
</table>
