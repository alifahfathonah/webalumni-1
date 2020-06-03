<?php

if (defined('BASEPATH') or exit('No direct script access allowed'));

/*
 * class Anggota Admin
 * Created by Lut Dinar Fadila 2018
*/

class Berita extends MY_Controller
{
    function __construct()
    {
        parent::__construct();

        $this->load->model('AdminAnggotaModel');
        $this->load->model('AdminHomeModel');
        $this->load->model('M_anggota');
        $this->load->model('M_berita');

        if ($this->session->userdata('logged_in') == '' && $this->session->userdata('username') == '' && $this->session->userdata('role') == '') {
            redirect('login');
        } elseif ($this->session->userdata('logged_in') == 'Sudah Login' && $this->session->userdata('role') == '2') {
            redirect('koordinator');
        } elseif ($this->session->userdata('logged_in') == 'Sudah Login' && $this->session->userdata('role') == '3') {
            redirect('anggota');
        }
    }
    
    function index()
    {
        $data['title'] = 'Kelola Berita';
        $data['info'] = $this->M_anggota->findAnggotaAndUser(array('tb_anggota.user_id = ' => $this->session->userdata('uid')));

        $data['calonBerita'] = $this->M_berita->getAllBerita();

        if ($this->session->userdata('role') == 1) {
            $this->admin_render('admin/kelolaCalonBerita', $data);
        }
    }

    public function tambahCalonBerita()
    {
        date_default_timezone_set("Asia/Jakarta");
        $jam = date("H:i:s");
        $tanggal = date("Y-m-d", mktime(date('m'), date("d"), date('Y')));

        $this->load->model('M_berita');

        $judulBerita = $this->input->post('judulBerita');
        $isiBerita = $this->input->post('isiBerita');
        $tglPengajuan = $tanggal;
        $waktuPengajuan = $jam;
        $sumberBerita = $this->input->post('sumberBerita');
        $creditBerita = $this->input->post('creditBerita');
        $idPengupload = $this->input->post('idPengupload');
        
        $filename = "berita-" . $judulBerita . "-" . time();

        // Set preferences
        $config['upload_path'] = './uploads/content/berita';
        $config['allowed_types'] = 'png|jpg|jpeg';
        $config['file_name'] = $filename;

        //load upload class library
        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('fileSaya')) {
            flashMessage('error', 'Maaf, Upload gambar calon berita gagal! Silahkan coba lagi');
            redirect('admin/Berita');
        } else {
            $upload_data = $this->upload->data();

            $data['judul_berita'] = $judulBerita;
            $data['date_created'] = $tglPengajuan;
            $data['time_created'] = $waktuPengajuan;
            $data['isi_berita'] = $isiBerita;
            $data['sumber'] = $sumberBerita;
            $data['credit'] = $creditBerita;
            $data['foto'] = $upload_data['file_name'];
            $data['id_penulis'] = $idPengupload;
            if($this->session->userdata('role') == 1 || $this->session->userdata('role') == 2) {
                $data['stat_berita'] = '1';
            } else {
                $data['stat_berita'] = '0';
            }

            // echo json_encode($data);
            $sukses = $this->M_berita->insertNewBerita($data);

            if (!$sukses) {
                flashMessage('success', 'Calon Berita Baru berhasil ditambahkan. Silahkan verifikasi di Permohonan Calon Berita');
                redirect('admin/Berita');
            } else {
                flashMessage('error', 'Calon Berita Baru gagal ditambahkan! Silahkan coba lagi');
                redirect('admin/Berita');
            }
        }
    }
}