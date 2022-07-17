<?php

class Kategori extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function getData()
    {
        $query = $this->db->get('kategori');

        return $query->result_array();
    }

    public function getDataAscByNama()
    {
        $this->db->order_by('nama', 'asc');
        $query = $this->db->get('kategori');

        return $query->result_array();
    }

    public function getDataById($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('kategori');

        return $query->result_array();
    }

    public function getDataByKode($kode)
    {
        $this->db->where('kode', $kode);
        $query = $this->db->get('kategori');

        return $query->result_array();
    }

    public function getDataByNama($nama)
    {
        $this->db->where('nama', $nama);
        $query = $this->db->get('kategori');

        return $query->result_array();
    }

    public function storeData($data)
    {
        $this->db->insert('kategori', $data);
    }

    public function updateData($data, $id)
    {
        $this->db->where('id', $id);
        $this->db->update('kategori', $data);
    }

    public function destroyData($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('kategori');
    }
}
