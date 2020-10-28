<?php
    error_reporting(0);
    require_once 'class_kegiatan.php';
    $obj_kegiatan = new Kegiatan();

    $_idedit = $_GET['id'];
    
    if(!empty($_idedit)){
        $data = $obj_kegiatan->findByID($_idedit);
    }else{
        $data = [] ; // array kosong data baru
    }
?>

<form class="form-horizontal" method="POST" action="proses_kegiatan.php">
    <fieldset>
        <!-- Form Name -->
        <legend>Form Entry Kegiatan</legend>

        <!-- Text input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="kode">Kode</label>
            <div class="col-md-2">                                
                <?php if (empty($_idedit)){ ?>
                    <input id="kode" name="kode" placeholder="Kode" class="form-control input-md" type="text">
                <?php } else { ?>
                    <input id="kode" name="kode" placeholder="Kode" class="form-control input-md" type="text" value="<?php echo $data['kode']?>">
                <?php } ?>  
            </div>
        </div>

        <!-- Text input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="judul">Judul Kegiatan</label>
            <div class="col-md-5">                                
                <?php if (empty($_idedit)){ ?>
                    <input id="judul" name="judul" placeholder="Judul Kegiatan" class="form-control input-md" type="text">
                <?php } else { ?>
                    <input id="judul" name="judul" placeholder="Judul Kegiatan" class="form-control input-md" type="text" value="<?php echo $data['judul']?>">
                <?php } ?>  
            </div>
        </div>

        <!-- Text input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="narasumber">Narasumber</label>
            <div class="col-md-4">
                <?php if (empty($_idedit)){ ?>
                    <input id="narasumber" name="narasumber" placeholder="Narasumber" class="form-control input-md" type="text">                
                <?php } else { ?>
                    <input id="narasumber" name="narasumber" placeholder="Narasumber" class="form-control input-md" type="text" value="<?php echo $data['narasumber']?>">
                <?php } ?>                             
            </div>
        </div>

        <!-- Select Basic -->
        <div class="form-group">
            <label class="col-md-4 control-label" for="kategori">Kategori</label>
            <div class="col-md-4">
                <select id="kategori" name="kategori" class="form-control">
                    <option value="1">Seminar</option>
                    <option value="2">Workshop</option>
                </select>
            </div>
        </div>

        <!-- Textarea -->
        <div class="form-group">
            <label class="col-md-4 control-label" for="deskripsi">Deskripsi Kegiatan</label>
            <div class="col-md-4">
                <?php if (empty($_idedit)){ ?>
                    <textarea class="form-control" id="deskripsi" name="deskripsi"></textarea>
                <?php } else { ?>
                    <textarea class="form-control" id="deskripsi" name="deskripsi"><?php echo $data['deskripsi']?></textarea>
                <?php } ?>                            
            </div>
        </div>

        <!-- Button (Double) -->
        <?php if (empty($_idedit)){ ?>
            <input type="submit" name="proses" class="btn btn-success" value="Simpan"/>
        <?php } else { ?>
            <input type="hidden" name="idedit" value="<?php echo $_idedit?>" />
            <input type="submit" name="proses" class="btn btn-primary" value="Update"/>
            <input type="submit" name="proses" class="btn btn-danger" value="Hapus"/>
        <?php } ?>
    </fieldset>    
</form>