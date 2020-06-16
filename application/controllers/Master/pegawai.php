<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class pegawai extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Master/m_pegawai','pgw');
        $this->load->model('m_master_data','mdt');
    }
    public function index()
    {
        $pages = 'master_data/pegawai';
        $data = [
            'title'     => 'Master Data',
            'subtitle'     => 'Data Pegawai',
            'pegawai'        => $this->pgw->get_data(),
            'user' => $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(),
            'kode'              => $this->mdt->kode('kd_pegawai', 'pegawai', 'SPR')
        ];
        $this->load->view($pages, $data);
    }

}

/* End of file Controllername.php */
