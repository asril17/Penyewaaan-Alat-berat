<?php
class transaksi extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('m_transaksi');
        $this->load->model('m_laporan');
        $this->load->library('template');
    }
    public function penyewaan_alber()
    {
        $pages = 'transaksi/penyewaanAlatBerat';
        $data = [
            'user' => $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(),
            // 'kode' => $this->m_transaksi->kode('kd_penyewaan', 'penyewaan', 'PNY'),
            'pny' => $this->m_transaksi->getData('transaksi'),
            'title' => 'Transaksi',
            'subtitle' => 'Tabel Penyewaan Alat Berat'
        ];
        $this->template->layout($pages, $data);
    }
    public function tambahPenyewaan()
    {
        $pages = 'transaksi/tambahSewa';
        $data = [
            'user' => $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(),
            'kode' => $this->m_transaksi->kode('kd_penyewaan', 'transaksi', 'PNY'),
            // 'pny' => $this->m_transaksi->getData('penyewaan'),
            'pl' => $this->m_transaksi->getData('pelanggan'),
            'alber' => $this->m_transaksi->getData('alat_berat'),
            'title' => 'Transaksi',
            'subtitle' => 'Form Input Penyewaan',
            'pegawai' => $this->m_transaksi->getDataPegawai(),
        ];
    
        $data['detail'] = $this->m_transaksi->getDetail($data['kode']);
        //var_dump($data['detail']);die;
        $this->form_validation->set_rules('tgl_expired', 'Tanggal Pengembalian', 'required', [
            'required' => 'Kolom %s harus diisi'
        ]);
        $this->form_validation->set_rules('kd_pelanggan', 'Nama Pelanggan', 'required', [
            'required' => 'Kolom %s harus diisi'
        ]);
        $this->form_validation->set_rules('kd_alat_berat', 'Nama Alat Berat', 'required', [
            'required' => 'Kolom %s harus diisi'
        ]);
        if ($this->form_validation->run() == false) {
            $this->template->layout($pages, $data);
        } else {
            $data = $this->m_transaksi->tambahDetailPny();
            print_r($data); die;
            redirect('transaksi/tambahPenyewaan');
        }
    }
    public function selesaiPny()
    {
        $sisa = $_POST['nominal'] - $_POST['jml'];
        if ($_POST['jml'] == $_POST['nominal']) {
            $status = 1;
            $this->m_laporan->insertJurnal('111', date('Y-m-d'), $_POST['nominal'], 'debit');
            $this->m_laporan->insertJurnal('411', date('Y-m-d'), $_POST['nominal'], 'kredit');
        } else {
            $this->m_laporan->insertJurnal('111', date('Y-m-d'), $_POST['jml'], 'debit');
            $this->m_laporan->insertJurnal('112', date('Y-m-d'), $sisa, 'debit');
            $this->m_laporan->insertJurnal('411', date('Y-m-d'), $_POST['nominal'], 'kredit');
            $status = 2;
        }
        $data = [
            'kd_penyewaan' => $_POST['kd_penyewaan'],
            'tgl_penyewaan' => date('Y-m-d'),
            'tgl_expired' => $_POST['tgl_expired'],
            'nominal' => $_POST['nominal'],
            'jml_bayar' => $_POST['jml'],
            'sisa' => $sisa,
            'status'    => $status
        ];

        $this->db->insert('penyewaan', $data);
        redirect('transaksi/penyewaan_alber');
    }
    public function jurnal()
    {
        $pages = 'laporan/jurnal';
        $data = [
            'user' => $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(),

            'title' => 'Laporan',
            'subtitle' => 'Data Jurnal'
        ];
        $this->template->layout($pages, $data);
    }
    public function bukuBesar()
    {
        $pages = 'laporan/bukuBesar';
        $data = [
            'user' => $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(),

            'title' => 'Laporan',
            'subtitle' => 'Data Buku Besar'
        ];
        $this->template->layout($pages, $data);
    }


    public function acc($kd_penyewaan)
    {
        $level = 1;
        $kd_penyewaan = $this->m_transaksi->update_status2($level,$kd_penyewaan);
        redirect('transaksi/penyewaan_alber');
    }
}
