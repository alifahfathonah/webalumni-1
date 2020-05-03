<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Register extends MY_Controller {
    
    function __construct() {
        parent::__construct();
        $this->load->model('LoginModel');
    }
    
    function index() {
        $data['title'] = 'Registrasi Calon Anggota IKASMA3BDG';
        $this->login_render('login/Register', $data);
    }
    
    function createRegisterAnggota() {
        
        $namaLengkap = $this->input->post('namaLengkap');
        $namaPanggilanAlias = $this->input->post('namaPanggilanAlias');
        $angkatan = $this->input->post('angkatan');
        $email = $this->input->post('email');
        $noTelepon = $this->input->post('noTelepon');
        $tglLahir = $this->input->post('tglLahir');

		$filename = "anggota-".$namaLengkap."-".time();

		//set preferences
		$config['upload_path'] = './uploads/avatars';
		$config['allowed_types'] = 'png|jpg|jpeg';
		$config['file_name'] = $filename;

		//load upload class library
		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('fileSaya'))
		{
			// case - failure
			flashMessage('error', 'Maaf, Registrasi anggota SMAIKA3BDG gagal! Silahkan coba lagi.');
            redirect('register');
		}
		else
		{
			// case - success
			$upload_data = $this->upload->data();

			$anggota['nama_lengkap'] = $namaLengkap;
			$anggota['nama_panggilan_alias'] = $namaPanggilanAlias;
			$anggota['angkatan'] = $angkatan;
			$anggota['email'] = $email;
			$anggota['no_telp'] = $noTelepon;
			$anggota['tanggal_lahir'] = $tglLahir;
			$anggota['nama_foto'] = $upload_data['file_name'];
			$anggota['status_anggota'] = '0';

			$this->LoginModel->saveRegisterAnggota($anggota);
//			echo json_encode($dataGambar);
//			echo json_encode($anggota);

			flashMessage('success', 'Anda berhasil mendaftar. Tunggu konfirmasi dari Admin / Koordinator jika Keanggotaan Anda telah di aktifkan / verifikasi');
            redirect('register');
		}
        
    }
    
}
