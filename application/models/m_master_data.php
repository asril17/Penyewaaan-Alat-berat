<?php
class m_master_data extends CI_model
{
    public function get_data($table)
    {
        return $this->db->get($table)->result_array();
    }
    public function insert_data($table, $input)
    {
        return $this->db->insert($table, $input);
    }
    public function kode($key, $table, $str)
    {
        $this->db->select('right(' . $key . ',3) as kode', false);
        $this->db->order_by('' . $key . '', 'desc');
        $this->db->limit(1);
        $query = $this->db->get($table);
        if ($query->num_rows() <> 0) {
            $data = $query->row();
            $kode = intval($data->kode) + 1;
        } else {
            $kode = 1;
        }
        $prakode = str_pad($kode, 3, '0', STR_PAD_LEFT);
        $kodejadi = $str . '-' . $prakode;
        return $kodejadi;
    }
}
