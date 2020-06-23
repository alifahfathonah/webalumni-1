<?php

if (defined('BASEPATH') or exit('No direct script access allowed'));

/*
 * class Anggota Admin
 * Created by 
 *      Adhy Wiranto Sudjana
 *      Dicky Ardianto
 *      Rafly Yunandi Aliansyah
 * Architecture by 
 *      Lut Dinar Fadila
 * 
 * 2020
*/

class Komunitas extends MY_Controller
{
    // ==================================================
    // ------------------ CONTSTRUCTOR ------------------
    // ==================================================
    function __construct() {
        parent::__construct();
        $this->load->model('M_anggota');
        $this->load->model('M_user');
        $this->load->model('M_komunitas');

        if ($this->session->userdata('logged_in') == '' && $this->session->userdata('username') == '' && $this->session->userdata('role') == '') {
            redirect('login');
        } elseif ($this->session->userdata('logged_in') == 'Sudah Login' && $this->session->userdata('role') == '1') {
            redirect('admin');
        } elseif ($this->session->userdata('logged_in') == 'Sudah Login' && $this->session->userdata('role') == '3' || $this->session->userdata('role') == '4') {
            redirect('anggota');
        }
    }
    // ==================================================
    // ------------------ CONTSTRUCTOR ------------------
    // ==================================================
    //
    //
    //
    // ==================================================
    // ---------------------- READ ----------------------
    // ==================================================
    function index()
    {
        $data['title'] = 'Kelola Komunitas';
        $data['info'] = $this->M_anggota->findAnggotaAndUser(array('tb_anggota.user_id = ' => $this->session->userdata('uid')));


        $data['calonKomunitas'] = $this->M_komunitas->getAllKomunitas();

        if ($this->session->userdata('role') == 2) {
            $this->koordinator_render('koordinator/KelolaKomunitas', $data);
        }
        //         echo json_encode($data);
    }

    function KelolaStatusKomunitas()
    {
        $data['title'] = 'Kelola Status Komunitas';
        $data['info'] = $this->M_anggota->findAnggotaAndUser(array('tb_anggota.user_id = ' => $this->session->userdata('uid')));

        $data['komunitas'] = $this->M_komunitas->getAllKomunitas();

        if ($this->session->userdata('role') == 2) {
            $this->koordinator_render('koordinator/KelolaStatusKomunitas', $data);
        }
    }
    // ==================================================
    // ---------------------- READ ----------------------
    // ==================================================
    //
    //
    //
    // ==================================================
    // --------------------- CREATE ---------------------
    // ==================================================
        public function tambahCalonKomunitas()
    {
        date_default_timezone_set("Asia/Jakarta");
        $jam = date ("H:i:s");
        $tanggal = date("Y-m-d", mktime(date('m'), date("d"), date('Y')));

        $sifatKomunitas = $this->input->post('sifatKomunitas');
        $jenisKomunitas = $this->input->post('jenisKomunitas');
        $lokasiKomunitas = $this->input->post('lokasiKomunitas');
        $anggotaKomunitas = $this->input->post('anggotaKomunitas');
        $deskKomunitas = $this->input->post('deskKomunitas');

        $namaKomunitas = $this->input->post('namaKomunitas');
        $tautatKomunitas = $this->input->post('tautatKomunitas');
        $tglPengajuan = $tanggal;
        $waktuPengajuan = $jam;
        $idPengupload = $this->input->post('idPengupload');
        
        $filename = "komunitas-" . $namaKomunitas . "-" . time();

        // Set preferences
        $config['upload_path'] = './uploads/avatars';
        $config['allowed_types'] = 'png|jpg|jpeg';
        $config['file_name'] = $filename;

        //load upload class library
        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('fileSaya')) {
            flashMessage('error', 'Maaf, Upload gambar calon anggota gagal! Silahkan coba lagi');
            redirect('koordinator/Komunitas');
        } else {
            $upload_data = $this->upload->data();
            
            $data['sifat_komunitas'] = $sifatKomunitas;
            $data['jenis_komunitas'] = $jenisKomunitas;
            $data['lokasi_komunitas'] = $lokasiKomunitas;
            $data['anggota_komunitas'] = $anggotaKomunitas;
            $data['deskripsi_komunitas'] = $deskKomunitas;

            $data['nama_komunitas'] = $namaKomunitas;
            $data['tautat_komunitas'] = $tautatKomunitas;
            $data['date_created'] = $tglPengajuan;
            $data['time_created'] = $waktuPengajuan;
            $data['logo_komunitas'] = $upload_data['file_name'];
            $data['id_pengupload'] = $idPengupload;
            if($this->session->userdata('role') == 2) {
                $data['stat_komunitas'] = '1';
            } else {
                $data['stat_komunitas'] = '0';
            }

            // echo json_encode($data);
            $sukses = $this->M_komunitas->insertNewKomunitas($data);

            if (!$sukses) {
                flashMessage('success', 'Calon Komunitas Baru berhasil di daftarkan. Silahkan verifikasi di Permohonan Calon Anggota');
                redirect('koordinator/Komunitas');
            } else {
                flashMessage('error', 'Calon Komunitas Baru gagal di daftarkan! Silahkan coba lagi');
                redirect('koordinator/Komunitas');
            }
        }
    }
    // ==================================================
    // --------------------- CREATE ---------------------
    // ==================================================
    //
    //
    //
    // ==================================================
    // --------------------- UPDATE ---------------------
    // ==================================================
    function aktivasiCalonKomunitas()
    {
        $komunitas['stat_komunitas'] = $this->input->post('statKomunitas');
        $idKomunitas = $this->input->post('idKomunitas');

        // echo json_encode($user);
        $sukses = $this->M_komunitas->updateKomunitas($komunitas, $idKomunitas);

        if ($sukses == 0) {
            flashMessage('success', 'Calon Komunitas berhasil di aktifkan sebagai Komunitas Aktif');
            redirect('koordinator/Komunitas');
        } else {
            flashMessage('error', 'Aktivasi Calon Komunitas gagal! Silahkan coba lagi...');
            redirect('koordinator/Komunitas');
        }
    }

     public function setUpdateKomunitas()
    {
        $sifatKomunitas = $this->input->post('sifatKomunitas');
        $jenisKomunitas = $this->input->post('jenisKomunitas');
        $lokasiKomunitas = $this->input->post('lokasiKomunitas');
        $anggotaKomunitas = $this->input->post('anggotaKomunitas');
        $deskKomunitas = $this->input->post('deskKomunitas');

        $idKomunitas = $this->input->post('idKomunitas');
        $namaKomunitas = $this->input->post('namaKomunitas');
        $tautatKomunitas = $this->input->post('tautatKomunitas');

        $filename = "komunitas-" . $namaKomunitas . "-" . time();

        // Set preferences
        $config['upload_path'] = './uploads/avatars';
        $config['allowed_types'] = 'png|jpg|jpeg';
        $config['file_name'] = $filename;

        //load upload class library
        $this->load->library('upload', $config);

        // if (!$this->upload->do_upload('fileSaya')) {
        //     flashMessage('error', 'Maaf, Upload gambar calon anggota gagal! Silahkan coba lagi');
        //     redirect('admin/komunitas/kelolaStatusKomunitas');
        // } else {
            $upload_data = $this->upload->data();

            $komunitas['sifat_komunitas'] = $sifatKomunitas;
            $komunitas['jenis_komunitas'] = $jenisKomunitas;
            $komunitas['lokasi_komunitas'] = $lokasiKomunitas;
            $komunitas['anggota_komunitas'] = $anggotaKomunitas;
            $komunitas['deskripsi_komunitas'] = $deskKomunitas;

            $komunitas['nama_komunitas'] = $namaKomunitas;
            $komunitas['tautat_komunitas'] = $tautatKomunitas;
            // $komunitas['logo_komunitas'] = $upload_data['file_name'];

            // echo json_encode($data);
            $sukses = $this->M_komunitas->updateKomunitas($komunitas, $idKomunitas);

            if (!$sukses) {
                flashMessage('success', 'Calon Komunitas Baru berhasil di daftarkan. Silahkan verifikasi di Permohonan Calon Anggota');
                redirect('admin/komunitas/kelolaStatusKomunitas');
            } else {
                flashMessage('error', 'Calon Komunitas Baru gagal di daftarkan! Silahkan coba lagi');
                redirect('admin/komunitas/kelolaStatusKomunitas');
            }
        // }
    }

    public function setUpdateFotoKomunitas()
    {
        $this->load->model('M_komunitas');

        $idKomunitas = $this->input->post('idKomunitas');
        $namaKomunitas = $this->input->post('namaKomunitas');

        $filename = "komunitas-" . $namaKomunitas . "-" . time();

        // Set preferences
        $config['upload_path'] = './uploads/content/komunitas';
        $config['allowed_types'] = 'png|jpg|jpeg';
        $config['file_name'] = $filename;

        // load upload class library
        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('fileSaya')) {
            flashMessage('error', 'Maaf, Upload gambar berita gagal! Silahkan coba lagi');
            redirect('koordinator/komunitas/kelolaStatusKomunitas');
        } else {
            $upload_data = $this->upload->data();

            $data = $this->M_komunitas->findKomunitas('logo_komunitas', array('tb_komunitas.id_komunitas = ' => $idKomunitas));

            $komunitas['logo_komunitas'] = $upload_data['file_name'];

            unlink(FCPATH . 'uploads/content/komunitas/' . $data[0]->logo_komunitas);

            // echo json_encode($data);
            $sukses = $this->M_komunitas->updateKomunitas($komunitas, $idKomunitas);

            if (!$sukses) {
                flashMessage('success', 'Foto berhasil di ubah.');
                redirect('koordinator/komunitas/kelolaStatusKomunitas');
            } else {
                flashMessage('error', 'Foto gagal di ubah! Silahkan coba lagi');
                redirect('koordinator/komunitas/kelolaStatusKomunitas');
            }
        }
    }

    // ==================================================
    // --------------------- UPDATE ---------------------
    // ==================================================
    //
    //
    //
    // ==================================================
    // --------------------- DELETE ---------------------
    // ==================================================	
    public function hapusKomunitas()
    {
        $this->load->model('M_komunitas');

        $id = $this->input->post('idKomunitasHapus');

        $deleteKomunitas = $this->M_komunitas->deleteKomunitas($id);

        if (!$deleteKomunitas) {
            flashMessage('success', 'Komunitas berhasil dihapus');
            redirect('koordinator/Komunitas/kelolaStatusKomunitas');
        } else {
            flashMessage('error', 'Komunitas gagal dihapus! Silahkan coba lagi');
            redirect('koordinator/Komunitas/kelolaStatusKomunitas');
        }
    }

    function tolakCalonKomunitas()
    {
        $idKomunitas = $this->input->post('idCalonKomunitas');

        $sukses = $this->M_komunitas->deleteKomunitas($idKomunitas);

        if (!$sukses) {
            flashMessage('success', 'Calon Komunitas berhasil ditolak sebagai Komunitasan');
            redirect('koordinator/Komunitas');
        } else {
            flashMessage('error', 'Calon Komunitas gagal ditolak sebagai keKomunitasan! Silahkan coba lagi');
            redirect('koordinator/Komunitas');
        }
        // echo json_encode($idKomunitas);
    }
    // ==================================================
    // --------------------- DELETE ---------------------
    // ==================================================	
    //
    //
    //
    // ==================================================
    // --------------------- SEARCH ---------------------
    // ==================================================
    function cariStatusKomunitas()
    {
        $data['title'] = 'Kelola Status Komunitas';

        $nama = $this->input->post('namaKomunitas');

        $where = "tb_komunitas.stat_komunitas != 0";
        $data['komunitas'] = $this->M_komunitas->findKomunitasLikeNama($where, $nama);

        $data['info'] = $this->M_anggota->findAnggota('*', array('tb_anggota.user_id = ' => $this->session->userdata('uid')));

        if ($this->session->userdata('role') == 2) {
            $this->koordinator_render('koordinator/kelolaStatusKomunitas', $data);
        }

    }
    // ==================================================
    // --------------------- SEARCH ---------------------
    // ==================================================
    //
    //
    //
    // ==================================================
    // --------------------- OTHERS ---------------------
    // ==================================================
    function komunitasJSON()
    {
        $id = $this->input->post('id');

        $data['komunitas'] = $this->M_komunitas->findKomunitas('*', array('tb_komunitas.id_komunitas = ' => $id));

        echo json_encode($data);
    }

    public function getKomunitasById($id)
    {
        $data['komunitas'] = $this->M_komunitas->findKomunitasAndUser(array('tb_komunitas.id_komunitas = ' => $id));

        echo json_encode($data);
    }
    // ==================================================
    // --------------------- OTHERS ---------------------
    // ==================================================


}