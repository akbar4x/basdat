<?php
    require_once 'class_kegiatan.php';
    $objkegiatan = new Kegiatan();
    $_id = $_GET['id'];
    $data = $objkegiatan->findByID($_id);
?>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">View Kegiatan</h3>
            </div>
            <div class="panel-body">
                <table class="table">
                    <tr>
                        <td class="active">Kode</td>
                        <td>:</td>
                        <td><?php echo $data['kode']?></td>
                    </tr>
                    <tr>
                        <td class="active">Judul</td><td>:</td><td><?php echo
                        $data['judul']?></td>
                    </tr>
                    <tr>
                        <td class="active">Narasumber</td>
                        <td>:</td>
                        <td><?php echo $data['narasumber']?></td>
                    </tr>
                    <tr>
                        <td class="active">Deskripsi</td>
                        <td>:</td>
                        <td><?php echo $data['deskripsi']?></td>
                    </tr>
                </table>
            </div>
            <div class="panel-footer">
                <a class="btn icon-btn btn-success" href="form_kegiatan.php">
                    <span class="glyphicon btn-glyphicon glyphicon-plus img-circle text-success"></span>
                    Tambah Kegiatan
                </a>
            </div>
        </div>
    </div>
</div>