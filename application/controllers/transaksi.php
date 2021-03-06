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
        $valid = true;
        // KONDISI UNTUK STATUS ALAT BERAT DAN PEGAWAI PADA SAAT PENYEWAAN
        foreach ($trans as $row) {

            if (strtotime($current) < strtotime($row['tgl_berakhir'])) {
                $valid = false;
            }
            if ($row['status'] == '1') {
                $valid = true;
            }

            if ($valid == true) {
                $this->db->where('id', $row['pegawai_id'])
                    ->update('pegawai', ['status_sopir' => '0']);
                $this->db->where('id', $row['alat_berat_id'])
                    ->update('alat_berat', ['status' => '0']);
            } else {
                $this->db->where('id', $row['pegawai_id'])
                    ->update('pegawai', ['status_sopir' => '1']);
                $this->db->where('id', $row['alat_berat_id'])
                    ->update('alat_berat', ['status' => '1']);
            }
        }
        // END KONDISI

        $pages = 'transaksi/penyewaanAlatBerat';
        $data = [
            'user' => $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(),
            // 'kode' => $this->m_transaksi->kode('kd_penyewaan', 'penyewaan', 'PNY'),
            'pny' => $this->m_transaksi->getDataWithPajak(),
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
            'alber' => $this->m_transaksi->getDataAlatBerat(),
            'title' => 'Transaksi',
            'subtitle' => 'Form Input Penyewaan',
            'pegawai' => $this->m_transaksi->getDataPegawai(),
            'tambahanBiaya' => $this->db->get('biaya_operasional')->result(),
        ];

        // $data['detail'] = $this->m_transaksi->getDetail($data['kode']);

        if ($this->input->post()) {

            // dd($this->input->post());
            // die;
            $validation =  $this->m_transaksi->_validation();
            if ($validation == false) {
                $this->template->layout($pages, $data);
            } else {
                $ts1 = new DateTime($this->input->post('tgl_sewa'));
                $ts2 = new DateTime($this->input->post('tgl_expired'));
                // $date1 = date_create($this->input->post('tgl_sewa'));
                // $date2 = date_create($this->input->post('tgl_expired'));
                // $diff = date_diff($date1, $date2);
                $diff = $ts2->diff($ts1)->days;
                $hari = $diff;
                // dd($this->input->post());
                // die;
                $bensin = $this->input->post('bensin');
                $harga_bensin = $this->input->post('harga_bensin');

                // KONDISI PENGGUNAAN HARGA UMUM ATAU KHUSUS
                if (format_angka($this->input->post('harga_khusus')) <= 0) {
                    $harga_umum  = format_angka($this->input->post('harga_umum'));
                    $harga_sewa = $harga_umum;
                } else {
                    $harga_khusus = format_angka($this->input->post('harga_khusus'));
                    $harga_umum = $harga_khusus;
                    $harga_sewa = $harga_khusus;
                }
                // END KONDISI PENGGUNAAN HARGA UMUM ATAU KHUSUS


                // KONDISI APABILA PEGAWAI DI PILIH ATAU TIDAK
                $set_pajak = 0;
                $gaji = 0;
                if ($this->input->post('kd_pegawai') != '') {

                    $pegawai = $this->db->where('id', $this->input->post('kd_pegawai'))->get('pegawai')->row();
                    // $alber = $this->db->where('id', $this->input->post('id_alatberat'))->get('alat_berat')->row();
                    $pajak_pegawai = 0;
                    // if (!empty($pegawai->id !== 1)) {
                    // KONDISI KENA PAJAK APABILA LEBIH DARI 7 HARI
                    if ($hari > 7) {
                        $set_pajak += ($harga_umum * 2 / 100) * $hari;
                    }
                    // END KONDISI PAJAK
                    // $subtotal = ($harga_sewa + $pegawai->biaya) * $hari + $set_pajak;
                    $subtotal = ($harga_sewa * $hari) + $set_pajak;

                    $gaji  += $pegawai->biaya * $hari;
                    $pajak = 25;
                    $pajak_pegawai += $gaji * 25 / 100;

                    $this->db->where('id', $this->input->post('kd_pegawai'))
                        ->update('pegawai', ['status_sopir' => '1']);
                } else {
                    // KONDISI KENA PAJAK APABILA LEBIH DARI 7 HARI
                    if ($hari > 7) {
                        $set_pajak += ($harga_umum * 2 / 100) * $hari;
                    }
                    // END KONDISI PAJAK
                    $subtotal = $harga_sewa  * $hari + $set_pajak;
                }
                // END KONDISI PEGAWAI

                // KONDISI TAMBAHAN BENSIN
                $total_bensin = 0;
                if ($bensin != '' || $bensin != 0 || $harga_bensin != '' || $harga_bensin != 0) {
                    // $subtotal += $bensin * format_angka($harga_bensin);
                    $total_bensin += $bensin * format_angka($harga_bensin);
                }
                // END BENSIN

                // $nominal_pajak = $pajak_pegawai + $set_pajak;
                $nominal_pajak = $set_pajak;
                $DP = $subtotal - $this->input->post('DP');

                if ($DP == 0) {
                    $status_pelunasan = 1;
                } else {
                    $status_pelunasan = 0;
                }

                $transaksi = $this->db->where('kd_penyewaan', $this->input->post('kd_penyewaan'))->get('transaksi')->row();
                // INSERT PENYEWAAN KE TABEL TRANSAKSI
                $transaksiPost = [
                    'alat_berat_id' => $this->input->post('id_alatberat'),
                    'kd_penyewaan' => $this->input->post('kd_penyewaan'),
                    'pelanggan_id' => $this->input->post('kd_pelanggan'),
                    'pegawai_id' => $this->input->post('kd_pegawai'),
                    'tgl_mulai' => $this->input->post('tgl_sewa'),
                    'tgl_berakhir' => $this->input->post('tgl_expired'),
                    'nominal'      => $subtotal,
                    'jml_bayar'      => $this->input->post('DP'),
                    'sisa'      => $DP,
                    'status'       => $status_pelunasan,
                    'user_id'      => $this->session->userdata('userId'),
                ];

                $saveTransaksi  = $this->db->insert('transaksi', $transaksiPost);
                // END INSERT PENYEWAAN
                $id = $this->db->insert_id();

                // BUAT JURNAL PENYEWAAN
                $pajak_dp = $DP * 2 / 100;
                $this->m_laporan->insertJurnal('111', date('Y-m-d'), ($this->input->post('DP') - $pajak_dp), 'debit');
                $this->m_laporan->insertJurnal('112', date('Y-m-d'), $DP, 'debit');
                $this->m_laporan->insertJurnal('113', date('Y-m-d'), $pajak_dp, 'debit');
                $this->m_laporan->insertJurnal('411', date('Y-m-d'), $subtotal, 'kredit');
                // END JURNAL PENYEWAAN

                if ($saveTransaksi) {
                    $this->db->trans_start();
                    $totalBiaya = 0;

                    // KONDISI TRANSAKSI TAMBAHAN LAIN LAIN
                    // if ($bensin != '' || $bensin != 0 || $harga_bensin != '' || $harga_bensin != 0) {
                    $postdetailTambahanBensin = [
                        'id_transaksi' => $id,
                        'jenis_tambahan' => 'Bensin',
                        'total' => $total_bensin,
                    ];
                    $this->db->insert('transaksi_detail_tambahan', $postdetailTambahanBensin);

                    $postdetailTambahanPegawai = [
                        'id_transaksi' => $id,
                        'jenis_tambahan' => 'Sopir',
                        'total' => $gaji,
                    ];
                    $this->db->insert('transaksi_detail_tambahan', $postdetailTambahanPegawai);
                    $total_tambahan = $total_bensin + $gaji;
                    $this->m_laporan->insertJurnal('111', date('Y-m-d'), $total_tambahan, 'debit');
                    $this->m_laporan->insertJurnal('412', date('Y-m-d'), $total_tambahan, 'kredit');

                    $upal = $this->db->where('id', $this->input->post('id_alatberat'))
                        ->update('alat_berat', ['status' => '1']);
                    // }
                    // END TAMBAHAN LAIN LAIN

                    // KONDISI TRANSAKSI GAJI ATAU PERSENAN PEGAWAI
                    if ($this->input->post('kd_pegawai') != '') {
                        $this->db->insert('daftar_pemasukan_pegawai', ['transaksi_id' => $id, 'nominal' => $gaji, 'persen' => $pajak]);
                    }
                    // END KONDISI

                    // INSERT PAJAK KEDALAM TABEL DAFTAR PAJAK
                    $this->db->insert('daftar_pajak', ['nominal_pajak' => $nominal_pajak, 'transaksi_id' => $id]);
                    // END PAJAK
                    $this->db->trans_complete();
                    redirect('transaksi/penyewaan_alber');
                }
            }
        }
        $this->template->layout($pages, $data);
    }
    // public function selesaiPny()
    // {
    //     $sisa = $_POST['nominal'] - $_POST['jml'];
    //     if ($_POST['jml'] == $_POST['nominal']) {
    //         $status = 1;
    //         $this->m_laporan->insertJurnal('111', date('Y-m-d'), $_POST['nominal'], 'debit');
    //         $this->m_laporan->insertJurnal('411', date('Y-m-d'), $_POST['nominal'], 'kredit');
    //     } else {
    //         $this->m_laporan->insertJurnal('111', date('Y-m-d'), $_POST['jml'], 'debit');
    //         $this->m_laporan->insertJurnal('112', date('Y-m-d'), $sisa, 'debit');
    //         $this->m_laporan->insertJurnal('411', date('Y-m-d'), $_POST['nominal'], 'kredit');
    //         $status = 2;
    //     }
    //     $data = [
    //         'kd_penyewaan' => $_POST['kd_penyewaan'],
    //         'tgl_penyewaan' => date('Y-m-d'),
    //         'tgl_expired' => $_POST['tgl_expired'],
    //         'nominal' => $_POST['nominal'],
    //         'jml_bayar' => $_POST['jml'],
    //         'sisa' => $sisa,
    //         'status'    => $status
    //     ];

    //     $this->db->insert('penyewaan', $data);
    //     redirect('transaksi/penyewaan_alber');
    // }
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
        // dd($data['sisa']);
        // die;

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

    public function getJenisBeban()
    {
        $jenis = $this->input->post('jenis');

        // KONDISI PENCARIAN BEBAN BERDASARKAN JENIS PENGELUARAN
        if ($jenis == 'Alat berat') {
            $this->db->where('kode_akun', '513');
            $this->db->or_where('kode_akun', '514');
        } else if ($jenis == 'Pegawai') {
            $this->db->where('kode_akun', '511');
            $this->db->or_where('kode_akun', '512');
        } else {
            $this->db->where('kode_akun', '515');
            $this->db->or_where('kode_akun', '516');
            $this->db->or_where('kode_akun', '517');
        }
        $this->db->select('kode_akun, nama_akun');
        // END KONDISI
        $query = $this->db->get('coa')->result_array();

        if ($query != '') {
            $response['data'] = $query;
            $response['status'] = true;
        } else {
            $response['status'] = false;
        }

        echo json_encode($response);
    }

    public function pengeluaran()
    {
        $pages = 'transaksi/listpengeluaran';
        $pengeluaran = $this->db->get('transaksi_pengeluaran2')->result_array();
        $data = [
            'user' => $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(),
            'title' => 'Transaksi',
            'subtitle' => 'Form Pengeluaran',
            'pegawai' => $this->m_transaksi->getDataPegawai(),
            'tambahanBiaya' => $this->db->get('biaya_operasional')->result(),
            'pengeluaran'   => $pengeluaran,
            'alat_berat'    => $this->db->get('alat_berat')->result(),
        ];

        if ($this->input->post()) {
            // $kd_penyewaan = $this->m_transaksi->update_status2($kd_penyewaan);
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
            'subtitle' => 'Form Pengeluaran',
            'pegawai' => $this->m_transaksi->getDataPegawai(),
            'tambahanBiaya' => $this->db->get('biaya_operasional')->result(),
            'alat_berat'    => $this->db->get('alat_berat')->result(),
        ];

        if ($this->input->post()) {
            $this->form_validation->set_rules('tgl_pengeluaran', 'Tanggal Pengeluaran', 'required', [
                'required' => 'kolom %s tidak boleh kosong'
            ]);
            $this->form_validation->set_rules('jenis_pengeluaran', 'Jenis Pengeluaran', 'required', [
                'required' => 'kolom %s tidak boleh kosong'
            ]);
            $this->form_validation->set_rules('nominal', 'Nominal', 'required|numeric', [
                'required' => 'kolom %s tidak boleh kosong',
                'numeric' => 'kolom %s Harus berupa angka'
            ]);
            $this->form_validation->set_rules('jenis_beban', 'Jenis Beban', 'required', [
                'required' => 'kolom %s tidak boleh kosong'
            ]);

            if ($this->form_validation->run() == false) {
                // $this->template->layout($pages, $data);
                redirect('transaksi/tambahPengeluaran');
            } else {
                // var_dump($this->input->post('jenis_pengeluaran'));
                // die;
                $postPengeluaran = [
                    'jenis_pengeluaran' => $this->input->post('jenis_pengeluaran'),
                    'nominal' => $this->input->post('nominal'),
                    'tgl_pengeluaran' => $this->input->post('tgl_pengeluaran'),
                    'deskripsi' => $this->input->post('deskripsi'),
                    'id_coa' => $this->input->post('jenis_beban')
                ];
                $penge = $this->db->insert('transaksi_pengeluaran2', $postPengeluaran);

                if ($penge) {
                    $id_coa = $this->input->post('jenis_beban');
                    $nominal = $this->input->post('nominal');
                    $this->m_laporan->insertJurnal($id_coa, date('Y-m-d'), $nominal, 'debit');
                    $this->m_laporan->insertJurnal('111', date('Y-m-d'), $nominal, 'kredit');
                    $alert = $this->template->alert('check', 'berhasil', 'Data Berhasil Disimpan', 'success');
                    $this->session->set_flashdata('message', $alert);
                    redirect('transaksi/pengeluaran');
                }
            }
        }

        $this->template->layout($pages, $data);
    }
    public function editPengeluaran()
    {

        $this->form_validation->set_rules('tgl_pengeluaran', 'Tanggal Pengeluaran', 'required', [
            'required' => 'kolom %s tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('jenis_pengeluaran', 'Jenis Pengeluaran', 'required', [
            'required' => 'kolom %s tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('nominal', 'Nominal', 'required|numeric', [
            'required' => 'kolom %s tidak boleh kosong',
            'numeric' => 'kolom %s Harus berupa angka'
        ]);

        if ($this->form_validation->run() == false) {
            redirect('transaksi/pengeluaran');
        } else {
            $postPengeluaran = [
                'jenis_pengeluaran' => $this->input->post('jenis_pengeluaran'),
                'nominal' => $this->input->post('nominal'),
                'tgl_pengeluaran' => $this->input->post('tgl_pengeluaran'),
                'deskripsi' => $this->input->post('deskripsi'),
            ];
            $this->db->where('id', $this->input->post('id'))->update('transaksi_pengeluaran2', $postPengeluaran);
            $alert = $this->template->alert('check', 'berhasil', 'Data Berhasil Disimpan', 'success');
            $this->session->set_flashdata('message', $alert);
            redirect('transaksi/pengeluaran');
        }
    }
}
