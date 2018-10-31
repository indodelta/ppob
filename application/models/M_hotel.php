<?php

class M_hotel extends CI_Model
{

    function simpandata($table,$data)
    {
        $simpan = $this->db->insert($table, $data);
        return $simpan;
    }

    function simpandataandgetid($table,$data)
    {
        $simpan = $this->db->insert($table, $data);
        $insertId = $this->db->insert_id();
        return $insertId;
    }

}