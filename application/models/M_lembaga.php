<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_lembaga extends CI_Model
{
    function simpan_data_lembaga($data)
    {
        $simpan = $this->db->insert('lembaga',$data);
        $insertId = $this->db->insert_id();
        return $insertId;
    }

    function load_data_lembaga()
    {
        $this->db->from('lembaga');
        $this->db->order_by("id", "desc");
        $query = $this->db->get();
        return $query->result();
    }


}