<!-- START BREADCRUMB -->
<ul class="breadcrumb">
    <li>Berita</li>
    <li class="active"><a href="<?= base_url('admin/Berita'); ?>">Kelola Calon Berita</li></a>
</ul>
<!-- END BREADCRUMB -->

<div class="page-title">
    <h2> Kelola calon Berita</h2>
</div>


<div class="page-content-wrap">

    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-default tabs">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="active"><a href="#tab-first" role="tab" data-toggle="tab">Permohonan Calon Berita</a>
                    </li>
                    <li><a href="#tab-second" role="tab" data-toggle="tab">Tambah Calon Berita</a></li>
                </ul>

                <div class="panel-body tab-content">

                    <div class="tab-pane active" id="tab-first">
                        <p>Daftar Permohonan Calon Berita IKASMA3BDG.</p>

                        <div class="form-group">
                            <div class="panel-body">

                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-actions datatable">
                                        <thead>
                                            <tr>
                                                <th width="50">No</th>
                                                <th width="200">Judul Berita</th>
                                                <th width="800">Isi Berita</th>
                                                <th width="100">Sumber</th>
                                                <th width="100">Credit</th>
                                                <th width="100">Foto</th>
                                                <th width="100">Penulis</th>
                                                <th width="100">Tanggal Ditambahkan</th>
                                                <th width="100">Waktu Ditambahkan</th>
                                                <th width="100">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no = 1;

                                            foreach ($calonBerita as $CB) { ?>
                                            <?php if ($CB->stat_berita == 0): ?>
                                            <tr id="trow_1">

                                                <td class="text-center"><?= $no; ?></td>

                                                <td><strong><?= $CB->judul_berita; ?></strong></td>

                                                <?php if ($CB->isi_berita == null) { ?>
                                                <td>Belum di isi</td>
                                                <?php } else { ?>
                                                <td><?= $CB->isi_berita; ?></td>
                                                <?php } ?>

                                                <?php if ($CB->sumber == null) { ?>
                                                <td>Belum di isi</td>
                                                <?php } else { ?>
                                                <td><?= $CB->sumber; ?></td>
                                                <?php } ?>

                                                <?php if ($CB->credit == null) { ?>
                                                <td>Belum di isi</td>
                                                <?php } else { ?>
                                                <td><?= $CB->credit; ?></td>
                                                <?php } ?>
                                                
                                                <?php if ($CB->foto == null) { ?>
                                                <td><img src="<?= base_url('uploads/no-image.jpg'); ?>"
                                                        alt="<?= $CB->judul_berita; ?>"
                                                        title="<?= $CB->judul_berita; ?>" width="80" /></td>
                                                <?php } else { ?>
                                                <td><img src="<?= base_url('uploads/content/berita/' . $CB->foto); ?>"
                                                        alt="<?= $CB->judul_berita; ?>"
                                                        title="<?= $CB->judul_berita; ?>" width="80" height="80" /></td>
                                                <?php } ?>
                                                
                                                <?php if ($CB->id_penulis == null) { ?>
                                                <td>Belum di isi</td>
                                                <?php } else { ?>
                                                <td><?= $CB->username; ?></td>
                                                <?php } ?>
                                                
                                                <?php if ($CB->date_created == null) { ?>
                                                <td>Belum di isi</td>
                                                <?php } else { ?>
                                                <td><?= $CB->date_created; ?></td>
                                                <?php } ?>

                                                <?php if ($CB->time_created == null) { ?>
                                                <td>Belum di isi</td>
                                                <?php } else { ?>
                                                <td><?= $CB->time_created; ?></td>
                                                <?php } ?>

                                                <td>
                                                    <button type="button" class="btn btn-primary mb-control btn-terima"
                                                        data-box="#message-box-terima"
                                                        id="<?= $CB->id_berita; ?>">Terima</button>
                                                    <button type="button" class="btn btn-danger mb-control btn-tolak"
                                                        data-box="#message-box-tolak"
                                                        id="<?= $CB->id_berita; ?>">Tolak</button>
                                                </td>
                                            </tr>
                                                <?php endif ?>
                                            <?php
                                                $no++;
                                            } ?>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="tab-pane" id="tab-second">
                        <h5>Tambah Calon Berita Baru IKASMA3BDG</h5>

                        <div class="form-group">
                            <form action="<?= base_url('admin/Berita/tambahCalonBerita'); ?>" class="form-horizontal"
                                id="form-tambah-komunitas-validate" method="post" enctype="multipart/form-data">
                                <div class="panel-body">
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Judul Berita</label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" name="judulBerita"
                                                placeholder="Judul Berita" required clear />
                                        </div>
                                    </div>

                                    <input type="hidden" class="form-control" name="idPengupload" value="<?= $info[0]->id_user?>">

                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Isi Berita</label>
                                        <div class="col-md-8">
                                            <textarea class="form-control" name="isiBerita" placeholder="Isi Berita" rows="4" cols="50"></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Sumber</label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" name="sumberBerita"
                                                placeholder="Sumber Berita" required clear />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Credit</label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" name="creditBerita"
                                                placeholder="Daftar nama kontributor untuk berita ini" required clear />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Foto Berita</label>
                                        <div class="col-md-8">
                                            <input type="file" class="file" id="file-simple" name="fileSaya" required />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-10">
                                            <button type="submit" class="btn btn-success pull-right">Simpan</button>
                                        </div>
                                    </div>
                                </div>

                                <div class="panel-footer">
                                    <label class="text-muted">Catatan : </label>
                                    <ol>
                                        <li>Berita Baru harus diverifikasi terlebih dahulu agar terdaftar sebagai
                                            Berita aktif.</li>
                                        <li>Kecuali berita ditambahkan oleh Admin dan Koordinator akan otomatis aktif.</li>
                                        <li>Setelah di verifikasi, maka Berita baru dapat dipublikasi di halaman 
                                        user</li>
                                    </ol>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="tab-pane" id="tab-three">
                        <h5>Tes Upload Gambar</h5>

                        <div class="form-group">

                            <form action="<?= base_url('admin/Anggota/uploadGambar'); ?>" method="post"
                                class="form-horizontal" id="upload-gambar-validate">
                                <div class="panel-body">
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Nama Panggilan / Alias</label>
                                        <div class="col-md-8">
                                            <input type="file" class="form-control" name="file" required />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-10">
                                            <button type="submit" class="btn btn-success pull-right">Simpan</button>
                                        </div>
                                    </div>
                                </div>
                            </form>

                        </div>

                    </div>

                </div>
            </div>

        </div>
    </div>

</div>

<!-- MESSAGE BOX ACCEPT CALON ANGGOTA -->
<div class="message-box animated zoomIn" data-sound="alert" id="message-box-terima">

    <div class="mb-container">
        <div class="mb-middle">
            <div class="mb-title">
                <span class="fa fa-check"></span> Terima <strong> Sebagai Berita baru di IKASMA3BDG </strong>
            </div>
            <form action="<?= base_url('admin/Berita/aktivasiCalonBerita'); ?>" class="form-horizontal" method="post">
                <div class="mb-content">
                    <div class="panel-body">
                        <p>Apakah benar bahwa Berita di bawah ini akan diaktifkan sebagai Berita valid di IKASMA3BDG</p><br>

                        <div class="form-group hidden">
                            <div class="col-md-12">
                                <input type="text" class="form-control" name="idKomunitas" id="idKomunitas" />
                                <input type="text" class="form-control" name="idPengupload" id="idPengupload">
                                <input type="text" class="form-control" name="statKomunitas" id="statKomunitas" value="1">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label">Judul Berita : </label>
                            <div class="col-md-9">
                                <label class="control-label" id="judulBerita"><?= $CB->judul_berita; ?></label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label">Id Penulis : </label>
                            <div class="col-md-9">
                                <label class="control-label" id="idPengupload"></label>

                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label">Isi Berita : </label>
                            <div class="col-md-9">
                                <label class="control-label" id="isiBerita"></label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-footer">
                    <div class="pull-right">
                        <button type="submit" class="btn btn-info btn-lg mb-control-yes">Terima</button>
                        <button class="btn btn-default btn-lg mb-control-close">Batal</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>
<!-- END MESSAGE BOX ACCEPT CALON ANGGOTA -->

<!-- MESSAGE BOX REJECT CALON ANGGOTA -->
<div class="message-box message-box-danger animated zoomIn" data-sound="alert" id="message-box-tolak">

    <div class="mb-container">
        <div class="mb-middle">
            <div class="mb-title">
                <span class="fa fa-times"></span> Tolak <strong>Komunitas</strong>
            </div>
            <form action="<?= base_url('admin/Komunitas/tolakCalonKomunitas'); ?>" class="form-horizontal" method="post">
                <div class="mb-content">
                    <div class="panel-body">
                        <p>Anda yakin akan menolak sebagai keanggotaan IKASMA3BDG dengan identitas Calon Anggota sebagai
                            berikut :</p>

                        <div class="form-group hidden">
                            <input type="text" id="idCalonKomunitas" name="idCalonKomunitas" class="form-control">
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label">Nama Komunitas : </label>
                            <div class="col-md-9">
                                <label class="control-label" id="namaCalonKomunitas"></label>
                            </div>
                        </div>

                      <div class="form-group">
                            <label class="col-md-3 control-label">Tautat Komunitas : </label>
                            <div class="col-md-9">
                                <label class="control-label" id="tautatCalonKomunitas"></label>

                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label">Pengupload : </label>
                            <div class="col-md-9">
                                <label class="control-label" id="idCalonPengupload"></label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-footer">
                    <div class="pull-right">
                        <button type="submit" class="btn btn-primary btn-lg mb-control-yes">Tolak</button>
                        <button class="btn btn-default btn-lg mb-control-close">Batal</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>
<!-- END MESSAGE BOX REJECT CALON ANGGOTA -->

<script type="text/javascript">
$("#form-tambah-komunitas-validate").validate();

$("#file-simple").fileinput({
    showUpload: false,
    showCaption: false,
    browseClass: "btn btn-danger",
    fileType: "any"
});

$(".btn-terima").click(function() {
    console.log(this.id);
    var idKomunitas = this.id;

    $.post("<?= base_url('admin/Komunitas/komunitasJSON/'); ?>", {
            id: idKomunitas
        },
        function(data) {
            var data_obj = JSON.parse(data);

            var namaKomunitas = data_obj.komunitas[0].nama_komunitas;
            var tautatKomunitas = data_obj.komunitas[0].tautat_komunitas;
            // var logoKomunitas = data_obj.komunitas[0].logo_komunitas;
            var dateCreated = data_obj.komunitas[0].date_created;
            // var timeCreated = data_obj.komunitas[0].time_created;
            // var idPengupload = data_obj.komunitas[0].id_pengupload;
            var statKomunitas = data_obj.komunitas[0].stat_komunitas;

            document.getElementById('idKomunitas').value = data_obj.komunitas[0].id_komunitas;
            document.getElementById('namaKomun').innerHTML = namaKomunitas;
            document.getElementById('tautatKomunitas').innerHTML = tautatKomunitas;
            // document.getElementById('idPengupload').innerHTML = idPengupload;
            document.getElementById('dateCreated').innerHTML = dateCreated;

        });
});

$(".btn-tolak").click(function() {
    console.log(this.id);
    var idCalonKomunitas = this.id;

    $.post("<?= base_url('admin/Komunitas/KomunitasJSON/') ?>", {
            id: idCalonKomunitas
        },
        function(data) {
            var data_obj = JSON.parse(data);

            var namaCalonKomunitas = data_obj.komunitas[0].nama_komunitas;
            var tautatCalonKomunitas = data_obj.komunitas[0].tautat_komunitas;
            // var logoKomunitas = data_obj.komunitas[0].logo_komunitas;
            // var dateCreated = data_obj.komunitas[0].dateCreated;
            // var timeCreated = data_obj.komunitas[0].time_created;
            var idCalonPengupload = data_obj.komunitas[0].id_pengupload;
            var statKomunitas = data_obj.komunitas[0].stat_komunitas;

            document.getElementById('idCalonKomunitas').value = data_obj.komunitas[0].id_komunitas;
            document.getElementById('namaCalonKomunitas').innerHTML = data_obj.komunitas[0].nama_komunitas;
            document.getElementById('tautatCalonKomunitas').innerHTML = tautatCalonKomunitas;
            document.getElementById('idCalonPengupload').innerHTML = idCalonPengupload;

        });
});
</script>