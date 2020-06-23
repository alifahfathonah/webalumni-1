<title> Komunitas </title>

<!-- START BREADCRUMB -->

<!-- END BREADCRUMB -->

<br>
<br>
<br>
<br>
<ul class="breadcrumb">
    <li>Komunitas</li>
    <li class="active"><a href="<?= base_url('anggota/Komunitas'); ?>">Lihat Komunitas</a></li>
</ul>

<?= showFlashMessage(); ?>

<!-- PAGE CONTENT WRAP -->
<div class="page-content-wrap">
    
    <!-- SEARCH -->
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <p>Cari Komunitas</p>
                    <form action="<?= base_url('anggota/Komunitas/cariStatusKomunitas'); ?>" method="post">
                        <div class="form-group">
                            <div class="col-md-10">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <span class="fa fa-search"></span>
                                    </div>
                                    <input type="text" class="form-control" name="namaKomunitas" placeholder="Komunitas mana yang akan anda cari ?">
                                    <div class="input-group-btn">
                                        <button type="submit" class="btn btn-primary">Search</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-2">
                                <a href="<?= base_url('anggota/Komunitas'); ?>" class="btn btn-primary">Reset Search</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- SEARCH -->

    <!-- KOMUNITAS CONTENT -->
    <div class="row">
        <?php foreach ($komunitas as $A) { ?>
            <?php if ($A->stat_komunitas == 1): ?>
        <div class="col-md-4    ">
            <div class="panel panel-default">
                <div class="panel-body profile">
                    <div class="profile-image">
                        <?php if ($A->logo_komunitas == NULL) { ?>
                            <img src="<?php echo base_url('uploads/content/komunitas/no-image.jpg'); ?> " alt="No Image" title="Default Image">
                        <?php } else { ?>
                            <img src="<?php echo base_url('uploads/content/komunitas/'.$A->logo_komunitas); ?> " alt="<?= $A->nama_komunitas; ?>" title="<?= $A->nama_komunitas; ?>">
                        <?php } ?>
                    </div>
                    <div class="profile-data">
                        <div class="profile-data-name"><h3 style="color:white;"><?= $A->nama_komunitas; ?><h3></div>
                    </div>
                   
                </div>
                    <div class="panel-body">
                        <div class="contact-info">
                            <h3>Tentang Komunitas ini</h3>
                            <p> <?= $A->deskripsi_komunitas ?></p>
                    <div class="panel-body">
                        <div class="contact-info">
                            <p><i class="fa fa-link" aria-hidden="true"></i> <strong>Link Komunitas</strong><br><h5><a><?= $A->tautat_komunitas; ?></a></h5></p>
                                
                                <?php if ($A->sifat_komunitas == "Publik") { ?>
                            <p><i class="fa fa-eye" aria-hidden="true"></i> <strong> <?= $A->sifat_komunitas ?> </strong><br><h5>Semua orang bisa join ke komunitas ini.</h5></p>
                                <?php } else { ?>
                            <p><i class="fa fa-eye" aria-hidden="true"></i> <strong>Private </strong><br><h5>Tidak semua orang bisa menemukan komunitas ini.</h5></p>
                                <?php } ?>
                            
                                <?php if ($A->jenis_komunitas == "Aktif") { ?>
                            <p><i class="fa fa-globe" aria-hidden="true"></i> <strong><?= $A->jenis_komunitas ?></strong><br><h5>Banyak orang menggunakan komunitas ini</h5></p>
                                <?php } else { ?>
                            <p><i class="fa fa-globe" aria-hidden="true"></i> <strong>Pasif</strong><br><h5>Hanya sebagian anggota menggunakan komunitas ini dan sedikit hal yang diposting</h5></p>
                                <?php } ?>
                            
                            <p><i class="fa fa-map-marker" aria-hidden="true"></i> <strong>Lokasi</strong><br><h5><?= $A->lokasi_komunitas ?></h5></p>
                            <p><i class="fa fa-users" aria-hidden="true"></i> <strong>Anggota</strong><br><h5>+- <?= $A->anggota_komunitas ?></h5></p>
                            <!-- <hr>
                            <p><i class="fa fa-calendar" aria-hidden="true"></i> <small>Tanggal Dibuat</small><br><h5><?= $A->date_created; ?></h5></p>
                            <p><i class="fa fa-clock-o" aria-hidden="true"></i> <small>Waktu Dibuat</small><br><h5><?= $A->time_created; ?></h5></p>
                            <p><i class="fa fa-user" aria-hidden="true"></i> <small>Pengupload Komunitas</small><br><h5><?= $A->username; ?></h5></p>
                            -->
                        </div> 
                    </div>
                </div>
            </div>
            <!-- END CONTACT ITEM -->
        </div>
    </div>
        <?php endif ?>
    <?php } ?>
    <!-- KOMUNITAS CONTENT -->
    </div>
</div>
<!-- PAGE CONTENT WRAP -->

<script>
$("#form-ubah-komunitas-validate").validate();

$("#file-simple").fileinput({
    showUpload: false,
    showCaption: false,
    browseClass: "btn btn-danger",
    fileType: "any"
});

</script>
