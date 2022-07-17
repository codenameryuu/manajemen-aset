<?php

class Akun extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function getData()
    {
        $query = $this->db->get('akun');

        return $query->result_array();
    }

    public function getDataById($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('akun');

        return $query->result_array();
    }

    public function getDataByKodeAkun($kodeAkun)
    {
        $this->db->where('kode', $kodeAkun);
        $query = $this->db->get('akun');

        return $query->result_array();
    }

    public function getDataByNama($nama)
    {
        $this->db->where('nama', $nama);
        $query = $this->db->get('akun');

        return $query->result_array();
    }

    public function storeData($data)
    {
        $this->db->insert('akun', $data);
    }

    public function updateData($data, $id)
    {
        $this->db->where('id', $id);
        $this->db->update('akun', $data);
    }

    public function destroyData($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('akun');
    }
}
