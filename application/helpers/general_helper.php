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
function get_monthname($number)
{
    if ($number == 1 or $number ==  "01") {
        return "Januari";
    } else if ($number == 2 or $number == "02") {
        return "Februari";
    } else if ($number == 3 or $number ==  "03") {
        return "Maret";
    } else if ($number == 4 or  $number == "04") {
        return "April";
    } else if ($number == 5 or  $number == "05") {
        return "Mei";
    } else if ($number == 6 or  $number == "06") {
        return "Juni";
    } else if ($number == 7 or  $number == "07") {
        return "Juli";
    } else if ($number == 8 or  $number == "08") {
        return "Agustus";
    } else if ($number == 9 or $number == "09") {
        return "September";
    } else if ($number == "10") {
        return "Oktober";
    } else if ($number == "11") {
        return "November";
    } else if ($number == "12") {
        return "Desember";
    }
}
function dd($arr)
{
    echo "<pre>" . print_r($arr, true) . "</pre>";
}
function format_angka($a)
{
    $angka = preg_replace("/[^0-9]/", "", $a);
    return $angka * 1;
}
function format_rp($number)
{
    return "Rp. " . number_format($number, 0, ',', '.');
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
