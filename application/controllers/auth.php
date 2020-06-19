<?php

class auth extends CI_controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
	}

	public function index()
	{
		if ($this->session->userdata('email')) {
			redirect('user');
		}
		$this->form_validation->set_rules('username', 'Username', 'required|trim');
		$this->form_validation->set_rules('password', 'Password', 'required|trim');
		if ($this->form_validation->run() == false) {
			$this->load->view('auth/login');
		} else {
			$this->_login();
		}
	}
	private function _login()
	{
		$username = $_POST['username'];
		$password = $_POST['password'];
		$user = $this->db->get_where('user', ['username' => $username])->row_array();
		$role = $this->db->get_where('user_role', ['id' => $user['role_id']])->row_array();
		//cek email apakah sudah teregister atau belum
		if ($user) {
			//cek akun apakah aktif atau tidak aktiv
			if ($user['is_active'] == 1) {
				//cek password
				if (password_verify($password, $user['password'])) {
					$data = [
						'email'   => $user['email'],
						'role_id' => $user['role_id'],
						'userId'  => $user['id_user'],
						'role' => $role['role']
					];
					$this->session->set_userdata($data);
					if ($user['role_id'] == 1) {
						redirect('index.php/dashboard');
					} else {
						redirect('index.php/dashboard');
					}
				} else {
					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
					 Wrong password! </div>');
					redirect('index.php/auth');
				}
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
				This email has not been activated! </div>');
				redirect('index.php/auth');
			}
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
			Email is not registered! </div>');
			redirect('index.php/auth');
		}
	}
	public function register()
	{
		if ($this->session->userdata('email')) {
			redirect('index.php/user');
		}
		$this->form_validation->set_rules('name', 'Name', 'required|trim');
		$this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[user.email]', [
			'is_unique' => 'this %s has already exist!'
		]);
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
			'is_unique' => 'this email has already registered!'
		]);
		$this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
			'matches' => "Password Don't Match!",
			'min_length' => "Password too short!"
		]);
		$this->form_validation->set_rules('password2', 'Password', 'required|trim|min_length[3]|matches[password1]');
		if ($this->form_validation->run() == false) {
			$this->load->view('auth/register');
		} else {
			$data = [
				'name' 			=> $_POST['name'],
				'email' 		=> $_POST['email'],
				'image' 		=> 'default.jpg',
				'username'		=> $_POST['username'],
				'password'		=> password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
				'role_id' 		=> 2,
				'is_active'		=> 1,
				'date_created' 	=> time(),
			];
			//siapkan token
			// $token = md5(uniqid(rand(32), true));
			// $user_token = [
			// 	'email' => $_POST['email'],
			// 	'token' => $token,
			// 	'date_created' => time()
			// ];
			$this->db->insert('user', $data);
			// $this->db->insert('user_token', $user_token);
			// $this->_sendemail($token, 'verify');
			// $alert = $this->template->alert('berhasil', 'Congratulation! your account has been created. Please Activate Your account', 'success');
			$this->session->set_flashdata(
				'message',
				'<div class="alert alert-success" role="alert">
                <strong>Well done!</strong> Your account has been activated, please login.
            </div>'
			);
			redirect('index.php/auth');
		}
	}
	public function logout()
	{
		$this->session->unset_userdata('email');
		$this->session->unset_userdata('role_id');
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
		You have been logout </div>');
		redirect('index.php/auth');
	}
}
