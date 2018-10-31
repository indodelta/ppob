<?php

class M_pesawat extends CI_Model
{

    function selectlastid($id)
    {
        $this->db->select('id');
        $this->db->from('trans_flight');
        $this->db->like('id', $id);
        $this->db->order_by('date_created', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->result();
    }

    function simpandata($table,$data)
    {
        $simpan = $this->db->insert($table, $data);
        return $simpan;
    }

}