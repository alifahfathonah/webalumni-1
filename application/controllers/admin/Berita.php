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
        $this->load->model('M_kategori');

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
        $data['daftarKategori'] = $this->M_kategori->getAllKategori();

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
        $idKategori = $this->input->post('idKategori');
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
            $data['id_kategori'] = $idKategori;
            if ($this->session->userdata('role') == 1 || $this->session->userdata('role') == 2) {
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

    function beritaJSON()
    {
        $id = $this->input->post('id');

        $data['berita'] = $this->M_berita->findBerita('*', array('tb_berita.id_berita = ' => $id));

        echo json_encode($data);
    }

    function kategoriJSON()
    {
        $id = $this->input->post('id_kategori');

        $data['kategori'] = $this->M_kategori->findKategori('*', array('tb_kategori_berita.id = ' => $id));

        echo json_encode($data);
    }

    function aktivasiCalonBerita()
    {
        $this->load->model('M_berita');

        $berita['stat_berita'] = $this->input->post('statBerita');
        $idBerita = $this->input->post('idBerita');

        // echo json_encode($user);
        $sukses = $this->M_berita->updateBerita($berita, $idBerita);

        if ($sukses != 0) {

            $berita['stat_berita'] = $sukses;
            $updateBerita = $this->M_berita->updateBerita($berita, $idBerita);


            if (!$updateBerita) {
                flashMessage('success', 'Calon Berita berhasil di aktifkan.');
                redirect('admin/Berita');
            } else {
                flashMessage('error', 'Aktivasi Calon Berita gagal! Silahkan coba lagi...');
                redirect('admin/Berita');
            }
        } else {
            flashMessage('error', 'Maaf, Terjadi kesalahan pada saat proses pembuatan Berita baru');
            redirect('admin/Berita');
        }
    }

    function tolakCalonBerita()
    {
        $idCalonBerita = $this->input->post('idCalonBerita');
        $data = $this->M_berita->findBerita('foto', array('tb_berita.id_berita = ' => $idCalonBerita));

        $sukses = $this->M_berita->deleteBerita($idCalonBerita);

        unlink(FCPATH . 'uploads/content/berita/' . $data[0]->foto);

        if (!$sukses) {
            flashMessage('success', 'Calon Berita berhasil ditolak!');
            redirect('admin/Berita');
        } else {
            flashMessage('error', 'Calon Berita gagal ditolak! Silahkan coba lagi');
            redirect('admin/Berita');
        }
        // echo json_encode($idKomunitas);
    }

    function kelolaBerita()
    {
        $data['title'] = 'Kelola Berita Aktif';
        $data['info'] = $this->M_anggota->findAnggotaAndUser(array('tb_anggota.user_id = ' => $this->session->userdata('uid')));

        $data['berita'] = $this->M_berita->getAllBerita();
        $data['daftarKategori'] = $this->M_kategori->getAllKategori();

        if ($this->session->userdata('role') == 1) {
            $this->admin_render('admin/kelolaBeritaAktif', $data);
        }
    }

    public function setUpdateBerita()
    {
        $this->load->model('M_berita');

        $idBerita = $this->input->post('idUbahBerita');
        $judulBerita = $this->input->post('judulBerita');
        $isiBerita = $this->input->post('isiBerita');
        $sumberBerita = $this->input->post('sumberBerita');
        $creditBerita = $this->input->post('creditBerita');
        $kategoriBerita = $this->input->post('idKategori');

        // $filename = "berita-" . $judulBerita . "-" . time();

        // Set preferences
        // $config['upload_path'] = './uploads/content/berita';
        // $config['allowed_types'] = 'png|jpg|jpeg';
        // $config['file_name'] = $filename;

        //load upload class library
        // $this->load->library('upload', $config);

        $berita['judul_berita'] = $judulBerita;
        $berita['isi_berita'] = $isiBerita;
        $berita['sumber'] = $sumberBerita;
        $berita['credit'] = $creditBerita;
        $berita['id_kategori'] = $kategoriBerita;

        // echo json_encode($data);
        $sukses = $this->M_berita->updateBerita($berita, $idBerita);

        if (!$sukses) {
            flashMessage('success', 'Berita berhasil di ubah.');
            redirect('admin/Berita/kelolaBerita');
        } else {
            flashMessage('error', 'Berita gagal di ubah! Silahkan coba lagi');
            redirect('admin/Berita/kelolaBerita');
        }


        // if (!$this->upload->do_upload('fileSaya')) {
        //     flashMessage('error', 'Maaf, Upload gambar calon anggota gagal! Silahkan coba lagi');
        //     redirect('admin/Berita/kelolaBerita');
        // } else {
        //     $upload_data = $this->upload->data();

        //     $data = $this->M_berita->findBerita('foto', array('tb_berita.id_berita = ' => $idBerita));

        //     $berita['judul_berita'] = $judulBerita;
        //     $berita['isi_berita'] = $isiBerita;
        //     $berita['sumber'] = $sumberBerita;
        //     $berita['credit'] = $creditBerita;
        //     $berita['id_kategori'] = $kategoriBerita;

        //     $berita['foto'] = $upload_data['file_name'];

        //     unlink(FCPATH . 'uploads/content/berita/' . $data[0]->foto);

        //     // echo json_encode($data);
        //     $sukses = $this->M_berita->updateBerita($berita, $idBerita);

        // }

        // if (!$sukses) {
        //     flashMessage('success', 'Berita berhasil di sunting.');
        //     redirect('admin/Berita/kelolaBerita');
        // } else {
        //     flashMessage('error', 'Berita gagal di sunting! Silahkan coba lagi');
        //     redirect('admin/Berita/kelolaBerita');
        // }
    }

    public function setUpdateFoto()
    {
        $this->load->model('M_berita');

        $idBerita = $this->input->post('idUbahFoto');
        $judulBerita = $this->input->post('judulUbahFotoBerita');

        $filename = "berita-" . $judulBerita . "-" . time();

        // Set preferences
        $config['upload_path'] = './uploads/content/berita';
        $config['allowed_types'] = 'png|jpg|jpeg';
        $config['file_name'] = $filename;

        // load upload class library
        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('fileSaya')) {
            flashMessage('error', 'Maaf, Upload gambar berita gagal! Silahkan coba lagi');
            redirect('admin/Berita/kelolaBerita');
        } else {
            $upload_data = $this->upload->data();

            $data = $this->M_berita->findBerita('foto', array('tb_berita.id_berita = ' => $idBerita));

            $berita['foto'] = $upload_data['file_name'];

            unlink(FCPATH . 'uploads/content/berita/' . $data[0]->foto);

            // echo json_encode($data);
            $sukses = $this->M_berita->updateBerita($berita, $idBerita);

            if (!$sukses) {
                flashMessage('success', 'Foto berhasil di ubah.');
                redirect('admin/Berita/kelolaBerita');
            } else {
                flashMessage('error', 'Foto gagal di ubah! Silahkan coba lagi');
                redirect('admin/Berita/kelolaBerita');
            }
        }
    }

    public function hapusBerita()
    {
        $this->load->model('M_berita');

        $id = $this->input->post('idBeritaHapus');

        $deleteBerita = $this->M_berita->deleteBerita($id);

        if (!$deleteBerita) {
            flashMessage('success', 'Berita berhasil dihapus');
            redirect('admin/Berita/kelolaBerita');
        } else {
            flashMessage('error', 'Berita gagal dihapus! Silahkan coba lagi');
            redirect('admin/Berita/kelolaBerita');
        }
    }


    function cariBerita()
    {
        $data['title'] = 'Kelola Berita';

        $judul = $this->input->post('judulBerita');

        $where = "tb_berita.stat_berita != 0";
        $data['berita'] = $this->M_berita->findBeritaLikeJudul($where, $judul);

        $data['info'] = $this->M_anggota->findAnggota('*', array('tb_anggota.user_id = ' => $this->session->userdata('uid')));

        if ($this->session->userdata('role') == 1) {
            $this->admin_render('admin/kelolaBeritaAktif', $data);
        }
    }

    function kelolaKategori()
    {
        $data['title'] = 'Kelola Kategori Berita';
        $data['info'] = $this->M_anggota->findAnggota('*', array('tb_anggota.user_id = ' => $this->session->userdata('uid')));
        $data['kategori'] = $this->M_kategori->getAllKategori();

        if ($this->session->userdata('role') == 1) {
            $this->admin_render('admin/kelolaKategori', $data);
        }
    }

    public function setAddKategori()
    {
        $data['kategori'] = $this->input->post('namaKategori');

        $sukses = $this->M_kategori->insertKategori($data);

        if (!$sukses) {
            flashMessage('success', 'Tambah kategori berhasil.');
            redirect('admin/Berita/kelolaKategori');
        } else {
            flashMessage('error', 'Tambah kategori gagal! Silahkan coba lagi.');
            redirect('admin/Berita/kelolaKategori');
        }
    }

    public function setDeleteKategori()
    {
        $id = $this->input->post('idKategoriDelete');
        // $namaJenisDelete = $this->input->post('namaJenisBisnisDelete');

        $sukses = $this->M_kategori->deleteKategori($id);

        if (!$sukses) {
            flashMessage('success', 'Kategori berhasil dihapus');
            redirect('admin/Berita/kelolaKategori');
        } else {
            flashMessage('error', 'Kategori gagal dihapus! Silahkan coba lagi');
            redirect('admin/Berita/kelolaKategori');
        }
    }

    public function setUpdateKategori()
    {
        $id = $this->input->post('idKategoriEdit');
        $kategori = $this->input->post('namaKategoriEdit', true);

        $sukses = $this->M_kategori->updateKategori($kategori, $id);

        if (!$sukses) {
            flashMessage('success', 'Kategori berhasil diperbarui');
            redirect('admin/Berita/kelolaKategori');
        } else {
            flashMessage('error', 'Kategori gagal diperbarui! Silahkan coba lagi');
            redirect('admin/Berita/kelolaKategori');
        }
    }
}
