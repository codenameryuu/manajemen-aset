<?php

class DetailPenyusutan extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function getDataByKodeAset($kodeAset)
    {
        $this->db->where('kode_aset', $kodeAset);
        $this->db->order_by('tanggal', 'desc');
        $this->db->order_by('umur_penyusutan', 'asc');
        $query = $this->db->get('detail_penyusutan');

        return $query->result_array();
    }

    public function getDataByKodeTransaksi($kodeTransaksi)
    {
        $this->db->where('kode_transaksi', $kodeTransaksi);
        $this->db->order_by('tanggal', 'desc');
        $this->db->order_by('umur_penyusutan', 'asc');
        $query = $this->db->get('detail_penyusutan');

        return $query->result_array();
    }

    public function storeData($data)
    {
        $this->db->insert('detail_penyusutan', $data);
    }
}
