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
        $current = date('Y-m-d');
        $trans = $this->m_transaksi->getData('transaksi');
        foreach ($trans as $row) {
            if ($current > $row['tgl_berakhir']) {
                $this->db->where('id', $row['pegawai_id'])
                    ->update('pegawai', ['status_sopir' => '0']);
            }
        }
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
        $harga_sewa = intval(0);
        $harga_umum = intval(0);
        $harga_khusus = intval(0);
        $pages = 'transaksi/tambahSewa';
        $data = [
            'user' => $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(),
            'kode' => $this->m_transaksi->kode('kd_penyewaan', 'transaksi', 'PNY'),
            'pl' => $this->m_transaksi->getData('pelanggan'),
            'alber' => $this->m_transaksi->getData('alat_berat'),
            'title' => 'Transaksi',
            'subtitle' => 'Form Input Penyewaan',
            'pegawai' => $this->m_transaksi->getDataPegawai(),
            'tambahanBiaya' => $this->db->get('biaya_operasional')->result(),
        ];

        $data['detail'] = $this->m_transaksi->getDetail($data['kode']);
        if ($this->input->post()) {

            $validation =  $this->m_transaksi->_validation();
            if ($validation == false) {
                $this->template->layout($pages, $data);
            } else {
                $ts1 = strtotime($this->input->post('tgl_sewa'));
                $ts2 = strtotime($this->input->post('tgl_expired'));
                $date1 = date_create($this->input->post('tgl_sewa'));
                $date2 = date_create($this->input->post('tgl_expired'));
                $diff = date_diff($date1, $date2);
                $hari = $diff->d;

                if (!empty($this->input->post('harga_umum'))) {
                    $harga_umum  = intval($this->input->post('harga_umum'));

                    $harga_sewa = $harga_umum;
                }

                //jika harga khusus
                if (!empty($this->input->post('harga_sewa_khusus')) && $this->input->post('harga_sewa_khusus') !== 0) {
                    $harga_khusus = intval($this->input->post('harga_sewa_khusus'));
                    $harga_umum = 0;
                    $harga_sewa = $harga_khusus;
                }

                $pegawai = $this->db->where('id', $this->input->post('kd_pegawai'))->get('pegawai')->row();

                $pajak_pegawai = 0;
                if (!empty($pegawai->id !== 1)) {
                    $set_pajak = $harga_umum * 2 / 100;
                    $subtotal = ($harga_sewa + $pegawai->biaya) * $hari + $set_pajak;
                    $potongan = ($pegawai->pajak / 100) * $pegawai->biaya;
                    $gaji  = $pegawai->biaya * $hari;
                    $pajak = 25;
                    $pajak_pegawai += $gaji * 25 / 100;
                    $this->db->where('id', $this->input->post('kd_pegawai'))
                        ->update('pegawai', ['status_sopir' => '1']);
                } else {
                    $set_pajak = $harga_umum * 2 / 100;
                    $subtotal = $harga_sewa  * $hari + $set_pajak;
                }
                $nominal_pajak = $pajak_pegawai + $set_pajak;

                $transaksi = $this->db->where('kd_penyewaan', $this->input->post('kd_penyewaan'))->get('transaksi')->row();

                $transaksiPost = [
                    'alat_berat_id' => $this->input->post('id_alatberat'),
                    'kd_penyewaan' => $this->input->post('kd_penyewaan'),
                    'pelanggan_id' => $this->input->post('kd_pelanggan'),
                    'pegawai_id' => $this->input->post('kd_pegawai'),
                    'tgl_mulai' => $this->input->post('tgl_sewa'),
                    'tgl_berakhir' => $this->input->post('tgl_expired'),
                    'nominal'      => $subtotal,
                    'status'       => 0,
                    'user_id'      => $this->session->userdata('userId'),
                ];

                $saveTransaksi  = $this->db->insert('transaksi', $transaksiPost);
                $id = $this->db->insert_id();

                $id_biaya = $this->input->post('id_biaya');
                $biaya_operasional = $this->db->where_in('id', $id_biaya)->get('biaya_operasional')->result();


                if ($saveTransaksi) {
                    $this->db->trans_start();
                    $totalBiaya = 0;
                    foreach ($biaya_operasional as $key => $value) {
                        $totalBiaya += $biaya_operasional[$key]->harga;

                        $postTransaksiDetail = [
                            'transaksi_id' => $id,
                            'biaya_operasional_id' => $value->id,
                            'harga' => $value->harga,
                            'total' => $totalBiaya,
                        ];
                        $this->db->insert('transaksi_detail', $postTransaksiDetail);
                    }

                    $this->db->insert('daftar_pemasukan_pegawai', ['transaksi_id' => $id, 'nominal' => $gaji, 'persen' => $pajak]);
                    $this->db->insert('daftar_pajak', ['nominal_pajak' => $nominal_pajak, 'transaksi_id' => $id]);
                    $this->db->trans_complete();
                    redirect('transaksi/penyewaan_alber');
                }
            }
        }
        $this->template->layout($pages, $data);
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
        $pages = 'transaksi/formPelunasan';
        $tr = $this->db->where('kd_penyewaan', $kd_penyewaan)->get('transaksi')->row();
        // echo json_encode($tr);
        // die;
        $data = [
            'user' => $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(),
            'kode' => $this->m_transaksi->kode('kd_penyewaan', 'transaksi', 'PNY'),
            'pl' => $this->m_transaksi->getData('pelanggan'),
            'alber' => $this->m_transaksi->getData('alat_berat'),
            'title' => 'Transaksi',
            'subtitle' => 'Form Pelunasan',
            'kd_penyewaan' => $kd_penyewaan,
            'nominal'   => $tr->nominal,
            'sisa'   => $tr->sisa,
            'pegawai' => $this->m_transaksi->getDataPegawai(),
            'tambahanBiaya' => $this->db->get('biaya_operasional')->result(),
            'tgl_berakhir' => $tr->tgl_berakhir
        ];

        if ($this->input->post()) {
            $kd_penyewaan = $this->m_transaksi->update_status2($kd_penyewaan);
            redirect('transaksi/penyewaan_alber');
        }

        $this->template->layout($pages, $data);
    }

    public function getAlatBerat($id = null)
    {
        $data  = [];
        if ($id !== null) {
            $this->db->where('id', $id);
            $this->db->select('kd_tipe,  harga_sewa, harga_sewa_khusus,nama_alber');
            $query  = $this->db->get('alat_berat')->row();

            if ($query) {
                $data = ['data' => $query, 'status' => true];
            } else {
                $data = ['data' => '', 'status' => false];
            }

            print_r(json_encode($data));
        }

        return null;
    }

    public function getSupir($id = null)
    {
        $data  = [];
        if ($id !== null) {
            $this->db->where('id', $id);
            $this->db->select('biaya, nama_pegawai');
            $query  = $this->db->get('pegawai')->row();

            if ($query) {
                $data = ['data' => $query, 'status' => true];
            } else {
                $data = ['data' => '', 'status' => false];
            }

            print_r(json_encode($data));
        }

        return null;
    }

    public function getBiayaTambahan($id = null)
    {
        $data  = [];
        if ($id !== null) {
            $this->db->where('id', $id);
            $this->db->select('harga');
            $query  = $this->db->get('biaya_operasional')->result_array();

            if ($query) {
                $data = ['data' => $query, 'status' => true];
            } else {
                $data = ['data' => '', 'status' => false];
            }

            print_r(json_encode($data));
        }

        return null;
    }

    public function pengeluaran()
    {
        $pages = 'transaksi/listpengeluaran';
        $pengeluaran = $this->db->join('alat_berat', 'alat_berat.id = transaksi_pengeluaran.alat_berat_id', 'left')->get('transaksi_pengeluaran')->result_array();
        $data = [
            'user' => $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(),
            'title' => 'Transaksi',
            'subtitle' => 'Form Pelunasan',
            'pegawai' => $this->m_transaksi->getDataPegawai(),
            'tambahanBiaya' => $this->db->get('biaya_operasional')->result(),
            'pengeluaran'   => $pengeluaran,
            'alat_berat'    => $this->db->get('alat_berat')->result(),
        ];

        if ($this->input->post()) {
            $kd_penyewaan = $this->m_transaksi->update_status2($kd_penyewaan);
            redirect('transaksi/penyewaan_alber');
        }

        $this->template->layout($pages, $data);
    }

    public function tambahPengeluaran()
    {


        $pages = 'transaksi/formpengeluaran';
        $data = [
            'user' => $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(),
            'title' => 'Transaksi',
            'subtitle' => 'Form Pelunasan',
            'pegawai' => $this->m_transaksi->getDataPegawai(),
            'tambahanBiaya' => $this->db->get('biaya_operasional')->result(),
            'alat_berat'    => $this->db->get('alat_berat')->result(),
        ];

        if ($this->input->post()) {
            $this->form_validation->set_rules('tgl_pengeluaran', 'Tanggal Pengeluaran', 'required', [
                'required' => 'kolom %s tidak boleh kosong'
            ]);
            $this->form_validation->set_rules('id_alat_berat', 'Alat Berat', 'required', [
                'required' => 'kolom %s tidak boleh kosong'
            ]);
            $this->form_validation->set_rules('nominal', 'Nominal', 'required|numeric', [
                'required' => 'kolom %s tidak boleh kosong',
                'numeric' => 'kolom %s Harus berupa angka'
            ]);

            if ($this->form_validation->run() == false) {
                $this->template->layout('transaksi/tambahPengeluaran');
            } else {
                $postPengeluaran = [
                    'alat_berat_id' => $this->input->post('id_alat_berat'),
                    'nominal' => $this->input->post('nominal'),
                    'tgl_pengeluaran' => $this->input->post('tgl_pengeluaran'),
                    'deskripsi' => $this->input->post('deskripsi'),
                ];
                $this->db->insert('transaksi_pengeluaran', $postPengeluaran);
                $alert = $this->template->alert('check', 'berhasil', 'Data Berhasil Disimpan', 'success');
                $this->session->set_flashdata('message', $alert);
                redirect('transaksi/pengeluaran');
            }
        }

        $this->template->layout($pages, $data);
    }
    public function editPengeluaran()
    {

        $this->form_validation->set_rules('tgl_pengeluaran', 'Tanggal Pengeluaran', 'required', [
            'required' => 'kolom %s tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('alat_berat', 'Alat Berat', 'required', [
            'required' => 'kolom %s tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('nominal', 'Nominal', 'required|numeric', [
            'required' => 'kolom %s tidak boleh kosong',
            'numeric' => 'kolom %s Harus berupa angka'
        ]);

        if ($this->form_validation->run() == false) {
            $this->template->layout('transaksi/pengeluaran');
        } else {
            $postPengeluaran = [
                'alat_berat_id' => $this->input->post('alat_berat'),
                'nominal' => $this->input->post('nominal'),
                'tgl_pengeluaran' => $this->input->post('tgl_pengeluaran'),
                'deskripsi' => $this->input->post('deskripsi'),
            ];
            $this->db->where('id', $this->input->post('id'))->update('transaksi_pengeluaran', $postPengeluaran);
            $alert = $this->template->alert('check', 'berhasil', 'Data Berhasil Disimpan', 'success');
            $this->session->set_flashdata('message', $alert);
            redirect('transaksi/pengeluaran');
        }
    }
}
