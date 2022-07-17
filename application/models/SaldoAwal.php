<?php

class SaldoAwal extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function getData()
    {
        $query = $this->db->get('saldo_awal');

        return $query->result_array();
    }

    public function updateData($data, $id)
    {
        $this->db->where('id', $id);
        $this->db->update('saldo_awal', $data);
    }
}
