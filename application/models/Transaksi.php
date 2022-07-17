<?php

class Transaksi extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function getDataByKodeTransaksi($kodeTransaksi)
    {
        $this->db->where('kode_transaksi', $kodeTransaksi);
        $query = $this->db->get('transaksi');

        return $query->result_array();
    }

    public function storeData($data)
    {
        $this->db->insert('transaksi', $data);
    }

    public function destroyDataByKodeTransaksi($kodeTransaksi)
    {
        $this->db->where('kode_transaksi', $kodeTransaksi);
        $this->db->delete('transaksi');
    }
}
