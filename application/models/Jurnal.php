<?php

class Jurnal extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function getData()
    {
        $query = $this->db->get('jurnal');

        return $query->result_array();
    }

    public function getDataByKodeTransaksi($kodeTransaksi)
    {
        $this->db->where('kode_transaksi', $kodeTransaksi);
        $query = $this->db->get('jurnal');

        return $query->result_array();
    }

    public function getDataFilterByTanggalAndKodeAkun($tanggalAwal, $tanggalAkhir, $kodeAkun)
    {
        if ($tanggalAwal) {
            $this->db->where('tanggal >=', $tanggalAwal);
        }

        if ($tanggalAkhir) {
            $this->db->where('tanggal <=', $tanggalAkhir);
        }

        $this->db->where('kode_akun', $kodeAkun);
        $query = $this->db->get('jurnal');

        return $query->result_array();
    }

    public function storeData($data)
    {
        $this->db->insert('jurnal', $data);
    }

    public function updateData($data, $id)
    {
        $this->db->where('id', $id);
        $this->db->update('jurnal', $data);
    }

    public function destroyDataByKodeTransaksi($kodeTransaksi)
    {
        $this->db->where('kode_transaksi', $kodeTransaksi);
        $this->db->delete('jurnal');
    }
}
