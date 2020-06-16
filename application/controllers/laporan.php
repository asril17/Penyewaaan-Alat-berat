<?php

class laporan extends CI_controller
{
    function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->library('form_validation');
        $this->load->model('m_laporan');
    }
    public function lihat_jurnal()
    {
        $pages = 'laporan/jurnal';
        if (isset($_POST['bulan']) && $_POST['tahun']) {
            $bulan = $_POST['bulan'];
            $tahun = $_POST['tahun'];
        } else {
            $bulan = '0';
            $tahun = '0';
        }
        $data = [
            'title' => 'Laporan',
            'subtitle' => 'Data Jurnal',
        ];
        $data = [
            'user'          => $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(),
            'title'         => 'Laporan',
            'subtitle'      => 'List Data Jurnal',
        ];
        $data['jurnal'] = $this->m_laporan->get_jurnal($bulan, $tahun);
        $data['debit'] = $this->m_laporan->get_total_db($bulan, $tahun);
        $data['credit'] = $this->m_laporan->get_total_cr($bulan, $tahun);
        $data['menu'] = 'journal';
        $this->template->layout($pages, $data);
    }
    public function daftar_pajak()
    {
        $pages = 'laporan/daftarPajak';
        if (isset($_POST['bulan']) && $_POST['tahun']) {
            $bulan = $_POST['bulan'];
            $tahun = $_POST['tahun'];
        } else {
            $bulan = '0';
            $tahun = '0';
        }
        $data = [
            'title' => 'Laporan',
            'subtitle' => 'Daftar Pajak',
        ];
        $data = [
            'user'          => $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(),
            'title'         => 'Laporan',
            'subtitle'      => 'List Data Jurnal',
        ];
        $data['pajak'] = $this->db->join('transaksi', 'transaksi.id = daftar_pajak.transaksi_id')
            ->where('DATE_FORMAT(transaksi.tgl_transaksi,"%m")', $bulan)
            ->where('DATE_FORMAT(transaksi.tgl_transaksi,"%Y")', $tahun)
            ->get('daftar_pajak')->result_array();
        $data['menu'] = 'daftar_pajak';
        $this->template->layout($pages, $data);
    }
    public function buku_besar()
    {
        $pages = 'laporan/bukuBesar';
        if (isset($_POST['akun']) && $_POST['bulan'] && $_POST['tahun']) {
            $akun     = $_POST['akun'];
            $bulan    = $_POST['bulan'];
            $tahun     = $_POST['tahun'];
        } else {
            $akun     = '0';
            $bulan    = '0';
            $tahun     = '0';
        }
        $previous1 = $this->m_laporan->total_db($akun, $bulan - 1, $tahun);
        $previous2 = $this->m_laporan->total_cr($akun, $bulan - 1, $tahun);
        $saldo = $previous1 - $previous2;
        if (!empty($saldo)) {
            $data['saldo_awal'] = $saldo;
        } else {
            $data['saldo_awal'] = 0;
        }
        $data = [
            'user'          => $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(),
            'title'         => 'Laporan',
            'subtitle'      => 'List Data Buku Besar',
        ];
        $data['inisial']     = $tahun . '-' . $bulan . '-01';
        $data['coa']         = $this->m_laporan->get_akun();
        $data['akun']         = $this->m_laporan->get_dataAkun($akun);
        $data['buku_besar'] = $this->m_laporan->get_buku_besar($akun, $bulan, $tahun);
        // var_dump($data['akun']);
        // die;
        $data['menu'] = 'ledger';
        $this->template->layout($pages, $data);
    }
}
