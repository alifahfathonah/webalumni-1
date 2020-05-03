<!-- START BREADCRUMB -->
<ul class="breadcrumb">
    <li>Anggota</li>                  
    <li class="active"><a href="<?= base_url('koordinator/Anggota'); ?>">Kelola Calon Anggota</a></li>
</ul>
<!-- END BREADCRUMB -->

<div class="page-title">                    
    <h2> Kelola calon anggota</h2>
</div>

<?= showFlashMessage(); ?>

<div class="page-content-wrap">
                
    <div class="row">
        <div class="col-md-12">

                <div class="panel panel-default tabs">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="active"><a href="#tab-first" role="tab" data-toggle="tab">Permohonan Calon Anggota</a></li>
                        <li><a href="#tab-second" role="tab" data-toggle="tab">Tambah Calon Anggota</a></li>
<!--                        <li><a href="#tab-three" role="tab" data-toggle="tab">Tes Upload Gambar</a></li>-->
                    </ul>
                    
                    <div class="panel-body tab-content">
                        
                        <div class="tab-pane active" id="tab-first">
                            <p>Daftar Permohonan Calon Anggota IKASMA3BDG.</p>

                            <div class="form-group">
                                <div class="panel-body">

                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped table-actions datatable">
                                            <thead>
                                                <tr>
                                                    <th width="50">No</th>
                                                    <th width="100">Foto</th>
                                                    <th width="100">Nama</th>
                                                    <th width="100">Angkatan</th>
                                                    <th width="100">No. Telepon</th>
                                                    <th width="100">Email</th>
                                                    <th width="100">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $no = 1;
                                                    foreach ($calonAnggota as $CA) { ?>
                                                    <tr id="trow_1">
                                                        <td class="text-center"><?= $no; ?></td>
														<?php if ($CA->nama_foto == NULL) { ?>
															<td><img src="<?= base_url('uploads/no-image.jpg'); ?>" alt="<?= $CA->nama_lengkap; ?>" title="<?= $CA->nama_lengkap; ?>" width="80" /></td>
														<?php } else { ?>
															<td><img src="<?= base_url('uploads/avatars/'.$CA->nama_foto); ?>" alt="<?= $CA->nama_lengkap; ?>" title="<?= $CA->nama_lengkap; ?>" width="80" height="80" /></td>
														<?php } ?>

                                                        <td><strong><?= $CA->nama_lengkap; ?></strong></td>

														<?php if ($CA->angkatan == null) { ?>
															<td>Belum di isi</td>
														<?php } else { ?>
															<td><?= $CA->angkatan; ?></td>
														<?php } ?>
                                                        <!-- <td><span class="label label-success">New</span></td> -->

														<?php if ($CA->no_telp == null) { ?>
															<td>Belum di isi</td>
														<?php } else { ?>
															<td><?= $CA->no_telp; ?></td>
														<?php } ?>

														<?php if ($CA->email == null) { ?>
															<td>Belum di isi</td>
														<?php } else { ?>
															<td><?= $CA->email; ?></td>
														<?php } ?>
                                                        <td>
                                                            <button type="button" class="btn btn-primary mb-control btn-terima" data-box="#message-box-terima" id="<?= $CA->id_anggota; ?>">Terima</button>
                                                            <button type="button" class="btn btn-danger mb-control btn-tolak" id="<?= $CA->id_anggota; ?>" data-box="#message-box-tolak">Tolak</button>
                                                        </td>
                                                    </tr>
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
                            <h5>Tambah Calon Anggota Baru IKASMA3BDG</h5>

                            <div class="form-group">
                                <form action="<?= base_url('koordinator/Anggota/tambahCalonAnggota'); ?>" class="form-horizontal" id="form-tambah-anggota-validate" method="post" enctype="multipart/form-data">
                                    <div class="panel-body">
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">* Nama Lengkap</label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" name="namaLengkap" placeholder="Nama Lengkap" required />
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Nama Panggilan / Alias</label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" name="namaPanggilanAlias" placeholder="Nama Panggilan / Alias" required />
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Tanggal Lahir</label>
                                            <div class="col-md-8">
                                                <div class="input-group">
                                                    <input type="text" id="dp-3" class="form-control datepicker" data-date="06-06-2014" data-date-format="dd-mm-yyyy" data-date-viewmode="years" name="tglLahir" placeholder="Tanggal Lahir" required />
                                                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-2 control-label">* Angkatan</label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" name="angkatan" placeholder="Angkatan / Tahun Lulus" required />
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">* No. Telepon</label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" name="noTelepon" id="noTelepon" placeholder="No. Telepon" required />
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-2 control-label">* Email</label>
                                            <div class="col-md-8">
                                                <input type="email" class="form-control form-email " name="email" id="email" placeholder="Email" required />
                                            </div>
                                        </div>

										<div class="form-group">
											<label class="col-md-2 control-label">Foto</label>
											<div class="col-md-8">
												<input type="file" class="file" name="fileSaya" id="file-simple" required />
											</div>
										</div>

                                        <div class="form-group">
                                            <div class="col-md-10">
                                                <button type="submit" class="btn btn-success pull-right">Simpan</button>
                                            </div>
                                        </div>
                                    </div>
                                
                                    <div class="panel-footer">
                                        <label class="control-label">* harus diisi</label><br>
                                        <label>Catatan : </label>
                                        <ol>
                                            <li>Calon Anggota Baru harus diverifikasi terlebih dahulu agar terdaftar sebagai anggota.</li>
                                            <li>Setelah di verifikasi, maka akun anggota baru dapat digunakan.</li>
                                            <li>Akun secara default menggunakan nomor telepon untuk masuk.</li>
                                        </ol>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>

        </div>
    </div>
                
</div>

<!-- MESSAGE BOX ACCEPT -->
<div class="message-box message-box-default animated zoomIn" data-sound="alert" id="message-box-terima">
    
    <div class="mb-container">
        <div class="mb-middle">
            <div class="mb-title">
                <span class="fa fa-check"></span> Terima <strong>Keanggotaan</strong>
            </div>
            <form action="<?= base_url('koordinator/Anggota/aktivasiCalonAnggota'); ?>" class="form-horizontal" method="post">
                <div class="mb-content">
                    <div class="panel-body">
                        <p>Apakah benar bahwa Calon Anggota di bawah ini akan di aktifkan sebagai Keanggotaan IKASMA3BDG dan merupakan Alumni SMA 3 Bandung dengan identitas sebagai berikut: </p><br>
                        
                        <div class="form-group hidden">
                            <div class="col-md-12">
                                <input type="text" class="form-control" name="idAnggota" id="idAnggota" />
                                <input type="text" class="form-control" name="username" id="userName">
                                <input type="text" class="form-control" name="password" id="passWord">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label">Nama Anggota : </label>
                            <div class="col-md-9">
                                <label class="control-label" id="namaAnggota"></label>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-3 control-label">Angkatan : </label>
                            <div class="col-md-9">
                                <label class="control-label" id="angkatanAnggota"></label>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-3 control-label">Email : </label>
                            <div class="col-md-9">
                                <label class="control-label" id="emailAnggota"></label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label">Username : </label>
                            <div class="col-md-9">
                                <label class="control-label" id="usernameAnggota"></label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label">Keanggotaan : </label>
                            <div class="col-md-9">
                                <select name="role" id="role" class="select form-control validate[required]">
                                    <option value="">Pilih</option>
                                    <option value="2">Koordinator</option>
                                    <option value="3">Anggota</option>
                                </select>
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
<!-- END MESSAGE BOX ACCEPT -->

<!-- MESSAGE BOX REJECT -->
<div class="message-box message-box-danger animated zoomIn" data-sound="alert" id="message-box-tolak">
            
    <div class="mb-container">
        <div class="mb-middle">
            <div class="mb-title">
                <span class="fa fa-times"></span> Tolak <strong>Keanggotaan</strong>
            </div>
            <form action="<?= base_url('koordinator/Anggota/tolakCalonAnggota'); ?>" class="form-horizontal" method="post">
                <div class="mb-content">
                    <div class="panel-body">
                        <p>Anda yakin akan menolak sebagai keanggotaan IKASMA3BDG dengan identitas Calon Anggota sebagai berikut :</p>
                                
                        <div class="form-group hidden">
                            <input type="text" id="idCalonAnggota" name="idCalonAnggota" class="form-control">
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label">Nama : </label>
                            <div class="col-md-9">
                                <label class="control-label" id="namaCalonAnggota"></label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label">Angkatan : </label>
                            <div class="col-md-9">
                                <label class="control-label" id="angkatanCalonAnggota"></label>
                            </div>
                        </div>
                                
                        <div class="form-group">
                            <label class="col-md-3 control-label">No. Telepon : </label>
                            <div class="col-md-9">
                                <label class="control-label" id="noTelpCalonAnggota"></label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label">Email : </label>
                            <div class="col-md-9">
                                <label class="control-label" id="emailCalonAnggota"></label>
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
<!-- END MESSAGE BOX REJECT -->

<script type="text/javascript">
    
    $("#form-tambah-anggota-validate").validate();

	$("#file-simple").fileinput({
		showUpload: false,
		showCaption: false,
		browseClass: "btn btn-danger",
		fileType: "any"
	});
    
    $(".btn-terima").click(function() {
        console.log(this.id);
        var idAnggota = this.id;
        
        $.get("<?= base_url('koordinator/Anggota/anggotaJSON/'); ?>"+idAnggota, function(data) {
            var data_obj = JSON.parse(data);
            
            var noTelp = data_obj.anggota[0].no_telp;
            var email = data_obj.anggota[0].email;
            var nik = data_obj.anggota[0].NIK;
            var namaLengkap = data_obj.anggota[0].nama_lengkap;
            var namaPanggilan = data_obj.anggota[0].nama_panggilan_alias;
            var angkatan = data_obj.anggota[0].angkatan;

            document.getElementById('namaAnggota').innerHTML = namaLengkap;
            document.getElementById('idAnggota').value = idAnggota;
			if (email == null) {
				console.log("Email is : " + email);
				document.getElementById('emailAnggota').innerHTML = "Email belum diisi";
			} else if (email != null) {
				document.getElementById('emailAnggota').innerHTML = email;
			}

			if (angkatan == null) {
				document.getElementById('angkatanAnggota').innerHTML = "Angkatan belum diisi";
			} else {
				document.getElementById('angkatanAnggota').innerHTML = angkatan;
			}

			if (noTelp != null) {
				document.getElementById('usernameAnggota').innerHTML = noTelp + " (Default Username & Password sesuai yang tertera)";
				document.getElementById('userName').value = noTelp;
				document.getElementById('passWord').value = noTelp;
			} else if (email != null) {
				document.getElementById('usernameAnggota').innerHTML = email.toLowerCase() + " (Default Username & Password sesuai yang tertera)";
				document.getElementById('userName').value = email.toLowerCase();
				document.getElementById('passWord').value = email.toLowerCase();
			} else if (nik != null) {
				document.getElementById('usernameAnggota').innerHTML = nik + " (Default Username & Password sesuai yang tertera)";
				document.getElementById('userName').value = nik;
				document.getElementById('passWord').value = nik;
			} else if (namaPanggilan != null) {
				document.getElementById('usernameAnggota').innerHTML = namaPanggilan.toLowerCase() + " (Default Username & Password sesuai yang tertera)";
				document.getElementById('userName').value = namaPanggilan.toLowerCase();
				document.getElementById('passWord').value = namaPanggilan.toLowerCase();
			} else if (namaLengkap != null) {
				document.getElementById('usernameAnggota').innerHTML = namaLengkap.toLowerCase() + " (Default Username & Password sesuai yang tertera)";
				document.getElementById('userName').value = namaLengkap.toLowerCase();
				document.getElementById('passWord').value = namaLengkap.toLowerCase();
			}
            
        });
    });

    $(".btn-tolak").click(function() {
        console.log(this.id);
        var idCalonAnggota = this.id;

        $.get("<?= base_url('koordinator/Anggota/anggotaJSON/') ?>"+idCalonAnggota, function (data) {
            var data_obj = JSON.parse(data);

			var email = data_obj.anggota[0].email;
			var noTelp = data_obj.anggota[0].no_telp;
			var angkatan = data_obj.anggota[0].angkatan;

            document.getElementById('idCalonAnggota').value = data_obj.anggota[0].id_anggota;
            document.getElementById('namaCalonAnggota').innerHTML = data_obj.anggota[0].nama_lengkap;

            if (email == null) {
				document.getElementById('emailCalonAnggota').innerHTML = "Belum di isi";
			} else {
				document.getElementById('emailCalonAnggota').innerHTML = email;
			}

			if (noTelp == null) {
				document.getElementById('noTelpCalonAnggota').innerHTML = "Belum di isi";
			} else {
				document.getElementById('noTelpCalonAnggota').innerHTML = noTelp;
			}

			if (angkatan == null) {
				document.getElementById('angkatanCalonAnggota').innerHTML = "Belum di isi";
			} else {
				document.getElementById('angkatanCalonAnggota').innerHTML = angkatan;
			}

        });
    });

</script>
