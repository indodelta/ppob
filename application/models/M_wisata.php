<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class M_wisata extends CI_Model
{

    function load_data_wisata()
    {
        $this->db->from('wisata_nama');
        $query = $this->db->get();
        return $query->result();
    }

    function load_data_wisata_where_type($where)
    {
        $this->db->from('wisata_nama');
        $this->db->where('type', $where);
        $query = $this->db->get();
        return $query->result();
    }

}