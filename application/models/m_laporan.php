<?php

class m_laporan extends CI_model
{
    public function insertJurnal($kode, $tgl, $nominal, $posisi)
    {
        $data = [
            'kode_akun'  => $kode,
            'tgl_jurnal'    => $tgl,
            'nominal'       => $nominal,
            'posisi_dr_cr'       => $posisi,
        ];
        $this->db->insert('jurnal', $data);
    }
    function get_jurnal($bulan, $tahun)
    {
        $this->db->select('*');
        $this->db->from('jurnal a');
        $this->db->join('coa b', 'b.kode_akun=a.kode_akun');
        $this->db->where('DATE_FORMAT(tgl_jurnal,"%m")', $bulan);
        $this->db->where('DATE_FORMAT(tgl_jurnal,"%Y")', $tahun);
        $this->db->order_by('a.id');
        return $this->db->get()->result_array();
    }
    function get_total_db($bulan, $tahun)
    {
        $this->db->select('sum(nominal)as total');
        $this->db->where('DATE_FORMAT(tgl_jurnal,"%m")', $bulan);
        $this->db->where('DATE_FORMAT(tgl_jurnal,"%Y")', $tahun);
        $this->db->where('posisi_dr_cr', 'debit');
        return $this->db->get('jurnal')->row()->total;
    }
    function get_total_cr($bulan, $tahun)
    {
        $this->db->select('sum(nominal)as total');
        $this->db->where('DATE_FORMAT(tgl_jurnal,"%m")', $bulan);
        $this->db->where('DATE_FORMAT(tgl_jurnal,"%Y")', $tahun);
        $this->db->where('posisi_dr_cr', 'kredit');
        return $this->db->get('jurnal')->row()->total;
    }
    public function get_buku_besar($akun, $bulan, $tahun)
    {
        $this->db->select('*');
        $this->db->from('jurnal a');
        $this->db->join('coa b', 'a.kode_akun=b.kode_akun');
        $this->db->where('b.kode_akun', $akun);
        $this->db->where('DATE_FORMAT(tgl_jurnal,"%m")', $bulan);
        $this->db->where('DATE_FORMAT(tgl_jurnal,"%Y")<=', $tahun);
        $this->db->order_By('tgl_jurnal');
        return $this->db->get()->result_array();
    }
    public function total_db($akun, $bulan, $tahun)
    {
        $this->db->select('sum(nominal) as nominal');
        $this->db->from('jurnal');
        $this->db->where('kode_akun', $akun);
        $this->db->where('DATE_FORMAT(tgl_jurnal,"%m")<=', $bulan);
        $this->db->where('DATE_FORMAT(tgl_jurnal,"%Y")<=', $tahun);
        $this->db->where('posisi_dr_cr', 'debit');
        return $this->db->get()->row()->nominal;
    }
    public function total_cr($akun, $bulan, $tahun)
    {
        $this->db->select('sum(nominal) as nominal');
        $this->db->from('jurnal');
        $this->db->where('kode_akun', $akun);
        $this->db->where('DATE_FORMAT(tgl_jurnal,"%m")<=', $bulan);
        $this->db->where('DATE_FORMAT(tgl_jurnal,"%Y")<=', $tahun);
        $this->db->where('posisi_dr_cr', 'kredit');
        return $this->db->get()->row()->nominal;
    }
    public function get_akun()
    {
        return $this->db->get('coa')->result_array();
    }
    public function get_dataAkun($kode_akun)
    {
        $this->db->where('kode_akun', $kode_akun);
        return $this->db->get('coa')->row_array();
    }
}
