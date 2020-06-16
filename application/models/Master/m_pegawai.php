<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class m_pegawai extends CI_Model {

    public function insert_data($data,$table){
       $this->db->insert($table, $data);
    }
    public function get_data(){
        $this->db->select('*');
        $this->db->from('pegawai a');
        $this->db->join('alamat_pegawai b','a.id = b.pegawai_id');
        $this->db->where('b.status = 1');
        $data = $this->db->get();
        return($data);
    }

}

/* End of file m_pegawai.php */
