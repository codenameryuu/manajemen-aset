<?php

class Pemberhentian extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function getData()
    {
        $query = $this->db->get('pemberhentian');

        return $query->result_array();
    }

    public function getDataById($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('pemberhentian');

        return $query->result_array();
    }

    public function getDataByTanggal($tanggal)
    {
        $this->db->where('tanggal', $tanggal);
        $query = $this->db->get('pemberhentian');

        return $query->result_array();
    }

    public function getDataFilterByTanggal($tanggalAwal, $tanggalAkhir)
    {
        if ($tanggalAwal) {
            $this->db->where('tanggal >=', $tanggalAwal);
        }

        if ($tanggalAkhir) {
            $this->db->where('tanggal <=', $tanggalAkhir);
        }

        $query = $this->db->get('pemberhentian');

        return $query->result_array();
    }

    public function storeData($data)
    {
        $this->db->insert('pemberhentian', $data);
        $lastId = $this->db->insert_id();

        return $lastId;
    }

    public function updateData($data, $id)
    {
        $this->db->where('id', $id);
        $this->db->update('pemberhentian', $data);
    }
}
