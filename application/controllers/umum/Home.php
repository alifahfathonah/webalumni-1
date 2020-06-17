<?php

if (defined('BASEPATH') or exit('No direct script access allowed'));

/*
 * class Home Admin
 * Created by Lut Dinar Fadila 2018
*/

class Home extends MY_Controller {
    
    function __construct() {
        parent::__construct();
        $this->load->model('UmumHomeModel');

        if ($this->session->userdata('logged_in') == '' && $this->session->userdata('username') == '' && $this->session->userdata('role') == '') {
            redirect('login');
        } elseif ($this->session->userdata('logged_in') == 'Sudah Login' && $this->session->userdata('role') == '2') {
            redirect('koordinator');
        } elseif ($this->session->userdata('logged_in') == 'Sudah Login' && $this->session->userdata('role') == '1') {
            redirect('admin');
        }
    }

    function index() {
        $data['title'] = 'Beranda Alumni';
        $data['info'] = $this->UmumHomeModel->getInfoBySessionId();
        
        if ($this->session->userdata('role') == 5) {
            $this->umum_render('umum/home', $data);
        }
    }
}