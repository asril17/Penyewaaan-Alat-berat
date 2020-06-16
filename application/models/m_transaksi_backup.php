<?php
class m_transaksi extends CI_model
{
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
    
    public function getDataPegawai() 
    {
        return $this->db->get_where('pegawai',['status_sopir'=>0])->result_array();
    }
    public function getData($table) 
    {
        return $this->db->get_where($table)->result_array();
    }
    
    public function tambahDetailPny()
    {
        $this->db->where('kd_tipe', $_POST['kd_alat_berat']);
        $harga = $this->db->get('alat_berat')->row()->harga_sewa;
        $this->db->where(array(
            'kd_penyewaan' => $_POST['kd_penyewaan'],
            'kd_pelanggan' => $_POST['kd_pelanggan'],
            'kd_alat_berat' => $_POST['kd_alat_berat'],

        ));
        $query = $this->db->get('transaksi_detail');
        if ($query->num_rows() == 0) {
            $tanggal1 = time();
            $tanggal2 = strtotime($_POST['tgl_expired']);
            $date_diff = $tanggal2 - $tanggal1;
            $lama = round($date_diff / (60 * 60 * 24));
            if ($_POST['kd_pegawai'] != 1) {
                $subtotal = ($harga + 200000) * $lama;
            } else {
                $subtotal = $harga  * $lama;
            }
            $data = [
                'kd_penyewaan' => $_POST['kd_penyewaan'],
                'kd_pelanggan' => $_POST['kd_pelanggan'],
                'kd_alat_berat' => $_POST['kd_alat_berat'],
                'kd_pegawai' => $_POST['kd_pegawai'],
                'harga'         => $harga,
                'subtotal'      => $subtotal,
                'lama_penyewaan' => $lama,
                'tgl_expired'    => $_POST['tgl_expired']
            ];
            $data2=[
                'status_sopir'  => 1
            ];
            $this->db->trans_start();
            $this->db->insert('transaksi_detail', $data);
            $this->db->where('kd_pegawai',$_POST['kd_pegawai']);
            $this->db->update('pegawai',$data2);
            $this->db->trans_complete();
        } else {
            $this->db->set('subtotal', 'subtotal + ' . $harga * $lama . '', false);
            $this->db->where(array(
                'kd_penyewaan' => $_POST['kd_penyewaan'],
                'kd_pelanggan' => $_POST['kd_pelanggan'],
                'kd_alat_berat' => $_POST['kd_alat_berat'],
            ));
            $this->db->update('transaksi_detail');
        }
    }
    public function getDetail($id)
    {
     $this->db->select('a.kd_penyewaan, nama_pelanggan, nama_alber, harga_sewa,tgl_berakhir,nama_pegawai,a.pegawai_id');
     $this->db->from('transaksi a');
     $this->db->join('transaksi_detail e', 'a.id=e.transaksi_id');
     $this->db->join('alat_berat b', 'a.alat_berat_id=b.id');
     $this->db->join('pelanggan c', 'a.pelanggan_id=c.id', 'outter');
     $this->db->join('pegawai d', 'a.pegawai_id=d.id');
     $this->db->where('kd_penyewaan', $id);
     return $this->db->get()->result_array();
 }

 public function update_status2($level, $kd_penyewaan){
    $get = $this->db->get_where('penyewaan',['kd_penyewaan' => $kd_penyewaan])->row_array();
    $nominal_bayar = $get['jml_bayar'] + $get['sisa'];

    $data =[
        'pelunasan'         => $nominal_bayar,
        'sisa'              => 0,
        'status'            => $level   
    ];
    $this->db->where('kd_penyewaan', $kd_penyewaan);
    return $this->db->update('penyewaan',$data);
}
}
