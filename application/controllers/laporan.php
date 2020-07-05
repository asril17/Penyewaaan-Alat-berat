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
            'subtitle'      => 'List Data Daftar Pajak',
        ];
        $data['pajak'] = $this->db->join('transaksi', 'transaksi.id = daftar_pajak.transaksi_id')
            ->join('alat_berat', 'alat_berat.id = transaksi.alat_berat_id')
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
        $getAwal = $this->m_laporan->get_buku_besar($akun, ($bulan - 1), $tahun);
        $data['saldoo'] = 0;
        foreach ($getAwal as $ga) {
            if ($ga['posisi_dr_cr'] == 'debit') {
                $data['saldoo'] += $ga['nominal'];
            } else {
                $data['saldoo'] -= $ga['nominal'];
            }
        }


        $data['inisial']     = $tahun . '-' . $bulan . '-01';
        $data['coa']         = $this->m_laporan->get_akun();
        $data['akun']         = $this->m_laporan->get_dataAkun($akun);
        $data['buku_besar'] = $this->m_laporan->get_buku_besar($akun, $bulan, $tahun);
        // var_dump($data['akun']);
        // die;
        $data['menu'] = 'ledger';
        $this->template->layout($pages, $data);
    }

    public function laba_rugi()
    {
        $pages = 'laporan/laba_rugi';
        if (isset($_POST['bulan']) && $_POST['tahun']) {
            $bulan = $_POST['bulan'];
            $tahun = $_POST['tahun'];
        } else {
            $bulan = '0';
            $tahun = '0';
        }
        $data = [
            'title' => 'Laporan',
            'subtitle' => 'Laba Rugi',
        ];
        $data = [
            'user'          => $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(),
            'title'         => 'Laporan',
            'subtitle'      => 'List Data Laba Rugi',
        ];
        // $data['pendapatan_sewa'] = $this->db->select('SUM(jml_bayar) AS total_pendapatan')
        //     ->where('MONTH(tgl_transaksi)', $bulan)
        //     ->where('YEAR(tgl_transaksi)', $tahun)
        //     ->get('transaksi')->row_array();
        $getPendapatan = $this->m_laporan->get_buku_besar('411', $bulan, $tahun);
        $total_pendapatan = 0;
        foreach ($getPendapatan as $ga) {
            if ($ga['posisi_dr_cr'] == 'debit') {
                $total_pendapatan += $ga['nominal'];
            } else {
                $total_pendapatan -= $ga['nominal'];
            }
        }
        if ($total_pendapatan < 0) {
            $data['total_pendapatan'] = str_replace('-', '', $total_pendapatan);
        } else {
            $data['total_pendapatan'] = $total_pendapatan;
        }
        // $data['pengeluaran'] = $this->db->select('SUM(nominal) AS total_pengeluaran')
        //     ->where('MONTH(tgl_pengeluaran)', $bulan)
        //     ->where('YEAR(tgl_pengeluaran)', $tahun)
        //     ->get('transaksi_pengeluaran')->row_array();
        $data['coa'] = $this->db->like('kode_akun', '5')
            ->get('coa')->result_array();
        // var_dump($data['coa']);
        // die;


        $pendapatan_dll = $this->db->select('SUM(daftar_pemasukan_pegawai.nominal) AS total_pemasukan, SUM(transaksi_detail_tambahan.total) AS total_bensin')
            ->join('daftar_pemasukan_pegawai', 'daftar_pemasukan_pegawai.transaksi_id = transaksi.id')
            ->join('transaksi_detail_tambahan', 'transaksi_detail_tambahan.id_transaksi = transaksi.id')
            ->where('MONTH(tgl_transaksi)', $bulan)
            ->where('YEAR(tgl_transaksi)', $tahun)
            ->get('transaksi')->row_array();
        $data['pendapatan_dll'] = $pendapatan_dll['total_pemasukan'] + $pendapatan_dll['total_bensin'];
        // dd($pendapatan_dll['total_bensin']);
        // die;

        $data['pajak_sewa'] = $this->db->select('SUM(daftar_pajak.nominal_pajak) as pajak')
            ->join('daftar_pajak', 'daftar_pajak.transaksi_id = transaksi.id')
            ->get('transaksi')->row_array();



        // var_dump($data['sewa_supir']);
        // die;
        $data['menu'] = 'laba_rugi';
        $this->template->layout($pages, $data);
    }
}
