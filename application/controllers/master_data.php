 <?php
    class master_data extends CI_controller
    {
        function __construct()
        {
            parent::__construct();
            is_logged_in();
            $this->load->model('m_master_data');
        }
        public function coa()
        {
            $pages = 'master_data/coa';
            $data = [
                'title'     => 'Master Data',
                'subtitle'     => 'Data Chart Of Account',
                'coa'        => $this->m_master_data->get_data('coa'),
                'user' => $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(),
            ];
            $this->form_validation->set_rules('nama_akun', 'Nama Akun', 'required', [
                'required' => 'kolom %s tidak boleh kosong'
            ]);
            $this->form_validation->set_rules('header_akun', 'Header Akun', 'required|numeric', [
                'required' => 'kolom %s tidak boleh kosong'
            ]);
            $this->form_validation->set_rules('kd_akun', 'Kode Akun', 'required|numeric', [
                'required' => 'kolom %s tidak boleh kosong'
            ]);
            if ($this->form_validation->run() == false) {
                $this->template->layout($pages, $data);
            } else {
                $inputan = [
                    'kode_akun'     => $_POST['kd_akun'],
                    'nama_akun'     => $_POST['nama_akun'],
                    'header_akun'    => $_POST['header_akun']
                ];
                $this->m_master_data->insert_data('coa', $inputan);
                $alert = $this->template->alert('check', 'berhasil', 'Data Berhasil Disimpan', 'success');
                $this->session->set_flashdata('message', $alert);
                redirect('master_data/coa');
            }
        }
        public function edit_coa()
        {

            $pages = 'master_data/coa';
            $data = [
                'title'     => 'Master Data',
                'subtitle'     => 'Data Chart Of Account',
                'coa'        => $this->m_master_data->get_data('coa'),
                'user' => $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(),
            ];
            $this->form_validation->set_rules('nama_akun', 'Nama Akun', 'required', [
                'required' => 'kolom %s tidak boleh kosong'
            ]);
            $this->form_validation->set_rules('header_akun', 'Header Akun', 'required|numeric', [
                'required' => 'kolom %s tidak boleh kosong'
            ]);
            $this->form_validation->set_rules('kd_akun', 'Kode Akun', 'required|numeric', [
                'required' => 'kolom %s tidak boleh kosong'
            ]);
            if ($this->form_validation->run() == false) {
                $this->template->layout($pages, $data);
            } else {
                $inputan = [
                    'kode_akun'     => $_POST['kd_akun'],
                    'nama_akun'     => $_POST['nama_akun'],
                    'header_akun'    => $_POST['header_akun']
                ];
                $this->db->where('kode_akun', $_POST['kd_akun'])->update('coa', $inputan);
                $alert = $this->template->alert('check', 'berhasil', 'Data Berhasil Disimpan', 'success');
                $this->session->set_flashdata('message', $alert);
                redirect('master_data/coa');
            }
        }

        public function alat_berat()
        {
            $pages = 'master_data/alat_berat';
            $data = [
                'title'     => 'Master Data',
                'subtitle'     => 'Data Alat Berat',
                'alat_berat'        => $this->db->join('jenis_alat_berat', 'jenis_alat_berat.id = alat_berat.jenis_id')
                    ->get('alat_berat')->result_array(),
                'jenis_alat_berat'        => $this->m_master_data->get_data('jenis_alat_berat'),
                'kode'              => $this->m_master_data->kode('kd_tipe', 'alat_berat', 'AB'),
                'user' => $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(),
            ];
            $this->form_validation->set_rules('nama_alber', 'Nama Alat Berat', 'required', [
                'required' => 'kolom %s tidak boleh kosong'
            ]);
            $this->form_validation->set_rules('merk', 'Merk', 'required', [
                'required' => 'kolom %s tidak boleh kosong'
            ]);
            $this->form_validation->set_rules('kd_tipe', 'Kode tipe', 'required', [
                'required' => 'kolom %s tidak boleh kosong'
            ]);
            $this->form_validation->set_rules('jenis', 'Jenis', 'required', [
                'required' => 'kolom %s tidak boleh kosong'
            ]);
            $this->form_validation->set_rules('harga_sewa', 'Harga Sewa', 'required|numeric', [
                'required' => 'kolom %s tidak boleh kosong'
            ]);
            $this->form_validation->set_rules('harga_sewa_khusus', 'Harga Sewa Khusus', 'required|alpha_numeric', [
                'required' => 'kolom %s tidak boleh kosong'
            ]);
            if ($this->form_validation->run() == false) {
                $this->template->layout($pages, $data);
            } else {
                $inputan = [
                    'kd_tipe'       => $_POST['kd_tipe'],
                    'nama_alber'    => $_POST['nama_alber'],
                    'jenis_id'    => $_POST['jenis'],
                    'merk'          => $_POST['merk'],
                    'harga_sewa'    => $_POST['harga_sewa'],
                    'harga_sewa_khusus'          => $_POST['harga_sewa_khusus']
                ];
                $this->m_master_data->insert_data('alat_berat', $inputan);
                $alert = $this->template->alert('check', 'berhasil', 'Data Berhasil Disimpan', 'success');
                $this->session->set_flashdata('message', $alert);
                redirect('master_data/alat_berat');
            }
        }
        public function edit_alat_berat()
        {
            $pages = 'master_data/alat_berat';
            $data = [
                'title'     => 'Master Data',
                'subtitle'     => 'Data Alat Berat',
                'alat_berat'        => $this->db->join('jenis_alat_berat', 'jenis_alat_berat.id = alat_berat.jenis_id')
                    ->get('alat_berat')->result_array(),
                'jenis_alat_berat'        => $this->m_master_data->get_data('jenis_alat_berat'),
                'kode'              => $this->m_master_data->kode('kd_tipe', 'alat_berat', 'AB'),
                'user' => $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(),
            ];
            $this->form_validation->set_rules('nama_alber', 'Nama Alat Berat', 'required', [
                'required' => 'kolom %s tidak boleh kosong'
            ]);
            $this->form_validation->set_rules('merk', 'Merk', 'required', [
                'required' => 'kolom %s tidak boleh kosong'
            ]);
            $this->form_validation->set_rules('kd_tipe', 'Kode tipe', 'required', [
                'required' => 'kolom %s tidak boleh kosong'
            ]);
            $this->form_validation->set_rules('jenis', 'Jenis', 'required', [
                'required' => 'kolom %s tidak boleh kosong'
            ]);
            $this->form_validation->set_rules('harga_sewa', 'Harga Sewa', 'required|numeric', [
                'required' => 'kolom %s tidak boleh kosong',
                'numeric' => 'kolom %s harus berupa angka'
            ]);
            $this->form_validation->set_rules('harga_sewa_khusus', 'Harga Sewa Khusus', 'required|numeric', [
                'required' => 'kolom %s tidak boleh kosong',
                'numeric' => 'kolom %s harus berupa angka'
            ]);
            if ($this->form_validation->run() == false) {
                $this->template->layout($pages, $data);
            } else {
                $inputan = [
                    'kd_tipe'       => $_POST['kd_tipe'],
                    'nama_alber'    => $_POST['nama_alber'],
                    'jenis_id'    => $_POST['jenis'],
                    'merk'          => $_POST['merk'],
                    'harga_sewa'    => $_POST['harga_sewa'],
                    'harga_sewa_khusus'          => $_POST['harga_sewa_khusus']
                ];
                $this->db->where('id', $_POST['id'])->update('alat_berat', $inputan);
                $alert = $this->template->alert('check', 'berhasil', 'Data Berhasil Disimpan', 'success');
                $this->session->set_flashdata('message', $alert);
                redirect('master_data/alat_berat');
            }
        }

        public function jenis_alat_berat()
        {
            $pages = 'master_data/jenis_alat_berat';
            $data = [
                'title'     => 'Master Data',
                'subtitle'     => 'Data Jenis Alat Berat',
                'kode'              => $this->m_master_data->kode('kode_jenis', 'jenis_alat_berat', 'JB'),
                'user' => $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(),
            ];
            $data['list'] = $this->db->get('jenis_alat_berat')->result_array();
            // $this->template->layout($pages, $data);

            $this->form_validation->set_rules('jenis', 'Jenis', 'required', [
                'required' => 'kolom %s tidak boleh kosong'
            ]);
            if ($this->form_validation->run() == false) {
                $this->template->layout($pages, $data);
            } else {
                $inputan = [
                    'kode_jenis'       => $_POST['kode_jenis'],
                    'jenis'    => $_POST['jenis']
                ];
                $this->m_master_data->insert_data('jenis_alat_berat', $inputan);
                $alert = $this->template->alert('check', 'berhasil', 'Data Berhasil Disimpan', 'success');
                $this->session->set_flashdata('message', $alert);
                redirect('master_data/jenis_alat_berat');
            }
        }

        public function edit_jenis_alat_berat()
        {
            $this->form_validation->set_rules('jenis', 'Jenis', 'required', [
                'required' => 'kolom %s tidak boleh kosong'
            ]);
            if ($this->form_validation->run() == true) {
                $p = $this->input->post();
                $response = $this->db->where('id', $p['id'])
                    ->update('jenis_alat_berat', ['jenis' => $p['jenis']]);
                if ($response) {
                    $alert = $this->template->alert('check', 'berhasil', 'Data Berhasil Disimpan', 'success');
                    $this->session->set_flashdata('message', $alert);
                    redirect('master_data/jenis_alat_berat');
                } else {
                    $alert = $this->template->alert('check', 'berhasil', 'Data Gagal Disimpan', 'error');
                    $this->session->set_flashdata('message', $alert);
                    redirect('master_data/jenis_alat_berat');
                }
            } else {
                redirect('master_data/jenis_alat_berat');
            }
        }




        public function pegawai()
        {
            $pages = 'master_data/pegawai';
            $data = [
                'title'     => 'Master Data',
                'subtitle'     => 'Data Pegawai',
                'pegawai'        => $this->m_master_data->get_data('pegawai'),
                'user' => $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(),
                'kode'              => $this->m_master_data->kode('kd_pegawai', 'pegawai', 'SPR')
            ];
            $this->form_validation->set_rules('kd_pegawai', 'Kode Pegawai', 'required', [
                'required' => 'kolom %s tidak boleh kosong'
            ]);
            $this->form_validation->set_rules('nama_pegawai', 'Nama Pegawai', 'required|alpha', [
                'required' => 'kolom %s tidak boleh kosong'
            ]);
            $this->form_validation->set_rules('alamat', 'Alamat Pegawai', 'required', [
                'required' => 'kolom %s tidak boleh kosong'
            ]);
            $this->form_validation->set_rules('no_telp', 'No Telfon Pegawai', 'required|numeric', [
                'required' => 'kolom %s tidak boleh kosong'
            ]);
            $this->form_validation->set_rules('biaya', 'Tarif Pegawai', 'required|numeric', [
                'required' => 'kolom %s tidak boleh kosong'
            ]);
            if ($this->form_validation->run() == false) {
                $this->template->layout($pages, $data);
            } else {
                $inputan = [
                    'kd_pegawai'     => $_POST['kd_pegawai'],
                    'nama_pegawai'     => $_POST['nama_pegawai'],
                    'biaya'    => $_POST['biaya'],
                    'no_telp'    => $_POST['no_telp'],
                    'alamat'    => $_POST['alamat'],
                ];
                $this->m_master_data->insert_data('pegawai', $inputan);
                $alert = $this->template->alert('check', 'berhasil', 'Data Berhasil Disimpan', 'success');
                $this->session->set_flashdata('message', $alert);
                redirect('master_data/pegawai');
            }
        }
        public function edit_pegawai()
        {

            $this->form_validation->set_rules('kd_pegawai', 'Kode Pegawai', 'required', [
                'required' => 'kolom %s tidak boleh kosong'
            ]);
            $this->form_validation->set_rules('nama_pegawai', 'Nama Pegawai', 'required|alpha', [
                'required' => 'kolom %s tidak boleh kosong'
            ]);
            $this->form_validation->set_rules('alamat', 'Alamat Pegawai', 'required', [
                'required' => 'kolom %s tidak boleh kosong'
            ]);
            $this->form_validation->set_rules('no_telp', 'No Telfon Pegawai', 'required|numeric', [
                'required' => 'kolom %s tidak boleh kosong'
            ]);
            $this->form_validation->set_rules('biaya', 'Tarif Pegawai', 'required|numeric', [
                'required' => 'kolom %s tidak boleh kosong'
            ]);
            if ($this->form_validation->run() == false) {
                redirect('master_data/pegawai');
            } else {
                $inputan = [
                    'kd_pegawai'     => $_POST['kd_pegawai'],
                    'nama_pegawai'     => $_POST['nama_pegawai'],
                    'biaya'    => $_POST['biaya'],
                    'no_telp'    => $_POST['no_telp'],
                    'alamat'    => $_POST['alamat'],
                ];
                $this->db->where('id', $_POST['id'])
                    ->update('pegawai', $inputan);
                $alert = $this->template->alert('check', 'berhasil', 'Data Berhasil Disimpan', 'success');
                $this->session->set_flashdata('message', $alert);
                redirect('master_data/pegawai');
            }
        }


        public function pelanggan()
        {
            $pages = 'master_data/pelanggan';
            $data = [
                'user' => $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(),
                'title'     => 'Master Data',
                'subtitle'     => 'Data pelanggan',
                'pelanggan'        => $this->m_master_data->get_data('pelanggan'),
                'kode'              => $this->m_master_data->kode('kd_pelanggan', 'pelanggan', 'PGN')
            ];
            $this->form_validation->set_rules('kd_pelanggan', 'Kode pelanggan', 'required', [
                'required' => 'kolom %s tidak boleh kosong'
            ]);
            $this->form_validation->set_rules('nama_pelanggan', 'Nama pelanggan', 'required|alpha', [
                'required' => 'kolom %s tidak boleh kosong'
            ]);
            $this->form_validation->set_rules('alamat', 'Alamat pelanggan', 'required', [
                'required' => 'kolom %s tidak boleh kosong'
            ]);
            $this->form_validation->set_rules('no_telp', 'No Telfon pelanggan', 'required|numeric', [
                'required' => 'kolom %s tidak boleh kosong'
            ]);
            if ($this->form_validation->run() == false) {
                $this->template->layout($pages, $data);
            } else {
                $inputan = [
                    'kd_pelanggan'     => $_POST['kd_pelanggan'],
                    'nama_pelanggan'     => $_POST['nama_pelanggan'],
                    'alamat'    => $_POST['alamat'],
                    'no_telp'    => $_POST['no_telp']
                ];
                $this->m_master_data->insert_data('pelanggan', $inputan);
                $alert = $this->template->alert('check', 'berhasil', 'Data Berhasil Disimpan', 'success');
                $this->session->set_flashdata('message', $alert);
                redirect('master_data/pelanggan');
            }
        }
        public function user()
        {
            echo "TEST";
            $this->load->view('view_user');
        }

        public function edit_pelanggan()
        {

            $p = $this->input->post();

            $data = [
                'nama_pelanggan' => $p['nama_pelanggan'],
                'alamat' => $p['alamat'],
                'no_telp' => $p['no_telp'] . ', ' . $p['no_telp_sebelum']
            ];

            $respone = $this->db->where('id', $p['id'])
                ->update('pelanggan', $data);

            if ($respone) {
                $alert = $this->template->alert('check', 'berhasil', 'Data Berhasil Disimpan', 'success');
                $this->session->set_flashdata('message', $alert);
            } else {
                $alert = $this->template->alert('check', 'berhasil', 'Data Berhasil Disimpan', 'success');
                $this->session->set_flashdata('message', $alert);
            }
            redirect('master_data/pelanggan');
        }


        public function profil()
        {
            $pages = 'master_data/profil';
            $data = [
                'user' => $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(),
                'title'     => 'Master Data',
                'subtitle'     => 'Data Profil',
                'pelanggan'        => $this->m_master_data->get_data('pelanggan'),
                'kode'              => $this->m_master_data->kode('kd_pelanggan', 'pelanggan', 'PGN')
            ];
            $this->form_validation->set_rules('kd_pelanggan', 'Kode pelanggan', 'required', [
                'required' => 'kolom %s tidak boleh kosong'
            ]);
            $this->form_validation->set_rules('nama_pelanggan', 'Nama pelanggan', 'required|alpha', [
                'required' => 'kolom %s tidak boleh kosong'
            ]);
            $this->form_validation->set_rules('alamat', 'Alamat pelanggan', 'required', [
                'required' => 'kolom %s tidak boleh kosong'
            ]);
            $this->form_validation->set_rules('no_telp', 'No Telfon pelanggan', 'required|numeric', [
                'required' => 'kolom %s tidak boleh kosong'
            ]);
            if ($this->form_validation->run() == false) {
                $this->template->layout($pages, $data);
            } else {
                $inputan = [
                    'kd_pelanggan'     => $_POST['kd_pelanggan'],
                    'nama_pelanggan'     => $_POST['nama_pelanggan'],
                    'alamat'    => $_POST['alamat'],
                    'no_telp'    => $_POST['no_telp']
                ];
                $this->m_master_data->insert_data('pelanggan', $inputan);
                $alert = $this->template->alert('check', 'berhasil', 'Data Berhasil Disimpan', 'success');
                $this->session->set_flashdata('message', $alert);
                redirect('master_data/pelanggan');
            }
        }
    }
