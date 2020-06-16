<?php
function get_prefix($table)
{
    $table = strtolower($table);
    switch ($table) {
        case 'alat_berat':
            return 'AB';
            break;
        case 'pegawai':
            return 'PGW';
            break;
        case 'pelanggan':
            return 'PGN';
            break;
    }
}
function format_rp($number)
{
    return "Rp." . number_format($number, 0, ',', '.');
}
function is_logged_in()
{
    $ci = get_instance();
    if (!$ci->session->userdata('email')) {
        redirect('auth');
    } else {
        $role_id = $ci->session->userdata('role_id');
        $menu = $ci->uri->segment(1);
        $queryMenu = $ci->db->get_where('user_menu', ['menu' => $menu])->row_array();

        $menu_id = $queryMenu['id'];
        $accessMenu = $ci->db->get_where('user_access_menu', [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ]);
        if ($accessMenu->num_rows() < 1) {
            redirect('auth/blocked');
        }
    }
}
