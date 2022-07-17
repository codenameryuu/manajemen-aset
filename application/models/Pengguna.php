<?php

class Pengguna extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function getByUsername($username)
    {
        $this->db->where('username', $username);
        $query = $this->db->get('pengguna');

        return $query->result_array();
    }

    public function storeData($data)
    {
        $this->db->insert('pengguna', $data);
    }
}
