<?php

class Aset extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function getData()
    {
        $query = $this->db->get('aset');

        return $query->result_array();
    }

    public function getDataAsetAktif()
    {
        $this->db->where('status', 'Ada');
        $this->db->where('sisa_umur >', 0);
        $query = $this->db->get('aset');

        return $query->result_array();
    }

    public function getDataAsetTidakAktif()
    {
        $this->db->where('status !=', 'Ada');
        $this->db->where('sisa_umur', 0);
        $query = $this->db->get('aset');

        return $query->result_array();
    }

    public function getDataById($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('aset');

        return $query->result_array();
    }

    public function getDataByKode($kode)
    {
        $this->db->where('kode', $kode);
        $query = $this->db->get('aset');

        return $query->result_array();
    }

    public function getDataByKodeTransaksi($kodeTransaksi)
    {
        $this->db->where('kode_transaksi', $kodeTransaksi);
        $query = $this->db->get('aset');

        return $query->result_array();
    }

    public function getLastData()
    {
        $this->db->order_by('id', 'desc');
        $this->db->limit(1);
        $query = $this->db->get('aset');

        return $query->result_array();
    }

    public function getDataDapatDisusutkan($tanggal)
    {
        $this->db->where('status', 'Ada');
        $this->db->where('sisa_umur >', 0);
        $this->db->where('tanggal <=', $tanggal);
        $query = $this->db->get('aset');

        return $query->result_array();
    }

    public function storeData($data)
    {
        $this->db->insert('aset', $data);
    }

    public function updateData($data, $id)
    {
        $this->db->where('id', $id);
        $this->db->update('aset', $data);
    }

    public function destroyData($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('aset');
    }

    public function destroyDataByKodeTransaksi($kodeTransaksi)
    {
        $this->db->where('kode_transaksi', $kodeTransaksi);
        $this->db->delete('aset');
    }
}
