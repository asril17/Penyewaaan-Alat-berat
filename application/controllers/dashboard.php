<?php
class dashboard extends CI_controller
{
    function __construct()
    {
        parent::__construct();
        is_logged_in();
    }
    public function index()
    {
        $pages = "admin/dashboard";
        $data = [
            'user' => $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(),
            'title' => 'Dashboard'
        ];
        $this->template->layout($pages, $data);
    }
}
